<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Competence,
};
use App\Http\Requests\{
    CompetenceRequest,
};

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $competences= Competence::all();
        // $competences= Competence::orderBy('id','asc')->get();
        // vérifier par where pour filtrer un minimum
        // $competences= Competence::where('intitule','!=', 'Gestion de projet')->get();
        $competences= Competence::get();

        $data =[
            'titre'=>'Les compétences de la ' . config('app.name'),
            'description' => 'Retourner l\'ensemble des compétences de la ' . config('app.name'),
            'competences' => $competences,
        ];
        // dd (vars: $competences);
        return view('competences/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data =[
            'titre'=>'Compétence de la ' . config('app.name'),
            'description' => 'Retourner une compétence de la ' . config('app.name'),
        ];
        return view('competences/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompetenceRequest $competenceRequest)
    {
    // Exemple 1
        // $valideData = $competenceRequest->all();
        // Competence::create($valideData);
        // $msg = "Enregistrement correctement effectué";
        // return redirect()->Route('competences.index')->withToto($msg);
    
    // Exemple 2
        $competence = new Competence;
        $competence->intitule = $competenceRequest->intitule;
        $competence->description = $competenceRequest->description;
        $competence->save();
        $msg = "Enregistrement correctement effectué";
        return redirect()->Route('competences.index')->withToto($msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(Competence $competence)
    {
        $data =[
            'titre'=>'Compétence de la ' . config('app.name'),
            'description' => 'Retourner une compétence de la ' . config('app.name'),
            'competence' => $competence,
        ];
        // dd($data);
        return view('competences/show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competence $competence)
    {
        $data =[
            'titre'=>'Compétence de la ' . config('app.name'),
            'description' => 'Retourner une compétence de la ' . config('app.name'),
            'competence' => $competence,
        ];
        // dd($data);
        return view('competences/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompetenceRequest $competenceRequest, Competence $competence)
    {
        $valideData = $competenceRequest->all();
        $competence->update($valideData);
        $msg = "Enregistrement correctement modifié.";
        return redirect()->Route('competences.index')->withToto($msg);
    }


    // Vue pour delete
    
    public function formdelete(Competence $competence)
    {
        $data =[
            'titre'=>'Compétence de la ' . config('app.name'),
            'description' => 'Retourner une compétence de la ' . config('app.name'),
            'competence' => $competence,
        ];
        // dd($data);
        return view('competences.delete', $data);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competence $competence)
    {
        $competence->delete(); // Supprime la compétence
        $msg = 'Compétence supprimée avec succès.';
        return redirect()->Route('competences.index')->withToto($msg);
    }   
}
 