<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SportController extends Controller
{

    public function fish() {
        return view('fish.fish');
    }
    public function index(Request $request) {
        $nbr = $request->input('nbr', null);
        $value = $request->cookie('nbr', null);

        if (!isset($nbr)) {
            if (!isset($value)) {
                $sports = Sport::all();
                $nbr = 'All';
                Cookie::expire('nbr');
            } else {
                $sports = Sport::where('nb_epreuves', $value)->get();
                $nbr = $value;
                Cookie::queue('nbr', $nbr, 10);
            }
        } else {
            if ($nbr == 'All') {
                $sports = Sport::all();
                Cookie::expire('nbr');
            } else {
                $sports = Sport::where('nb_epreuves', $nbr)->get();
                Cookie::queue('nbr', $nbr, 10);
            }
        }
        $nb_epreuves = Sport::distinct('nb_epreuves')->pluck('nb_epreuves');
        return view('sport.index', ['titre' => "Liste des Sports", 'sports' => $sports, 'nbr' => $nbr, 'nb_epreuves' => $nb_epreuves]);
    }

    public function create()
    {
        return view('sport.create', ['title' => 'Création d\'un sport',]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nom'=>'required',
                'description' => 'required',
                'annee_ajout' => 'required',
                'nb_disciplines' => 'required',
                'nb_epreuves'=>'required',
                'date_debut'=>'required',
                'date_fin'=>'required',
            ]
        );

        // A partir d'ici le code est exécuté uniquement si les données sont validaées
        // par la méthode validate()
        // sinon un message d'erreur est renvoyé vers l'utilisateur

        // préparation de l'enregistrement à stocker dans la base de données
        $sport = new Sport();
        $user = Auth::user();

        $sport->nom = $request->nom;
        $sport->description = $request->description;
        $sport->annee_ajout = $request->annee_ajout;
        $sport->nb_disciplines = $request->nb_disciplines;
        $sport->nb_epreuves = $request->nb_epreuves;
        $sport->date_debut = $request->date_debut;
        $sport->date_fin = $request->date_fin;
        $sport->user_id = $user->getAuthIdentifier();
        $sport->url_image = 'default_image.jpg';

        // insertion de l'enregistrement dans la base de données
        $sport->save();

        // redirection vers la page qui affiche la liste des tâches
        return redirect()->route('sports.index')
            ->with('type', 'primary')
            ->with('msg', 'Sport ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id) {
        $action = $request->query('action', 'show');
        $sport = Sport::find($id);
        $aths = $sport->athletes;
        $meilleur=10000000000;

        if (count($aths) != 0) {
            $k = 0;
            for ($i =0; $i<count($aths);$i++) {
                if ($aths[$i]->classement->rang < $meilleur) {
                    $meilleur = $aths[$i]->classement->rang;
                    $k = $i;
                }
            }
            $m = $aths[$k];
        } else {
            $m = null;
        }

        return view('sport.show', ['sport' => $sport, 'action' => $action, 'title' => 'Visualisation du sport', 'meilleur' => $m]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sport = Sport::find($id);
        return view('sport.edit', ['sport' => $sport]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sport = Sport::find($id);

        $this->validate(
            $request,
            [
                'nom'=>'required',
                'description' => 'required',
                'annee_ajout' => 'required',
                'nb_disciplines' => 'required',
                'nb_epreuves'=>'required',
                'date_debut'=>'required',
                'date_fin'=>'required',
            ]
        );

        $sport->nom = $request->nom;
        $sport->description = $request->description;
        $sport->annee_ajout = $request->annee_ajout;
        $sport->nb_disciplines = $request->nb_disciplines;
        $sport->nb_epreuves = $request->nb_epreuves;
        $sport->date_debut = $request->date_debut;
        $sport->date_fin = $request->date_fin;

        // insertion de l'enregistrement dans la base de données
        $sport->save();

        // redirection vers la page qui affiche la liste des tâches
        return redirect()->route('sports.index')
            ->with('type', 'primary')
            ->with('msg', 'Sport mis a jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id) {
        $sport = Sport::find($id);
        if (Gate::denies('delete-tache', $sport)) {
            return redirect()->route('sports.show',
                ['titre' => 'Affichage d\'un sport', 'sport' => $sport, 'action' => 'show'])
                ->with('type', 'error')
                ->with('msg', 'Impossible de supprimer le sport');
        }


        // vérifications autres

        $sport->delete();

        return redirect()->route('sports.index', ['sports' => $sport])->with('status', 'Sport supprimée avec succès');
    }


    public function upload(Request $request, $id) {

        $sport = Sport::find($id);

        if ($request->hasFile('document') && $request->file('document')->isValid()) {
            $file = $request->file('document');
        } else {
            return redirect()->route('sports.show');
        }
        $nom = 'image';
        $now = time();
        $nom = sprintf("%s_%d.%s", $nom, $now, $file->extension());

        $file->storeAs('images',$nom);
        if (isset($sport->url_image)) {
            Log::info("Image supprimée : ". $sport->url_image);
            Storage::delete($sport->url_image);
        }
        $sport->url_image = $nom;
        $sport->save();
        //$file->store('docs');
        return redirect()->route('sports.show', ['sport' => $sport]);
    }

}
