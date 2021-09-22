<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('frontend/css/new_style.css?rand='.rand())}}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" />
</head>
<body>
    <section class="games-section">
        <div class='addbox'>
            <div class='boostingplusft'>BOOSTING PLUS</div>
            <div>&ensp;</div><br />
            <h4>THE #1 IN-GAMES SERVICES PROVIDER</h4>
            <div>&ensp;</div><br />

            <div class="row">
                @foreach ($games as $game)
                <div class="col-lg-2 col-md-2 col-sm-12">
                    <div class="game-item">
                        <a href="{{ url('games/' . $game->game_link) }}">
                            @if ($game->image != '')
                            <img src="{{ asset('dash/images/games') }}/{{ $game->image }}" alt="#" class=" game_image">
                            @else
                            <img src="{{ asset('frontend/images/') }}/no_image.jpg" alt="#" class=" game_image">
                            @endif
                        </a>
                        <div>&ensp;</div>
                        <div class="read-more"> {{ $game->game_name }}</div>
                    </div>


                </div>
                @endforeach
            </div>

        </div>
        <div>&ensp;</div>
        <div>&ensp;</div>
        <div class='selectgames'><span style='color: fuchsia;'>SELECT</span>&ensp; A&ensp; GAME</div>
    </section>

</body>

</html>
