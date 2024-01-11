@vite(['resources/css/app.css'])
@vite(['resources/js/app.js'])

<footer>
    <nav>
        <p style="color: #ffffff">Copyright &copy; {{ date('Y')}}
            <a href="http://www.iut-lens.univ-artois.fr/" target="_blank">
                <strong>IUT Lens - département Info.</strong>
            </a>
            <a href="{{route('sports.fish')}}" target="_blank">Take me somewhere</a>
            <a href="{{route('sports.index')}}">To Index we go</a>
        </p>
    </nav>
</footer>
