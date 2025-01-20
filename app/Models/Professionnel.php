<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professionnel extends Model
{
    use HasFactory;

    protected $fillable = [
        'prenom', 
        'nom', 
        'cp',
        'ville',
        'telephone',
        'email',
        'naissance',
        'formation',
        'domaine',
        'source',
        'observation', 
        'metier_id',
        'cv',
    ];

    function metier(){
        return $this->belongsTo(Metier::class);
    }

    /**
     * Un professionnel (model) est partagé par plusieurs (belongsToMany) compétences
     * Récupération de toutes les compétences qui ont tel ou tel(s) professionnel(s)
     * -> withTimestamps pour la gestion des propriétés appartenant à la relation
     */
    public function competences(){

        return $this->belongsToMany(Competence::class)->withTimestamps();
    }
}
