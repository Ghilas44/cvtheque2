{{-- Directive de blade spécifiant l'héritage --}}
@extends('cvtheque')

{{-- Directive de blade spécifiant l'injection du contenu de la section --}}
@section('contenu')
<form action="{{ Route('professionnels.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <fieldset>
        <legend>Création d'un nouveau Professionnel :</legend>
    </fieldset>

    <div>
        <!-- Nom -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" placeholder="Nom" value="{{ old('nom') }}">
            @error('nom')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
            <label for="nom">Nom</label>
        </div>

        <!-- Prénom -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" placeholder="Prénom" value="{{ old('prenom') }}">
            @error('prenom')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
            <label for="prenom">Prénom</label>
        </div>

        <!-- Code postal -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('cp') is-invalid @enderror" id="cp" name="cp" placeholder="Code postal" value="{{ old('cp') }}">
            @error('cp')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
            <label for="cp">Code Postal</label>
        </div>

        <!-- Ville -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('ville') is-invalid @enderror" id="ville" name="ville" placeholder="Ville" value="{{ old('ville') }}">
            @error('ville')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
            <label for="ville">Ville</label>
        </div>

        <!-- Téléphone -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" placeholder="Téléphone" value="{{ old('telephone') }}">
            @error('telephone')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
            <label for="telephone">Téléphone</label>
        </div>

        <!-- Email -->
        <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
            @error('email')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
            <label for="email">Email</label>
        </div>

        <!-- Date de naissance -->
        <div class="form-floating mb-3">
            <input type="date" class="form-control @error('naissance') is-invalid @enderror" id="naissance" name="naissance" value="{{ old('naissance') }}">
            @error('naissance')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
            <label for="naissance">Date de naissance</label>
        </div>

        <!-- Métier (sélection) -->
        <div class="form-floating mb-3">
            <select class="form-select @error('metier_id') is-invalid @enderror" id="metier_id" name="metier_id">
                <option value="">Sélectionnez un métier</option>
                @foreach($metiers as $metier)
                    <option value="{{ $metier->id }}" {{ old('metier_id') == $metier->id ? 'selected' : '' }}>
                        {{ $metier->libelle }}
                    </option>
                @endforeach
            </select>
            @error('metier_id')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
            <label for="metier_id">Métier</label>
        </div>
        <div>
            <label for="formFile" class="form-label mt-4">CV à faire parcourir</label>
            <input class="form-control" type="file" id="formFile" name="cv">
        </div>
        <div>
            <label for="exampleSelect2" class="form-label mt-4">Compétences</label>
            <select multiple class="form-select @error('competence_id') is-invalid @enderror" id="competence_id" name="competence_id[]">
                @foreach($competences as $competence)
                    <option value="{{ $competence->id }}" {{ in_array($competence->id, old('competence_id', [])) ? 'selected' : '' }}>
                        {{ $competence->intitule }}
                    </option>
                @endforeach
            </select>
        </div>
        <!-- Formation -->
        <legend>En formation ?</legend>
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check @error('formation') is-invalid @enderror" name="formation" id="formation1" value="1" {{ old('formation') == 1 ? 'checked' : '' }}>
            <label class="btn btn-outline-primary" for="formation1">Oui</label>
            <input type="radio" class="btn-check @error('formation') is-invalid @enderror" name="formation" id="formation2" value="0" {{ old('formation') == 0 ? 'checked' : '' }}>
            <label class="btn btn-outline-primary" for="formation2">Non</label>
            @error('formation')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <!-- Domaine -->
        <legend>Domaine :</legend>
        <div class="mb-3">
            <div class="btn-group" role="group" aria-label="Domaine">
                @foreach(['S' => 'Réseaux', 'R' => 'Sécurité', 'D' => 'Développement'] as $value => $label)
                    <input type="checkbox" class="btn-check @error('domaine') is-invalid @enderror" id="domaine{{ $value }}" name="domaine[]" value="{{ $value }}" {{ is_array(old('domaine')) && in_array($value, old('domaine')) ? 'checked' : '' }}>
                    <label class="btn btn-primary" for="domaine{{ $value }}">{{ $label }}</label>
                @endforeach
            </div>
            @error('domaine')
            <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-3">
            <a href="{{ Route('professionnels.index') }}" class="btn btn-outline-primary">Retour</a>
            <button type="submit" class="btn btn-outline-success">Créer</button>
        </div>
    </div>
</form>
@endsection
