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
                            <h4 class="card-title"> Boosters Table</h4>
                        </div>
                        <div class="card-body">
                            <a class="btn btn-success" href="{{ route('dashboard.boosters.create') }}">Create Booster</a>
                            <div class="table-responsive">
                                <table class="table" id="boosters-datatable">
                                    <thead class=" text-primary">
                                    <th>
                                        Booster Name
                                    </th>
                                    <th>
                                        Booster Email
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
        var boostersTable = $('#boosters-datatable').DataTable({
            ajax: {
                url: '{{ route('.api.boosters') }}'
            },
            columns: [
                {
                    data: 'name',
                    width: '20%',
                },
                {
                    data: 'email',
                    width: '20%',
                },
                {
                    data: 'created_at',
                    width: '20%',
                },
                {
                    data: 'id',
                    orderable: false,
                    width: '30%',
                    render: function (data, type, row) {
                        var boosterAction = `<div class="btn-group">
                            <a class="btn btn-outline-warning" href="{{ route('dashboard.boosters') }}/${data}/edit"><i class="fas fa-edit"></i> Edit Booster</a>
                            <a class="btn btn-outline-danger" href="{{ route('dashboard.boosters') }}/${data}/delete"><i class="now-ui-icons ui-1_simple-remove"></i> Delete Booster</a>`;
                        @if(Auth::user()->type = 'Administrator')
                            boosterAction += `<a class="btn btn-outline-primary" href="{{ route('dashboard.boosters') }}/${data}/impersonate"><i class="fas fa-mask"></i> Impersonate Booster</a>`;
                        @endif
                        boosterAction += `</div>`;
                        return boosterAction;
                    }
                }
            ]
        });
    });
</script>
</html>