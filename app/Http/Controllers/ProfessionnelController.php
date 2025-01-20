<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Metier,
    Professionnel,
    Competence,
};
use App\Http\Requests\{
    ProfessionnelRequest,
};
use Illuminate\Support\Facades\Storage;

class ProfessionnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $slug = null)
    {
        $query = Professionnel::query();
    
        if ($slug) {
            $metier = Metier::where('slug', $slug)->firstOrFail();
            $query->where('metier_id', $metier->id);
        }
    
        if ($request->filled('competence')) {
            $competenceName = $request->input('competence');
    
            $query->whereHas('competences', function ($q) use ($competenceName) {
                $q->where('intitule', 'like', '%' . $competenceName . '%');
            });
        }

        if ($request->filled('professionnel')) {
            $professionnelName = $request->input('professionnel');
            
            $query->where(function ($q) use ($professionnelName) {
                if (str_contains($professionnelName, ' ')) {
                    [$prenom, $nom] = explode(' ', $professionnelName, 2);
                    
                    $q->where('prenom', 'like', '%' . $prenom . '%')
                      ->where('nom', 'like', '%' . $nom . '%');

                } else {
                    $q->where('prenom', 'like', '%' . $professionnelName . '%')
                      ->orWhere('nom', 'like', '%' . $professionnelName . '%');
                }
            });
        }
        
        $professionnels = $query->paginate(5);
    
        $metiers = Metier::all();
    
        $data = [
            'titre' => 'Les professionnels de la ' . config('app.name'),
            'description' => 'Retourner l\'ensemble des professionnels de la ' . config('app.name'),
            'professionnels' => $professionnels,
            'metiers' => $metiers,
            'slug' => $slug,
        ];
    
        return view('professionnels.index', $data);
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $metiers = Metier::OrderBy('libelle')->get();

        // Pour relation 1,n<->1,n Professionnel / Competence
        $competences = Competence::orderBy('intitule')->get();
        $data =[
            'titre'=>'Professionnel de la ' . config('app.name'),
            'description' => 'Retourner un Professionnel de la ' . config('app.name'),
            'metiers' => $metiers,
            'competences' => $competences,
        ];
        return view('professionnels.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfessionnelRequest $professionnelRequest)
    {


        $validData = $professionnelRequest->all();
        $validData['domaine'] = implode(',', $professionnelRequest->input('domaine'));
        // Ajouter les compétences sélectionnées au tableau $validData
        $validData['competences'] = $professionnelRequest->input('competence_id', []);

        if ($professionnelRequest->hasFile('cv')) {
            $path = $professionnelRequest->file('cv')->store('cv', 'public');
            $validData['cv'] = $path; // Enregistre le chemin relatif dans la base de données
        }

        $nouveauProfessionnel = Professionnel::create($validData);
        
        $nouveauProfessionnel->competences()->attach($professionnelRequest->input('competence_id', []));
        // $professionnel = new Professionnel;
        // $professionnel->nom = $professionnelRequest->nom;
        // $professionnel->prenom = $professionnelRequest->prenom;
        // $professionnel->email = $professionnelRequest->email;
        // $professionnel->telephone = $professionnelRequest->telephone;
        // $professionnel->cp = $professionnelRequest->cp;
        // $professionnel->ville = $professionnelRequest->ville;
        // $professionnel->naissance = $professionnelRequest->naissance;
        // $professionnel->formation = $professionnelRequest->formation;
        // $professionnel->domaine = implode(',', $professionnelRequest->domaine);
        // $professionnel->metier_id = $professionnelRequest->metier_id;
        // $professionnel->save();

        $msg = "Création correctement effectuée.";

        return redirect()->Route('professionnels.index')->withToto($msg);

    }

    /**
     * Display the specified resource.
     */
    public function show(Professionnel $professionnel)
    {
        $data =[
            'titre'=>'Professionnel de la ' . config('app.name'),
            'description' => 'Retourner un Professionnel de la ' . config('app.name'),
            'professionnel' => $professionnel,
        ];
        return view('professionnels.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professionnel $professionnel)
    {
        $metiers = Metier::OrderBy('libelle')->get();
        $competences = Competence::orderBy('intitule')->get();
        $data =[
            'titre'=>'Professionnel de la ' . config('app.name'),
            'description' => 'Retourner un Professionnel de la ' . config('app.name'),
            'professionnel' => $professionnel,
            'metiers' => $metiers,
            'competences'=>$competences,
        ];
        // dd($data);
        return view('professionnels.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfessionnelRequest $professionnelRequest, Professionnel $professionnel)
    {
        $validData = $professionnelRequest->all();
        $validData['domaine'] = implode(',', $professionnelRequest->input('domaine'));

        if ($professionnelRequest->hasFile('cv')) {
            // Supprimer l'ancien fichier si existant
            if ($professionnel->cv) {
                Storage::disk('public')->delete($professionnel->cv);
            }
    
            $path = $professionnelRequest->file('cv')->store('cvs', 'public');
            $validData['cv'] = $path;
        }
        $professionnel->update($validData);

        // Pour relation avec table pivot (1,n <=> 1,n)
        $professionnel->competences()->sync($professionnelRequest->input('competence_id', []));

        $msg = "Modification correctement effectuée.";
        return redirect()->Route('professionnels.index')->withToto($msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function formDelete(Professionnel $professionnel)
    {
        $metiers = Metier::all();
        $data =[
            'titre'=>'Professionnel de la ' . config('app.name'),
            'description' => 'Retourner un professionnel de la ' . config('app.name'),
            'professionnel' => $professionnel,
            'metiers' => $metiers,
        ];
        return view('professionnels.delete', $data);
    }

    public function destroy(Professionnel $professionnel)
    {
        $professionnel->delete();
        $msg = 'Professionnel supprimé avec succès.';
        return redirect()->Route('professionnels.index')->withToto($msg);
    }
}

