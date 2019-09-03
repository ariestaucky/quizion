<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Style -->
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    </head>
    <body>
        
        <div class="alrazy-title" data-splitting>
            Ready to test your knowladge?
        </div>

        <br>

        <a href="quiz">
            <button class="button">
                <span>Click to START!</span>
            </button>
        </a>

        <script src="https://unpkg.com/splitting@1.0.0/dist/splitting.js"></script>
        <script src="{{ asset('js/welcome.js') }}"></script>
        <script>
            Splitting();
        </script>
    </body>
</html>
