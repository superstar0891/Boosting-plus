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
                            <h4 class="card-title"> @lang('Orders Table')</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="orders-datatable">
                                    <thead class=" text-primary">
                                    @if(Auth::user()->type == "Administrator")
                                        <th>
                                            @lang('Customer Email')
                                        </th>
                                        <th>
                                           Booster Name
                                        </th>
                                    @endif
                                    <th>
                                        @lang('Product Name')
                                    </th>
                                    <th>
                                        @lang('Reference')
                                    </th>
                                    <th>
                                        @lang('Status')
                                    </th>
                                    <th>
                                        @lang('Game System')
                                    </th>
                                    <th>
                                        @lang('Total Payment Amount')($)
                                    </th>
                                    <th>
                                        @lang('Actions')
                                    </th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> @lang('Completed Orders Table')</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="completed-orders-datatable">
                                    <thead class=" text-primary">
                                    @if(Auth::user()->type == "Administrator")
                                        <th>
                                            @lang('Customer Email')
                                        </th>
                                        <th>
                                            Booster Name
                                        </th>
                                    @endif
                                    <th>
                                        @lang('Product Name')
                                    </th>
                                    <th>
                                        @lang('Reference')
                                    </th>
                                    <th>
                                        @lang('Status')
                                    </th>
                                    <th>
                                        @lang('Game System')
                                    </th>
                                    <th>
                                        @lang('Total Payment Amount')($)
                                    </th>
                                    <th>
                                        @lang('Actions')
                                    </th>
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
        var ordersTable = $('#orders-datatable').DataTable({
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
                url: '{{ route('.api.orders') }}'
            },
            columns: [
                    @if(Auth::user()->type == "Administrator")
                {
                    data: 'customer.email',
                    width: '15%',
                },
                {
                    data: 'booster.name',
                    width: '15%',
                    render: function(data, type, row) {
                        return data != null ? data : 'Not Yet Claimed';
                    }
                },
                    @endif
                {
                    data: 'product.name',
                    width: '10%',
                    render: function (data, type, row) {
                        return data['{{ LaravelLocalization::getCurrentLocale() }}'] + ' - ' + row.product.game.game_name
                    }
                },
                {
                    data: 'reference',
                    width: '10%',
                },
                {
                    data: 'status',
                    width: '10%',
                },
                {
                    data: 'game_system',
                    width: '10%',
                },
                {
                    data: 'total_payment_amount',
                    width: '20%',
                },
                {
                    data: 'id',
                    orderable: false,
                    width: '35%',
                    render: function (data, type, row) {
                        var orderAction = `<div class="btn-group">`;
                        @if(Auth::user()->type != "Customer")
                        if(row.booster_id === null) {
                            orderAction += `<a class="btn btn-sm btn-outline-warning" href="{{ route('dashboard.orders') }}/${data}/claim"><i class="now-ui-icons ui-1_settings-gear-63"></i> @lang('Claim Order')</a>`
                        }
                        @endif
                                @if(Auth::user()->type == "Administrator")
                                    if(row.booster_id !== null) {
                                    orderAction += `<a class="btn btn-sm btn-outline-danger" href="{{ route('dashboard.orders') }}/${data}/unclaim"><i class="now-ui-icons ui-1_simple-remove"></i> Unclaim Order</a>`;
                                }
                                                    orderAction += `<a class="btn btn-sm btn-outline-danger" href="{{ route('dashboard.orders') }}/${data}/delete"><i class="now-ui-icons ui-1_simple-remove"></i> @lang('Delete Order')</a>`;
                                    @endif
                    orderAction += `<a class="btn btn-sm btn-outline-success" href="{{ route('dashboard.orders') }}/${data}/view"><i class="fas fa-eye"></i> @lang('View Order')</a>`;
                                    orderAction += `</div>`;
                        return orderAction;
                    }
                }
            ]
        });
        var completedOrdersTable = $('#completed-orders-datatable').DataTable({
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
                url: '{{ route('.api.completedOrders') }}'
            },
            columns: [
                    @if(Auth::user()->type == "Administrator")
                {
                    data: 'customer.email',
                    width: '15%',
                },
                {
                    data: 'booster.name',
                    width: '15%',
                    render: function(data, type, row) {
                        return data != null ? data : 'Not Yet Claimed';
                    }
                },
                    @endif
                {
                    data: 'product.name',
                    width: '10%',
                    render: function (data, type, row) {
                        return data['{{ LaravelLocalization::getCurrentLocale() }}'] + ' - ' + row.product.game.game_name
                    }
                },
                {
                    data: 'reference',
                    width: '10%',
                },
                {
                    data: 'status',
                    width: '10%',
                },
                {
                    data: 'game_system',
                    width: '10%',
                },
                {
                    data: 'total_payment_amount',
                    width: '20%',
                },
                {
                    data: 'id',
                    orderable: false,
                    width: '35%',
                    render: function (data, type, row) {
                        var orderAction = `<div class="btn-group">`;
                            orderAction += `<a class="btn btn-sm btn-outline-success" href="{{ route('dashboard.orders') }}/${data}/view"><i class="fas fa-eye"></i> @lang('View Order')</a>`;
                        orderAction += `</div>`;
                        return orderAction;
                    }
                }
            ]
        });
    });
</script>
</html>
