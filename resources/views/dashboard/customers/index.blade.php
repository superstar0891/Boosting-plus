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
                            <h4 class="card-title"> Customers Table</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="orders-datatable">
                                    <thead class=" text-primary">
                                    <th>
                                        Customer Email
                                    </th>
                                    <th>
                                        Gives Marketing Consent?
                                    </th>
                                    <th>
                                        Date Registered
                                    </th>
                                    <th>
                                        Actions
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
            ajax: {
                url: '{{ route('.api.customers') }}'
            },
            columns: [
                {
                    data: 'email',
                    width: '20%',
                },
                {
                    data: 'gives_marketing_consent',
                    width: '20%',
                    render: function (data, type, row) {
                        return data === 1 ? 'Yes' : 'No'
                    }
                },
                {
                    data: 'created_at',
                    width: '20%',
                },
                {
                    data: 'id',
                    orderable: false,
                    width: '20%',
                    render: function (data, type, row) {
                        var customerAction = `<div class="btn-group">
                            <a class="btn btn-outline-danger" href="{{ route('dashboard.customers') }}/${data}/delete"><i class="now-ui-icons ui-1_simple-remove"></i> Delete Customer</a>`;
                        return customerAction;
                    }
                }
            ]
        });
    });
</script>
</html>