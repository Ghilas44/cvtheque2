<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Metier,
    Professionnel,
};
use App\Http\Requests\{
    ProfessionnelRequest,
};

class ProfessionnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug = null)
    {
        $professionnels = $slug ? 
            Metier::where('slug', $slug)->firstOrFail()->professionnels()->get() :
            Professionnel::get();

        $metiers = Metier::all();

        $data = [
            'titre'=>'Les professionnels de la ' . config('app.name'),
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
        $data =[
            'titre'=>'Professionnel de la ' . config('app.name'),
            'description' => 'Retourner un Professionnel de la ' . config('app.name'),
            'metiers' => $metiers,
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
        Professionnel::create($validData);
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
        // dd($data);
        return view('professionnels.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professionnel $professionnel)
    {
        $metiers = Metier::OrderBy('libelle')->get();
        $data =[
            'titre'=>'Professionnel de la ' . config('app.name'),
            'description' => 'Retourner un Professionnel de la ' . config('app.name'),
            'professionnel' => $professionnel,
            'metiers' => $metiers,

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
        $professionnel->update($validData);

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
