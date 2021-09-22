@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid" style='min-width:300px: heigt: 1000px'>
    <div class="row logodisplay " >
        <img class="mt-2 " src='{{asset('frontend/images/logo2.png')}}' width='100%'>
    </div>
    <div class="row" >
        <div  class="col-lg-4 col-md-4 col-sm-4 sidebardisplay" style='padding: 0px'>
            <img src='{{asset('frontend/images/Re&Lo/lo.png') }}' width='100%'>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xm-12 justify-content-center" style='background-color: black; padding: 10%'>
            {{-- <div class="card"> --}}
                <div class="memberfont">MEMBERS AREA</div>

                {{-- <div class="card-body"> --}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-lg-5 col-md-12 col-form-label text-md-left">{{ __('EMAIL') }}</label>

                            <div class="col-lg-7 col-md-12 form_height_center">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group my-4 row">
                            <label for="password" class=" col-lg-5 col-md-12 col-form-label text-md-left">{{ __('PASSWORD') }}</label>

                            <div class="col-lg-7 col-md-12 form_height_center">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       {{-- <div class="form-group row">
                           <div class="col-md-6 offset-md-4">
                               <div class="form-check">
                                   <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                   <label class="form-check-label" for="remember">
                                       {{ __('Remember Me') }}
                                   </label>
                               </div>
                           </div>
                       </div> --}}



                        <div class="form-group row mb-0">
                            <div class="col-12 text-center">
                                <a class="btn-lin" href="{{ route('password.request') }}">
                                    {{ __('FORGOT PASSWORD?') }}
                                </a><br>
                                <button type="submit" class="btn btn-add">
                                    {{ __('LOGIN NOW') }}
                                </button>
                            </div>
                        </div>
                    </form>
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
    </div>
</div>
@endsection
