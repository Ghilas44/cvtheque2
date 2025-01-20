{{-- Directive de blade spécifiant l'héritage --}}
@extends('cvtheque')

{{-- Directive de blade spécifiant l'injection du contenu --}}
@section('contenu')
<form>
    <fieldset>
        <legend>Professionnel : {{ $professionnel->nom }} {{ $professionnel->prenom }}</legend>
    </fieldset>

    <!-- Email -->
    <div>
        <fieldset disabled="">
            <label class="form-label" for="disabledInput">Email</label>
            <input class="form-control" id="disabledInput" type="email" placeholder="{{ $professionnel->email }}" disabled="">
        </fieldset>
    </div>

    <!-- Téléphone -->
    <div>
        <fieldset disabled="">
            <label class="form-label" for="disabledInput">Téléphone</label>
            <input class="form-control" id="disabledInput" type="text" placeholder="{{ $professionnel->telephone }}" disabled="">
        </fieldset>
    </div>

    <!-- Code Postal et Ville -->
    <div>
        <fieldset disabled="">
            <label class="form-label" for="disabledInput">Adresse</label>
            <input class="form-control" id="disabledInput" type="text" placeholder="{{ $professionnel->cp }} {{ $professionnel->ville }}" disabled="">
        </fieldset>
    </div>

    <!-- Date de naissance -->
    <div>
        <fieldset disabled="">
            <label class="form-label" for="disabledInput">Date de naissance</label>
            <input class="form-control" id="disabledInput" type="text" placeholder="{{ $professionnel->naissance }}" disabled="">
        </fieldset>
    </div>

    <!-- Métier -->
    <div>
        <fieldset disabled="">
            <label class="form-label" for="disabledInput">Métier</label>
            <input class="form-control" id="disabledInput" type="text" placeholder="{{ $professionnel->metier->libelle }}" disabled="">
        </fieldset>
    </div>

    <!-- Formation -->
    <div>
        <fieldset disabled="">
            <label class="form-label" for="disabledInput">En formation</label>
            <input class="form-control" id="disabledInput" type="text" placeholder="{{ $professionnel->formation ? 'Oui' : 'Non' }}" disabled="">
        </fieldset>
    </div>

    <!-- Domaine -->
    <div>
        <fieldset disabled="">
            <label class="form-label" for="disabledInput">Domaine</label>
            <input class="form-control" id="disabledInput" type="text" placeholder="{{ implode(', ', explode(',', $professionnel->domaine)) }}" disabled="">
        </fieldset>
    </div>

    <!-- Dates de création et de modification -->
    <div>
        <fieldset disabled="">
            <label class="form-label" for="disabledInput">Date de création</label>
            <input class="form-control" id="disabledInput" type="text" placeholder="{{ $professionnel->created_at }}" disabled="">
        </fieldset>
    </div>

    <div>
        <fieldset disabled="">
            <label class="form-label" for="disabledInput">Date de modification</label>
            <input class="form-control" id="disabledInput" type="text" placeholder="{{ $professionnel->updated_at ?? 'Pas de date...' }}" disabled="">
        </fieldset>
    </div>
    <div>
        <label class="form-label" for="disabledInput">Compétences :</label>
        @if($professionnel->competences->isNotEmpty())
            <ul>
                @foreach($professionnel->competences as $competence)
                    <li>{{ $competence->intitule }}</li>
                @endforeach
            </ul>
        @else
            <p>Aucune compétence associée.</p>
        @endif
    </div>
    <br>
    <div>
        <a href="{{ Route('professionnels.index') }}" class="btn btn-outline-primary">Retour</a>
    </div>
</form>
@endsection
