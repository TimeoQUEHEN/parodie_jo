<html>
    <head>
        <title> Jeux Olympiques de Paris 2024</title>
        @vite(['resources/css/app.css'])
        @vite(['resources/js/app.js'])
    </head>
    <body class="main_container">
        <img src="{{Vite::asset('resources/images/logo.png')}}" alt="logo">

        <h2 class="page_title"> Bienvenue sur le site des Jeux Olympiques de 2024 </h2>

        <a href="{{route('sports.index')}}">
            <button id="boutonGo">Accèder à la liste des sports</button>
        </a>
    </body>
</html>
