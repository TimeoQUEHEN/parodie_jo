@vite(['resources/css/app.css'])
@vite(['resources/js/app.js'])

<body class="main_container">
    <video controls loop id="fish">
        <source src="{{Vite::asset('resources/videos/funky.mp4')}}" type="video/mp4" />
    </video>
</body>
