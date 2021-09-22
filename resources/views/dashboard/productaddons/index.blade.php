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
                            <h4 class="card-title"> @lang('Product Addons Table')</h4>
                        </div>
                        <div class="card-body">
                            @if(Auth::user()->type == "Administrator")
                            <a class="btn btn-success" href="{{ route('dashboard.productaddons.create') }}">Create product addon</a>
                            @endif
                            <div class="table-responsive">
                                <table class="table" id="product-addons-datatable">
                                    <thead class=" text-primary">
                                    <th>
                                        @lang('Product')
                                    </th>
                                    <th>
                                        @lang('Name')
                                    </th>
                                    <th>
                                        @lang('Type')
                                    </th>
                                    <th>
                                        @lang('Percentage Price')
                                    </th>
                                    <th>
                                        @lang('Order')
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
        var productAddonsTable = $('#product-addons-datatable').DataTable({
            "language": {
                "lengthMenu": "@lang('Display') _MENU_ @lang('records per page')",
                "zeroRecords": "@lang('Nothing found - sorry')",
                "info": "@lang('Showing page') _PAGE_ @lang('of') _PAGES_",
                "infoEmpty": "@lang('No records available')",
                "infoFiltered": "(@lang('filtered from') _MAX_ @lang('total records'))",
                "sSearch": "@lang('Search')",
                "paginate": {
                    "previous" : "@lang('Previous')",
                    "next" : "@lang('Next')"
                },
            },
            ajax: {
                url: '{{ route('.api.productaddons') }}'
            },
            columns: [
                {
                    data: 'product.name',
                    width: '20%',
                    render: function (data, type, row) {
                        if (data != null) {
                            return data['{{ LaravelLocalization::getCurrentLocale() }}'] + ' - ' + row.product.game.game_name
                        }
                        return 'N/A (Product Likely Deleted)';

                    }
                },
                {
                    data: 'name',
                    width:'20%',
                    render: function(data, type, row) {
                        return data['{{ LaravelLocalization::getCurrentLocale() }}']
                    }
                },
                {
                    data: 'type',
                    width:'20%',
                },
                {
                    data: 'price_in_percent',
                    width:'20%',
                },
                {
                    data: 'addon_order',
                    width:'20%',
                },
                @if(Auth::user()->type == "Administrator")
                {
                    data: 'id',
                    orderable: false,
                    width:'20%',
                    render: function (data, type, row) {
                        var productAction = `<div class="btn-group">
                                                    <a class="btn btn-outline-warning" href="{{ route('dashboard.productaddons') }}/${data}/edit"><i class="now-ui-icons ui-1_settings-gear-63"></i> @lang('Edit')</a>
                                                    <a class="btn btn-outline-danger" href="{{ route('dashboard.productaddons') }}/${data}/delete"><i class="now-ui-icons ui-1_simple-remove"></i> @lang('Delete')</a>
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
