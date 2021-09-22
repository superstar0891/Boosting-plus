<!DOCTYPE html>
<html lang="en">

@include('dashboard.layouts.header')
<style>
body {
min-height: 100vh;
}

.text-small {
font-size: 0.9rem;
}

.messages-box,
.chat-box {
height: 90%;
overflow-y: scroll;
}

.rounded-lg {
border-radius: 0.5rem;
}

input::placeholder {
font-size: 0.9rem;
color: #999;
}
.pagination {
    justify-content: center!important;
}
</style>

<body class="">
<div class="wrapper ">
    @include('dashboard.layouts.sidebar')
      <div class="main-panel" id="main-panel">
        @include('dashboard.layouts.navbar')
        <div class="container-fluid">
            <div class="row mt-5 mr-1 ml-1 rounded-lg overflow-hidden shadow">
                <!-- Users box-->
                <div class="col-12 px-0">
                    <div class="bg-white">

                        <div class="bg-gray px-4 py-2 bg-light">
                            <p class="h5 mb-0 py-1">@lang('Chat History')</p>
                        </div>

                        <div class="messages-box">
                            <div class="list-group rounded-0">
                                @foreach($conversations as $conversation)
                                <a class="list-group-item list-group-item-action text-dark rounded-0" href="{{ route('dashboard.chat.view', $conversation->id) }}">
                                    <div class="media">
                                        @if(Auth::user()->type == "Booster")
                                        <img src="{{ Gravatar::src($conversation->customer->email) }}" alt="user" width="50" class="rounded-circle">
                                        @elseif(Auth::user()->type == "Customer")
                                        <img src="{{ Gravatar::src($conversation->booster->email) }}" alt="user" width="50" class="rounded-circle">
                                        @elseif(Auth::user()->type == "Administrator")
                                            <img src="{{ Gravatar::src($conversation->customer->email) }}" alt="user" width="50" class="rounded-circle">
                                        @endif

                                        <div class="media-body ml-4">

                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <h6 class="mb-0">
                                                    @if(Auth::user()->type == "Booster")
                                                        {{ $conversation->customer->name }}
                                                    @elseif(Auth::user()->type == "Customer")
                                                        {{ $conversation->booster->name }}
                                                    @elseif(Auth::user()->type == "Administrator")
                                                        {{ $conversation->booster->name }} & {{ $conversation->customer->name }}
                                                    @endif
                                                </h6>
                                                <small class="small font-weight-bold">Conversation Started: {{ $conversation->created_at }}</small>
                                            </div>
                                            <p class="font-italic mb-0 text-small">{{ $conversation->order->product->name ?? 'N/A' }} | {{ $conversation->order->product->game->game_name ?? 'N/A' }} | @lang('Order Placed:') {{ $conversation->order->created_at ?? 'N/A' }} </p>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                                    {{ $conversations->links() }}
                                </div>
                        </div>
                    </div>
                </div>
                <!-- Chat Box-->

            </div>
        </div>
@include('dashboard.layouts.scripts')
</body>
</html>
