<x-layout title="Visualisation">
    <main>
        @if($action == 'delete')
            <h1 class="page_title">Suppression : {{$sport["nom"]}}</h1>
        @else
            <h1 class="page_title">Details : {{$sport["nom"]}}</h1>
        @endif
        <hr class="mt-2 mb-2">
        <div id="infoDesc">
            {{$sport["description"]}}
        </div>
    </main>
    <div class="ligneShow">
        <section id="infoPlus">
            <ul>
                <li>ajouté en {{$sport["annee_ajout"]}}</li>
                <li>{{$sport["nb_disciplines"]}} disciplines</li>
                <li>{{$sport["nb_epreuves"]}} épreuves chacunes</li>
            </ul>
        </section>
        <section>
            <table id="calendrier">
                <tr>
                    <td colspan="2" style="background-color: #1a202c">Calendrier</td>
                </tr>
                <tr>
                    <td>
                        debut
                    </td>
                    <td>
                        fin
                    </td>
                </tr>
                <tr>
                    <td>
                        {{$sport["date_debut"]}}
                    </td>
                    <td>
                        {{$sport["date_fin"]}}
                    </td>
                </tr>
            </table>
        </section>
            <form class="formImage" action="{{route('sports.upload',$sport->id)}}" method="post" enctype="multipart/form-data">
                <h2>Choix d'une image</h2>
                @csrf
                <div class="form-group">
                    <label for="doc" style="color: black">Image : </label>
                    <input type="file" name="document" id="doc">
                </div>
                <input type="submit" value="Enregistrer" name="submit" class="boutonCouleur">
            </form>
        @endcan
    </div>

    <img src="{{asset('storage/images/'.$sport->url_image)}}" alt="image du sport">
    <div class="ligneShow">
        @if(count($sport->athletes)>0)
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Nationalité</th>
                    <th>Age</th>
                    <th>Rang</th>
                    <th>Performance</th>
                </tr>
                @foreach($sport->athletes as $ath)
                    <tr>
                        <td>{{$ath->nom}}</td>
                        <td>{{$ath->nationalite}}</td>
                        <td>{{$ath->age}}</td>
                        <td>{{$ath->classement->rang}}</td>
                        <td>{{$ath->classement->performance}}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <h4 class="page_title">aucun athletes</h4>
        @endif

        @if(!isset($meilleur))
            <h4 class="page_title"> Pas de médaille d'or enregistrée</h4>
        @else
            <div style="display: flex; flex-direction: column">
                <h4 class="page_title"> Médaille d'or enregistrée :</h4>
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Nationalité</th>
                        <th>Age</th>
                        <th>Rang</th>
                        <th>Performance</th>
                    </tr>
                    <tr>
                        <td>{{$meilleur->nom}}</td>
                        <td>{{$meilleur->nationalite}}</td>
                        <td>{{$meilleur->age}}</td>
                        <td>{{$meilleur->classement->rang}}</td>
                        <td>{{$meilleur->classement->performance}}</td>
                    </tr>
                </table>
            </div>
        @endif
    </div>

    <div class="ligneShow">
        <a href="{{route('sports.index')}}"><button class="boutonCouleur"> Retour à la liste</button></a>

        @can('delete', $sport)
            @if( $action != 'delete')
                <a href="{{ route('sports.show', ['sport' => $sport, 'action' => 'delete']) }}">
                    <button class="boutonCouleur">Supprimer le sport</button>
                </a>
            @else
                <form action="{{route('sports.destroy',$sport->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="text-center">
                        <button type="submit" name="delete" value="valide" class="boutonCouleur">Valide</button>
                        <button type="submit" name="delete" value="annule" class="boutonCouleur">Annule</button>
                    </div>
                </form>
            @endif
        @endcan

        @can('update', $sport)
            <a href="{{ route('sports.edit', ['sport' => $sport]) }}">
                <button class="boutonCouleur">modifier le sport</button>
            </a>
    </div>
</x-layout>
