{{-- Directive de blade spécifiant l'héritage--}}
@extends ('cvtheque')

{{-- Directive de blade spécifiant l'injection du contenue de la section qui suit
        Le lien est réalisé avec la directive @yield()--}}
@section('contenu')
<div class="container mt-4">
        <h2>Liste des compétences</h2>
        <div>
            <form class="d-flex mb-3" action="{{ route('competences.index') }}" method="GET">
                <input 
                    class="form-control me-sm-2" 
                    type="text" 
                    name="search" 
                    placeholder="Rechercher une compétence..." 
                    value="{{ old('search', $search) }}"> <!-- Garde la recherche en cours -->
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Rechercher</button>
            </form>
        </div>
        <a href="{{Route('competences.create')}}"><button type="button" class="btn  btn-outline-success">Créer une compétence</button>
        </a>
        @if(session('toto')) 
        <div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Nice! </strong>{{session('toto')}}
        </div>
        @endif
        <table id="competencesTable" class="table table-hover">
            <thead>
                <tr>
                    <th>Intitulé</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($competences as $competence)
                <tr>
                    <td>{{ $competence->intitule }}</td>
                    <td>{{ $competence->created_at }}</td>
                    <td style="display: flex;">
                        <form action="{{Route('competences.show', $competence->id)}}" method="POST">
                            @method('GET')
                            @csrf
                            <button type="submit" class="btn btn-outline-primary">consulter</button>
                        </form>
                        <form action="{{Route('competences.edit', $competence->id)}}" method="POST">
                            @method('GET')
                            @csrf
                            <button type="submit" class="btn btn-outline-warning">Modifier</button>
                        </form>
                        <form action="{{Route('DeleteSkill', $competence->id)}}" method="POST">
                            @method('GET')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Aucune compétence trouvée.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
