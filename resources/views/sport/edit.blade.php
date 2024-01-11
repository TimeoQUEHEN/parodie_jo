<x-layout title="Modification">
    {{--
messages d'erreurs dans la saisie du formulaire.
--}}
    @if ($errors->any())
        <div class="important">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{--
    formulaire de saisie d'une tâche
    la fonction 'route' utilise un nom de route
    'csrf_field' ajoute un champ caché qui permet de vérifier
    que le formulaire vient du serveur.
    --}}
    <img src="{{Vite::asset('resources/images/logo.png')}}" alt="logo">
    <form class="formulaire" action="{{route('sports.update',$sport['id'])}}" method="POST">
        @csrf
        @method('PUT')
        {!! csrf_field() !!}
        <div class="text-center" style="margin-top: 2rem">
            <h3>Modification du sport {{$sport['nom']}}</h3>
            <hr class="mt-2 mb-2">
        </div>
        <div>
            {{-- la catégorie --}}
            <label for="nom"><strong>Nom :</strong></label>
            <input type="text" class="form-control" id="nom" name="nom"
                   value="{{ $sport['nom'] }}">
        </div>
        <div>
            <label for="textarea-input"><strong>Description :</strong></label>
            <br>
            <textarea name="description" id="description" rows="6" class="form-control"
                      placeholder="">{{ old($sport['description']) }}</textarea>
        </div>
        <div>
            {{-- la catégorie --}}
            <label for="nb_disciplines"><strong>Quantité de disciplines :</strong></label>
            <input type="range" class="form-control" id="nb_disciplines" name="nb_disciplines" min="0" max="10"
                   value="{{$sport['nb_disciples']}}">
        </div>
        <div>
            {{-- la catégorie --}}
            <label for="nb_epreuves"><strong>Quantité d'épreuves :</strong></label>
            <input type="range" class="form-control" id="nb_epreuves" name="nb_epreuves" min="0" max="10"
                   value="{{$sport['nb_epreuves']}}">
        </div>
        <div>
            {{-- la catégorie --}}
            <label for="annee_ajout"><strong>Année d'ajout</strong></label>
            <input type="text" class="form-control" id="annee_ajout" name="annee_ajout"
                   value="{{$sport['annee_ajout']}}">
        </div>
        <div>
            {{-- la date fin --}}
            <label for="date_debut"><strong>Date de début du sport : </strong></label>
            <input type="date" name="date_debut" id="date_debut"
                   value="{{$sport['date_debut']}}"
                   placeholder="aaaa-mm-jj">
        </div>
        <div>
            {{-- la date debut --}}
            <label for="date_fin"><strong>Date de fin du sport : </strong></label>
            <input type="date" name="date_fin" id="date_fin"
                   value="{{$sport['date_debut']}}"
                   placeholder="aaaa-mm-jj">
        </div>
        <div>
            <button class="btn btn-success" type="submit">Valide</button>
        </div>
    </form>
</x-layout>
