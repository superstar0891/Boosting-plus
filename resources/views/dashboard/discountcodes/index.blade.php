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
                            <h4 class="card-title"> Discount Codes Table</h4>
                        </div>
                        <div class="card-body">
                            <a class="btn btn-success" href="{{ route('dashboard.discountcodes.create') }}">Create Discount Code</a>
                            <div class="table-responsive">
                                <table class="table" id="discountcodes-datatable">
                                    <thead class=" text-primary">
                                    <th>
                                       Code
                                    </th>
                                    <th>
                                        Percentage Discount(%)
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
        var gamesTable = $('#discountcodes-datatable').DataTable({
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
                url: '{{ route('.api.discountcodes') }}'
            },
            columns: [
                {
                    data: 'code',
                    width:'30%',
                },
                {
                    data: 'percentage_discount',
                    width:'30%',
                },
                @if(Auth::user()->type == "Administrator")
                {
                    data: 'id',
                    orderable: false,
                    width:'40%',
                    render: function (data, type, row) {
                        var discountCodeAction = `<div class="btn-group">
                                                    <a class="btn btn-outline-warning" href="{{ route('dashboard.discountcodes') }}/${data}/edit"><i class="now-ui-icons ui-1_settings-gear-63"></i> @lang('Edit')</a>
                                                    <a class="btn btn-outline-danger" href="{{ route('dashboard.discountcodes') }}/${data}/delete"><i class="now-ui-icons ui-1_simple-remove"></i> @lang('Delete')</a>
                                                </div>`;

                        return discountCodeAction;
                    }
                }
                @endif
            ]
        });
    });
</script>
</html>
