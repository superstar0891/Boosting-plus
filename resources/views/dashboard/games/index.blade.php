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
                            <h4 class="card-title"> @lang('Games Table')</h4>
                        </div>
                        <div class="card-body">
                            <a class="btn btn-success" href="{{ route('dashboard.games.create') }}">@lang('Create Game')</a>
                            <div class="table-responsive">
                                <table class="table" id="games-datatable">
                                    <thead class=" text-primary">
                                    <th>
                                        @lang('Image')
                                    </th>
                                    <th>
                                        @lang('Name')
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
        var gamesTable = $('#games-datatable').DataTable({
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
                url: '{{ route('.api.games') }}'
            },
            columns: [
                {
                    data: 'image',
                    width:'30%',
                    render: function (data, type, row) {
                        return  `<img src="{{ asset('dash/images/games') . '/' }}${data}" style="height:40px;">`;
                    }
                },
                {
                    data: 'game_name',
                    width:'30%',
                },
                @if(Auth::user()->type == "Administrator")
                {
                    data: 'id',
                    orderable: false,
                    width:'40%',
                    render: function (data, type, row) {
                        var productAction = `<div class="btn-group">
                                                    <a class="btn btn-outline-warning" href="{{ route('dashboard.games') }}/${data}/edit"><i class="now-ui-icons ui-1_settings-gear-63"></i> @lang('Edit')</a>
                                                    <a class="btn btn-outline-danger" href="{{ route('dashboard.games') }}/${data}/delete"><i class="now-ui-icons ui-1_simple-remove"></i> @lang('Delete')</a>
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