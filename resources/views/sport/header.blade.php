@vite(['resources/css/app.css'])
@vite(['resources/js/app.js'])

<footer>
    <nav>
        <a href="{{route('accueil')}}">🏛 Page d'accueil</a>
        <a href="{{route('sports.index')}}">😎 Liste des sports</a>
        <a href="{{route('about')}}">📜 A propos</a>
    </nav>
</footer>
