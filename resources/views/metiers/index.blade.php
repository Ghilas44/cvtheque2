{{-- Directive de blade spécifiant l'héritage--}}
@extends ('cvtheque')

{{-- Directive de blade spécifiant l'injection du contenue de la section qui suit
        Le lien est réalisé avec la directive @yield()--}}
@section('contenu')
<div class="container mt-4">
        <h2>Liste des métiers</h2>
        <a href="{{Route('metiers.create')}}"><button type="button" class="btn  btn-outline-success">Créer un métier</button>
        </a>
        @if(session('toto')) 
        <div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Nice! </strong>{{session('toto')}}
        </div>
        @endif
        <table id="metiersTable" class="table table-hover">
            <thead>
                <tr>
                    <th>Libellé</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($metiers as $metier)
                <tr>
                    <td>{{ $metier->libelle }}</td>
                    <td>{{ $metier->created_at }}</td>
                    <td style="display: flex;">
                        <form action="{{Route('metiers.show', $metier->id)}}" method="POST">
                            @method('GET')
                            @csrf
                            <button type="submit" class="btn btn-outline-primary">consulter</button>
                        </form>
                        <form action="{{Route('metiers.edit', $metier->id)}}" method="POST">
                            @method('GET')
                            @csrf
                            <button type="submit" class="btn btn-outline-warning">Modifier</button>
                        </form>
                        <form action="{{Route('DeleteJob', $metier->id)}}" method="POST">
                            @method('GET')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
