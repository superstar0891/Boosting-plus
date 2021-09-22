<!DOCTYPE html>
<html lang="en">

@include('dashboard.layouts.header')

<body class="">
<div class="wrapper ">
    @include('dashboard.layouts.sidebar')
      <div class="main-panel" id="main-panel">
        @include('dashboard.layouts.navbar')
        @if($order->booster_id != null)
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @if(Auth::user()->id == $order->booster_id)
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            @if($conversation != null)
                                <a class="btn btn-sm btn-primary" href="{{ route('dashboard.chat.view', $conversation) }}">Go To Message Center</a>
                            @else
                                <a class="btn btn-sm btn-primary" href="{{ route('dashboard.chat.startChat', $order->id) }}">Start New Chat</a>
                            @endif
                        </li>
                        @if($order->status == "Started")
                            <li class="nav-item">
                                <a class="btn btn-sm btn-success" href="#">Mark Order As Complete</a>
                            </li>
                        @elseif($order->status != "Claimed")
                            <li class="nav-item">
                                <a class="btn btn-sm btn-success" href="{{ route('dashboard.orders.markAsStarted', $order->id) }}">Mark Order As Started</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="btn btn-sm btn-warning" href="{{ route('dashboard.orders.requestLoginDetails', $order->id) }}">Request Login Details</a>
                        </li>
                    </ul>
                        @endif
                </div>
            </nav>
        @endif
        <div class="content">
            <div class="row align-items-center" style="margin-top:5%;">
                <div class="col-md-6">
                    @if(Auth::user()->type == "Administrator")
                        <div class="card card-user">
                            <div class="card-header text-center bg-dark text-white">
                                <h5>Customer Details</h5>
                            </div>
                            <div class="card-body">
                                <dl class="text-center">
                                    <dt>Customer Email</dt>
                                    <dd>{{ $order->customer->email }}</dd>
                                </dl>
                            </div>
                        </div>
                    @endif
                    @if(isset($order->boost_current_level))
                        <div class="card card-user">
                            <div class="card-header text-center bg-dark text-white">
                                <h5>Boosting Details</h5>
                            </div>
                            <div class="card-body">
                                <dl class="text-center">
                                    <dt>Current Level</dt>
                                    <dd>{{ $order->boost_current_level }}</dd>
                                </dl>
                                <dl class="text-center">
                                    <dt>Desired Level</dt>
                                    <dd>{{ $order->boost_desired_level }}</dd>
                                </dl>
                            </div>
                        </div>
                        @endif
                    @if(isset($order->amount_of_matches))
                            <div class="card card-user">
                                <div class="card-header text-center bg-dark text-white">
                                    <h5>Placement Details</h5>
                                </div>
                                <div class="card-body">
                                    <dl class="text-center">
                                        <dt>Amount Of Matches</dt>
                                        <dd>{{ $order->amount_of_matches }}</dd>
                                    </dl>
                                    <dl class="text-center">
                                        <dt>Placement Rank</dt>
                                        <dd>{{ $order->placement->name }}</dd>
                                    </dl>
                                </div>
                            </div>
                        @endif
                </div>
                <div class="col-md-6">
                    <div class="card card-user">
                        <div class="card-header text-center bg-dark text-white">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <h5>Order & Payment Details</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <dl class="text-center">
                                <dt>Reference</dt>
                                <dd>{{ $order->reference }}</dd>
                            </dl>
                            <dl class="text-center">
                                <dt>Status</dt>
                                <dd>{{ $order->status }}</dd>
                            </dl>
                            @if($order->notes != null)
                                <dl class="text-center">
                                    <dt>Order Notes</dt>
                                    <dd>{{ $order->notes }}</dd>
                                </dl>
                            @endif
                            @if(Auth::user()->type == "Administrator")
                                <dl class="text-center">
                                    <dt>Payment Method</dt>
                                    <dd>{{ $order->payment_method }}</dd>
                                </dl>
                            @endif
                            <dl class="text-center">
                                <dt>Total Payment Amount</dt>
                                <dd>${{ $order->total_payment_amount }}</dd>
                            </dl>
                            <dl class="text-center">
                                <dt>Game System</dt>
                                <dd>{{ $order->game_system}}</dd>
                            </dl>
                            @if($order->status != "Pending" || Auth::user()->type == "Administrator")
                                <dl class="text-center">
                                    <dt>{{ $order->game_system }} Email</dt>
                                    <dd>{{ $order->login_email }}</dd>
                                </dl>
                                <dl class="text-center">
                                    <dt>{{ $order->game_system }} Username</dt>
                                    <dd>{{ $order->login_username }}</dd>
                                </dl>
                                <dl class="text-center">
                                    <dt>{{ $order->game_system }} Password</dt>
                                    <dd>{{ $order->login_password }}</dd>
                                </dl>
                            @endif
                            @if(Auth::user()->type == "Administrator")
                                <dl class="text-center">
                                    <dt>Order Email</dt>
                                    <dd>{{ $order->payee_email ?? 'N/A' }}</dd>
                                </dl>
                                <dl class="text-center">
                                    <dt>Payee First Name</dt>
                                    <dd>{{ $order->payee_first_name ?? 'N/A' }}</dd>
                                </dl>
                                <dl class="text-center">
                                    <dt>Payee Last Name</dt>
                                    <dd>{{ $order->payee_last_name ?? 'N/A' }}</dd>
                                </dl>
                                <dl class="text-center">
                                    <dt>Payee Payer ID</dt>
                                    <dd>{{ $order->payee_payer_id ?? 'N/A' }}</dd>
                                </dl>
                                <dl class="text-center">
                                    <dt>Payee Country Code</dt>
                                    <dd>{{ $order->payee_country_code ?? 'N/A' }}</dd>
                                </dl>
                                <dl class="text-center">
                                    <dt>Payee Business Name</dt>
                                    <dd>{{ $order->payee_business_name ?? 'N/A' }}</dd>
                                </dl>
                                <dl class="text-center">
                                    <dt>Payee IP</dt>
                                    <dd>{{ $order->payee_ip ?? 'N/A' }}</dd>
                                </dl>
                                <dl class="text-center">
                                    <dt>Payee Receipt ID</dt>
                                    <dd>{{ $order->payee_receipt_id ?? 'N/A' }}</dd>
                                </dl>
                                <dl class="text-center">
                                    <dt>Payee Transaction ID</dt>
                                    <dd>{{ $order->payee_transaction_id ?? 'N/A' }}</dd>
                                </dl>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-user">
                        <div class="card-header text-center bg-dark text-white">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <h5>Product Details</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(($order->current_rank!="") && ($order->desired_rank!=""))
                              <div class="item-box mb-2 text-center">
                                <dl class="text-center">
                                    <dt>Ranks Requirement</dt>
                                    <dd><strong>{{ $order->current_rank }}</strong> to <strong>{{$order->desired_rank}}</strong></dd>
                                </dl>
                                <dl class="text-center">
                                    <dt>Price</dt>
                                    <dd>${{ $order->rank_price }}</dd>
                                </dl>
                              </div>
                              <hr>
                            @endif
                            @foreach($order->lines as $line)
                                <div class="item-box mb-2 text-center">
                                    <dl class="text-center">
                                        <dt>Addon Name</dt>
                                        <dd>@if($line->addon) {{ $line->addon->name }} @endif</dd>
                                    </dl>
                                    <dl class="text-center">
                                        <dt>Addon Price</dt>
                                        <dd>${{ $line->price }}</dd>
                                    </dl>
                                    <dl class="text-center">
                                        <dt>Addon Description</dt>
                                        <dd>@if($line->add) {{ $line->addon->description }} @endif</dd>
                                    </dl>
                                    <dl class="text-center">
                                        <dt>Customer Provided Values:</dt>
                                        @if($line->addon_type_id != null)
                                            <dd>{{ $line->addonOption->value }}</dd>
                                        @elseif($line->number_input != null)
                                            <dd>{{ $line->number_input }}</dd>
                                        @elseif($line->text_input)
                                            <dd>{{ $line->text_input }}</dd>
                                        @else
                                            <dd>The checkbox was ticked</dd>
                                        @endif
                                    </dl>
                                    <hr>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('dashboard.layouts.scripts')
</body>
</html>
