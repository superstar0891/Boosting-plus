<!DOCTYPE html>
<html lang="en">

@include('dashboard.layouts.header')

<body class="">
<div class="wrapper ">
    @include('dashboard.layouts.sidebar')
      <div class="main-panel" id="main-panel">
        @include('dashboard.layouts.navbar')
        <div class="content">
            <div class="row" style="margin-top:5%;">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> @lang('Products Table')</h4>
                        </div>
                        <div class="card-body">
                            @if(Auth::user()->type == "Administrator")
                                <a class="btn btn-success" href="{{ route('dashboard.products.create') }}">Create product</a>
                            @endif
                            <div class="table-responsive">
                                <table class="table" id="products-datatable">
                                    <thead class=" text-primary">
                                    <th>
                                        @lang('Image')
                                    </th>
                                    <th>
                                        @lang('Name')
                                    </th>
                                    <th>
                                        @lang('Game')
                                    </th>
                                    <th>
                                        @lang('Short Description')
                                    </th>
                                    <th>
                                        @lang('Price')
                                    </th>
                                    @if(Auth::user()->type == "Administrator")
                                        <th>
                                            Actions
                                        </th>
                                    @endif
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@include('dashboard.layouts.scripts')
</body>
<script>
    $(function () {
        var productsTable = $('#products-datatable').DataTable({
            "language": {
                "lengthMenu": "@lang('Display') _MENU_ @lang('records per page')",
                "zeroRecords": "@lang('Nothing found - sorry')",
                "info": "@lang('Showing page') _PAGE_ @lang('of') _PAGES_",
                "infoEmpty": "@lang('No records available')",
                "infoFiltered": "(@lang('filtered from') _MAX_ @lang('total records'))",
                "sSearch": "@lang('Search')",
                "paginate": {
                    "previous": "@lang('Previous')",
                    "next": "@lang('Next')"
                },
            },
            ajax: {
                url: '{{ route('.api.products') }}'
            },
            columns: [
                {
                    data: 'image',
                    width: '20%',
                    render: function (data, type, row) {
                        return `<img src="{{ asset('dash/images/products') . '/' }}${data}" style="height:40px;">`;
                    }
                },
                {
                    data: 'name',
                    width: '20%',
                    render: function(data, type, row) {
                        return data['{{ LaravelLocalization::getCurrentLocale() }}']
                    }
                },
                {
                    data: 'game.game_name',
                    width: '20%',
                },
                {
                    data: 'short_description',
                    width: '20%',
                    render: function(data, type, row) {
                        return data['{{ LaravelLocalization::getCurrentLocale() }}']
                    }
                },
                {
                    data: 'price',
                    width: '20%',
                },
                    @if(Auth::user()->type == "Administrator")
                {
                    data: 'id',
                    orderable: false,
                    width: '20%',
                    render: function (data, type, row) {
                        var productAction = `<div class="btn-group">
                                                    <a class="btn btn-outline-warning" href="{{ route('dashboard.products') }}/${data}/edit"><i class="now-ui-icons ui-1_settings-gear-63"></i> @lang('Edit')</a>
                                                    <a class="btn btn-outline-danger" href="{{ route('dashboard.products') }}/${data}/delete"><i class="now-ui-icons ui-1_simple-remove"></i> @lang('Delete')</a>
                                                </div>`;

                        return productAction;
                    }
                }
                @endif
            ]
        });
    });
</script>
</html>