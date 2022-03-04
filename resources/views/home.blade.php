<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Aloware</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
    </head>
    <body>
        <header class="w-100">
            <img src="{{ asset('images/header-bg.png') }}" alt="{{ $title }}" class="w-100">
            <h1 class="title">{{ $title }}</h1>
        </header>
        <div class="container mt-3 mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="content">{{ $content }}</div>
                    <div id="comment" class="w-100 mt-3">
                        <Comments :object-id="{{ $objectId }}" type="article"/>
                    </div>
                </div>
            </div>
        </div>
        <!-- Scripts-->
        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    </body>
</html>
