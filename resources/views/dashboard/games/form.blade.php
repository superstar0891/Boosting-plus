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
                    <h5 class="title">{{ $action }} @lang('Game') @if($game != null) {{ $game->game_name }} @endif</h5>
                </div>
                <div class="card-body">
                    <form method="POST" id="dashboardForm" action="{{ ($game) ? route('dashboard.games.edit', [$game->id]) : route('dashboard.games.create') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                @if($game != null)
                                    <label>@lang('Current File'):</label>
                                    <img src="{{ asset('dash/images/games') . '/' . $game->image }}" style="height:200px;">
                                    <br>
                                @endif
                                @if($game==null)
                                  <label>Upload Image:</label>
                                @endif
                                <input id="image" name="image" type="file" value="{{ ($game != null) ? $game->image : '' }}">
                                <button class="btn btn-outline-primary" type="button">@lang('Upload Image')</button>

                            </div>
                            <div class="form-group">
                                @if($game != null)
                                    <label>Current Banner:</label>
                                    <img src="{{ asset('dash/images/games') . '/' . $game->image_banner }}" style="height:200px;">
                                    <br>
                                @endif
                                @if($game==null)
                                  <label>Upload Banner:</label>
                                @endif
                                <input id="image" name="image_banner" type="file" value="{{ ($game != null) ? $game->image_banner : '' }}">
                                <button class="btn btn-outline-primary" type="button">@lang('Upload Image')</button>

                            </div>
                            <div class="form-group">
                                <label for="name">@lang('Game Name')<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                <input class="form-control" type="text" name="name" id="name" placeholder="@lang('Please Enter A Game Name')" value="{{ ($game != null) ? $game->game_name : '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name">@lang('Game Link')<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                <input class="form-control" type="text" name="game_link" id="game_link" placeholder="@lang('Please Enter Game Link in small caps using hyphens(-) only')" value="{{ ($game != null) ? $game->game_link : '' }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>English Translation</h3>
                            <div class="form-group">
                                <label for="description">@lang('Game Description')<span class="text-danger"><small> - @lang('Required')</small></span></label><br>
                                <textarea name="descriptionEN" id="summernoteEN" class="summernoteEN" required>{{ ($game != null) ? $game->getTranslation('description','en') : '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>Arabic Translation</h3>
                            <div class="form-group">
                                <label for="description">@lang('Game Description')<span class="text-danger"><small> - @lang('Required')</small></span></label><br>
                                <textarea name="descriptionAR" id="summernoteAR" class="summernoteAR" required>{{ ($game != null) ? $game->getTranslation('description','ar') : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check form-group">
                                    <label for="price">PC Only Check</label>
                                    <br>
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="pc_check" value="yes" @if($game != null && $game->pc_only == 1) checked @endif>
                                        Is this game only available on PC?
                                        <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                    </label>
                                </div>
                            </div>
                        </div>

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
<script>
    $(function() {
        //assign the variable passed from controller to a JavaScript variable.
        @if($game != null)
        var contentEN = {!! json_encode($game->getTranslation('description','en')) !!};
        //set the content to summernote using `code` attribute.
        $('.summernoteEN').summernote('code', contentEN);
        var contentAR = {!! json_encode($game->getTranslation('description','ar')) !!};
        //set the content to summernote using `code` attribute.
        $('.summernoteAR').summernote('code', contentAR);
        @endif
    });
</script>
</html>
