<x-layout title="Liste des sports">
    <div>
        <img src="{{Vite::asset('resources/images/logo.png')}}" alt="logo">
        <div class="page_title">
            <h1>SPORTS DE L'OLYMPIADES</h1>
        </div>
    </div>

    @if(!empty($sports))
        <table>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Année d'ajout</th>
                <th>Nombre de disciplines</th>
                <th>Nombre d'épreuves</th>
                <th>Démarre le :</th>
                <th>Termine le :</th>
                <th>Propriétaire</th>
            </tr>
            @foreach($sports as $sport)
                <tr>
                    <td><a href="{{ route('sports.show', ['sport' => $sport]) }}">{{$sport['nom']}}</a></td>
                    <td>{{$sport['description']}}</td>
                    <td>{{$sport['annee_ajout']}}</td>
                    <td>{{$sport['nb_disciplines']}}</td>
                    <td>{{$sport['nb_epreuves']}}</td>
                    <td>{{$sport['date_debut']}}</td>
                    <td>{{$sport['date_fin']}}</td>
                    <td>{{$sport->user->name}}</td>
                </tr>
            @endforeach
        </table>
    @else
        <h3>aucun sport</h3>
    @endif

    <div id="row">
        <section id="recherche">
            <h4>Filtrage par nombre d'épreuves</h4>
            <form action="{{route('sports.index')}}" method="get">
                <select name="nbr">
                    <option value="All" @if($nbr == 'All') selected @endif>-- Chaque nombre --</option>
                    @foreach($nb_epreuves as $nb)
                        <option value="{{$nb}}" @if($nbr == $nb) selected @endif>{{$nb}}</option>
                    @endforeach
                </select>
                <input type="submit" value="OK">
            </form>

            <a class="bold" href="{{route('sports.index', 'All')}}">Reinitialiser la recherche</a>

            <h2>La liste des sports : {{count($sports)}}</h2>
        </section>

        <section id="ajout">
            <p>Vous ne trouvez pas votre sport fétiche ?</p>
            <a href="{{route('sports.create')}}">
                <button id="boutonCreation">Créer votre sport</button>
            </a>
        </section>
    </div>
</x-layout>
