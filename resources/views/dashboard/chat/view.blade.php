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
</style>

<body class="">
<div class="wrapper ">
    @include('dashboard.layouts.sidebar')
    <div class="main-panel" id="main-panel">
        @include('dashboard.layouts.navbar')
        <div class="row mt-5 mr-1 ml-1 rounded-lg shadow">
            <!-- Users box-->
            <div class="col-12 px-0" style="height:700px;">
                <div class="px-4 py-5 chat-box bg-white">
                    @foreach($conversation->messages as $message)
                        @if($message->is_system_message == 1)
                            <div class="media w-50 m-auto mb-3 text-center">
                                <div class="media-body">
                                    <div class="bg-dark rounded py-2 px-3 mb-2">
                                        <p class="text-small mb-0 text-white message" data-message-id="{{ $message->id }}">{{ $message->message }}</p>
                                    </div>
                                    <p class="small text-muted">{{ $message->created_at }}</p>
                                </div>
                            </div>
                        @else
                            {{-- If we are sending --}}
                            @if($message->sender_id == Auth::user()->id)
                            <!-- Sender Message-->
                                <div class="media w-50 ml-auto mb-3">
                                    <div class="media-body">
                                        <div class="bg-primary rounded py-2 px-3 mb-2">
                                            <p class="text-small mb-0 text-white message" data-message-id="{{ $message->id }}">{{ $message->message }}</p>
                                        </div>
                                        <p class="small text-muted">{{ $message->created_at }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="media w-50 mb-3"><img src="{{ Gravatar::src($message->sender->email) }}" alt="user" width="50" class="rounded-circle">
                                    <div class="media-body ml-3">
                                        <div class="bg-light rounded py-2 px-3 mb-2">
                                            <p class="text-small mb-0 text-muted message" data-message-id="{{ $message->id }}">{{ $message->message }}</p>
                                        </div>
                                        <p class="small text-muted">{{ $message->created_at }}</p>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
                <!-- Typing area -->
                @if($conversation->order->status != "Completed")
                    <form method="post" action="{{ route('dashboard.chat.sendMessage', $conversation->id) }}" class="bg-light" id="newMessage">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" placeholder="Type a message" name="message" class="form-control rounded-0 border-0 py-4 bg-light" required>
                            <div class="input-group-append">
                                <button id="button-addon2" type="submit" class="btn btn-link sendMessageButton"><i class="fa fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="input-group text-center">
                        <h4 class="text-success text-lg-center">Your order has been completed!</h4>
                    </div>
                @endif
            </div>
            <!-- Chat Box-->

        </div>
        @if($conversation->order->status != "Completed")
            @if(Auth::user()->id == $conversation->order->booster_id)
                <div class="row">
                    <div class="col-md-5 offset-4">
                        <div class="btn-group">
                            <a class="btn btn-outline-danger" href="{{ route('dashboard.chat.requestLoginCode', $conversation->order->id) }}">Request Log In Code</a>
                            <a class="btn btn-success" href="{{ route('dashboard.chat.announceWin', $conversation->id) }}">Announce Win</a>
                            <a class="btn btn-warning" href="{{ route('dashboard.chat.announceLose', $conversation->id) }}">Announce Lose</a>
                            <a class="btn btn-outline-success" href="{{ route('dashboard.chat.markAsCompleted', $conversation->order->id) }}">Complete Order</a>
                        </div>
                    </div>
                </div>
            @endif
        @endif
@include('dashboard.layouts.scripts')
</body>
</html>
<script>
    $(function () {
        $('.chat-box').animate({scrollTop: $('.chat-box').prop('scrollHeight')}, 1000);
        $('#newMessage').on('submit', function() {
            var btn = $('.sendMessageButton');
            btn.prop('disabled', true);
            btn.html(`<i class="fas fa-cog fa-spin"></i>`);
            setTimeout(function(){
                btn.prop('disabled', false);
                btn.html(`<i class="fa fa-paper-plane"></i>`);
            }, 2000);
        });
        var checkForResponse = function () {
            var id = $('.message').last().data('message-id');
            $.ajax({
                url: '{{ route('dashboard.chat.checkIfNewMessage', $conversation->id) }}?message_id=' + id,
                success: function (response) {
                    if (response == 200) {
                        location.reload();
                    }
                }
            });
        };
        setInterval(checkForResponse, 2000);
    });
</script>
