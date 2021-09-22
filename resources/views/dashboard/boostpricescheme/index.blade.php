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
                            <h4 class="card-title"> @lang('Boost Pricing Scheme Table')</h4>
                        </div>
                        <div class="card-body">
                            <a class="btn btn-success" href="{{ route('dashboard.boostpricescheme.create') }}">@lang('Create Price Scheme')</a>
                            <div class="table-responsive">
                                <table class="table" id="boostpricescheme-datatable">
                                    <thead class=" text-primary">
                                    <th>
                                        @lang('Product Name')
                                    </th>
                                    <th>
                                        @lang('Start Range')
                                    </th>
                                    <th>
                                        @lang('End Range')
                                    </th>
                                    <th>
                                        @lang('Price Per Level')($)
                                    </th>
                                    @if(Auth::user()->type == "Administrator")
                                        <th>
                                            @lang('Actions')
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
        var boostpriceschemeTable = $('#boostpricescheme-datatable').DataTable({
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
                url: '{{ route('.api.boostpricescheme') }}'
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
                    data: 'start_range',
                    width: '20%',
                },
                {
                    data: 'end_range',
                    width: '20%',
                },
                {
                    data: 'price_per_level',
                    width: '20%',
                },
                    @if(Auth::user()->type == "Administrator")
                {
                    data: 'id',
                    orderable: false,
                    width: '20%',
                    render: function (data, type, row) {
                        var productAction = `<div class="btn-group">`
                        if (row.product_id != null) {
                            productAction += `<a class="btn btn-outline-warning" href="{{ route('dashboard.boostpricescheme') }}/${data}/edit"><i class="now-ui-icons ui-1_settings-gear-63"></i> @lang('Edit')</a>`;
                        }

                        productAction += `<a class="btn btn-outline-danger" href="{{ route('dashboard.boostpricescheme') }}/${data}/delete"><i class="now-ui-icons ui-1_simple-remove"></i> @lang('Delete')</a>
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
