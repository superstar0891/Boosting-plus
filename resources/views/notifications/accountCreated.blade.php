<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <a class="navbar-brand mx-auto" href="{{ config('app.url') }}">
        <div id="logo">
            <img class="img-fluid" height="300px" src="{{ asset('frontend/img/logo.png') }}"/>
        </div>
    </a>
</nav>
<div class="container">
    <div class="card">
        <div class="card-header">
           Your New Password
        </div>
        <div class="card-body">
            <div class="row mb-4">

                <div class="col-md-6 offset-md-4">
                    <p class="mb-3">You recently placed an order with our site, EZ-Boosting. We're writing to inform you of the random password that has been set for you. You can use this password to login to our site and check on the status of your order.</p>
                    <p class="mb-3">Your new password: <strong> {{ $password }}</strong></p>
                    <p class="mb-3">We fully recommend you reset this password to something more memorable. You can do so at the link below.</p>
                    <a class="btn btn-lg btn-block btn-success" href="{{ route('password.request') }}">Reset Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
