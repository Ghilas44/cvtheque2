<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\{
    Metier,
};
use App\Http\Requests\{
    MetierRequest,
};
class MetierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metiers = Metier::get();

        $data = [
            'titre'=>'Les métiers de la ' . config('app.name'),
            'description' => 'Retourner l\'ensemble des metiers de la ' . config('app.name'),
            'metiers' => $metiers,
        ];
        
        return view('metiers/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data =[
            'titre'=>'Métier de la ' . config('app.name'),
            'description' => 'Retourner un métier de la ' . config('app.name'),
        ];
        return view('metiers/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MetierRequest $metierRequest)
    {   

        $metier = new Metier;
        $metier->libelle = $metierRequest->libelle;
        $metier->slug = Str::slug($metier->libelle);
        $metier->description = $metierRequest->description;
        // $metier->slug = $metierRequest->slug;
        $metier->save();

        $msg = "Enregistrement correctement effectué";
        return redirect()->Route('metiers.index')->withToto($msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(Metier $metier)
    {
        $data =[
            'titre'=>'Métier de la ' . config('app.name'),
            'description' => 'Retourner un métier de la ' . config('app.name'),
            'metier' => $metier,
        ];
        // dd($data);
        return view('metiers/show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Metier $metier)
    {
        $data =[
            'titre'=>'Métier de la ' . config('app.name'),
            'description' => 'Retourner un métier de la ' . config('app.name'),
            'metier' => $metier,
        ];
        // dd($data);
        return view('metiers/edit', $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(MetierRequest $metierRequest, Metier $metier)
    {
        $valideData = $metierRequest->all();
        $metier->slug = Str::slug($valideData['libelle']);
        $metier->update($valideData);
        
        $msg = "Modification correctement effectuée.";
        return redirect()->Route('metiers.index')->withToto($msg);
    }


    // Fonction pour la fiche supprimer
    public function formDelete(Metier $metier)
    {
        $data =[
            'titre'=>'Métier de la ' . config('app.name'),
            'description' => 'Retourner un métier de la ' . config('app.name'),
            'metier' => $metier,
        ];
        // dd($data);
        return view('metiers/delete', $data);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
