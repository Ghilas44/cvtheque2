{{-- Directive de blade spécifiant l'héritage --}}
@extends('cvtheque')

{{-- Directive de blade spécifiant l'injection du contenu de la section --}}
@section('contenu')
<form action="{{ Route('professionnels.destroy' , ['professionnel'=>$professionnel->id]) }}" method="POST">
    @method('DELETE')
    @csrf
    <fieldset>
        <legend>Suppression d'un Professionnel :</legend>
    </fieldset>

    <div>
        <!-- Nom -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" placeholder="Nom" value="{{ old('nom', $professionnel->nom) }}">
            @error('nom')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
            <label for="nom">Nom</label>
        </div>

        <!-- Prénom -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" placeholder="Prénom" value="{{ old('prenom', $professionnel->prenom) }}">
            @error('prenom')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
            <label for="prenom">Prénom</label>
        </div>

        <!-- Code postal -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('cp') is-invalid @enderror" id="cp" name="cp" placeholder="Code postal" value="{{ old('cp', $professionnel->cp) }}">
            @error('cp')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
            <label for="cp">Code Postal</label>
        </div>

        <!-- Ville -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('ville') is-invalid @enderror" id="ville" name="ville" placeholder="Ville" value="{{ old('ville', $professionnel->ville) }}">
            @error('ville')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
            <label for="ville">Ville</label>
        </div>

        <!-- Téléphone -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" placeholder="Téléphone" value="{{ old('telephone', $professionnel->telephone) }}">
            @error('telephone')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
            <label for="telephone">Téléphone</label>
        </div>

        <!-- Email -->
        <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email', $professionnel->email) }}">
            @error('email')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
            <label for="email">Email</label>
        </div>

        <!-- Date de naissance -->
        <div class="form-floating mb-3">
            <input type="date" class="form-control @error('naissance') is-invalid @enderror" id="naissance" name="naissance" value="{{ old('naissance', $professionnel->naissance) }}">
            @error('naissance')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
            <label for="naissance">Date de naissance</label>
        </div>

        <!-- Métier (sélection) -->
        <div class="form-floating mb-3">
            <select class="form-select @error('metier_id') is-invalid @enderror" id="metier_id" name="metier_id">
                <!-- Option par défaut : métier actuel -->
                <option value="{{ $professionnel->metier_id }}" selected>{{ $professionnel->metier->libelle }}</option>
                
                <!-- Liste des autres métiers -->
                @foreach($metiers as $metier)
                    @if($metier->id != $professionnel->metier_id) <!-- Éviter de répéter le métier actuel -->
                        <option value="{{ $metier->id }}" {{ old('metier_id') == $metier->id ? 'selected' : '' }}>
                            {{ $metier->libelle }}
                        </option>
                    @endif
                @endforeach
            </select>
            @error('metier_id')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
            <label for="metier_id">Métier</label>
        </div>


        <!-- Formation -->
        <legend>En formation ?</legend>
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check @error('formation') is-invalid @enderror" name="formation" id="formation1" value="1" 
                {{ old('formation', $professionnel->formation) == 1 ? 'checked' : '' }}>
            <label class="btn btn-outline-primary" for="formation1">Oui</label>

            <input type="radio" class="btn-check @error('formation') is-invalid @enderror" name="formation" id="formation2" value="0" 
                {{ old('formation', $professionnel->formation) == 0 ? 'checked' : '' }}>
            <label class="btn btn-outline-primary" for="formation2">Non</label>

            @error('formation')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <!-- Domaine -->
        <legend>Domaine :</legend>
        <div class="mb-3">
            <div class="btn-group" role="group" aria-label="Domaine">
                @foreach(['R' => 'Réseaux', 'S' => 'Sécurité', 'D' => 'Développement'] as $value => $label)
                    <input type="checkbox" 
                        class="btn-check @error('domaine') is-invalid @enderror" 
                        id="domaine{{ $value }}" 
                        name="domaine[]" 
                        value="{{ $value }}" 
                        {{ (is_array(old('domaine', explode(',', $professionnel->domaine))) && in_array($value, old('domaine', explode(',', $professionnel->domaine)))) ? 'checked' : '' }}>
                    <label class="btn btn-primary" for="domaine{{ $value }}">{{ $label }}</label>
                @endforeach
            </div>
            @error('domaine')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-3">
            <a href="{{ Route('professionnels.index') }}" class="btn btn-outline-primary">Retour</a>
            <button type="submit" class="btn btn-outline-danger">Supprimer</button>
        </div>
    </div>
</form>
@endsection
