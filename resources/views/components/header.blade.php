<nav>
    <a href="{{route('accueil')}}">🏛 Page d'accueil</a>
    <a href="{{route('about')}}">📜 A propos</a>
    <a href="{{route('contacts')}}">☎️ Contacts</a>
    <a href="{{route('athletes.index')}}">🏋️ Liste des athletes</a>
    @auth
    <a href="{{route('sports.index')}}">😎 Liste des sports</a>
    @endauth
    @guest
    <a href="{{route('register')}}">📥 Enregistrement</a>
    <a href="{{route('login')}}">😎 Connexion</a>
    @endguest
    @auth
        <p>{{Auth::user()->name}}</p>
        <button id="boutonLogout"><a href="#" id="logout">Logout</a></button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <script>
            document.getElementById('logout').addEventListener("click", (event) => {
                document.getElementById('logout-form').submit();
            });
        </script>
    @endauth
</nav>

