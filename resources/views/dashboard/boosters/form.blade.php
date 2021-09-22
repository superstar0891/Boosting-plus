<!DOCTYPE html>
<html lang="en">

@include('dashboard.layouts.header')

<body class="">
<div class="wrapper">
    @include('dashboard.layouts.sidebar')
     <div class="main-panel" id="main-panel">
        @include('dashboard.layouts.navbar')
        <div class="container" style="margin-top:10%;">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ $action }} Booster @if($booster != null)- {{ $booster->name }} @endif</h5>
                </div>
                <div class="card-body">
                    <form method="POST" id="dashboardForm" action="{{ ($booster) ? route('dashboard.boosters.edit', [$booster->id]) : route('dashboard.boosters.create') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Name<span class="text-danger"><small> - @lang('Required')</small></span></label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="Booster Name" value="{{ ($booster != null) ? $booster->name : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Email<span class="text-danger"><small> - @lang('Required')</small></span></label>
                            <input class="form-control" type="email" name="email" id="name" placeholder="Booster Email" value="{{ ($booster != null) ? $booster->email : '' }}" required>
                        </div>
                        @if($booster == null)
                            <div class="form-group">
                                <label for="name">Password<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                <input class="form-control" type="password" name="password" id="name" placeholder="Password" required>
                            </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="submitButton btn btn-outline-success">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@include('dashboard.layouts.scripts')
</html>