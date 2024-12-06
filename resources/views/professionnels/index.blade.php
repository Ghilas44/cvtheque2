{{-- Directive de blade spécifiant l'héritage--}}
@extends ('cvtheque')

{{-- Directive de blade spécifiant l'injection du contenue de la section qui suit
        Le lien est réalisé avec la directive @yield()--}}
@section('contenu')
<div class="container mt-4">
        <h2>Liste des professionnels</h2>
        <select class="form-control border-primary" onchange="location.href=this.value">    
            <option value="{{route('professionnels.index')}}" @unless($slug) selected @endunless>        
                Tous les professionnels    
            </option>    
            @foreach($metiers as $metier)        
                <option value="{{route('professionnels.metier', ['slug'=>$metier->slug])}}"            
                {{($slug == $metier->slug) ? 'selected' : ''}}>           
                {{$metier->libelle}}        
                </option>    
            @endforeach
        </select>
        <a href="{{Route('professionnels.create')}}">    <button type="button" class="btn btn-outline-success float-end mt-3">Ajouter un professionnel</button>
        </a>
        @if(session('toto')) 
        <div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Nice! </strong>{{session('toto')}}
        </div>
        @endif
        <table id="professionnelsTable" class="table table-hover">
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Nom</th>
                    <th>Métier</th>
                    <th>Domiciliation</th>
                    <th>En formation</th>
                </tr>
            </thead>
            <tbody>
            @foreach($professionnels as $professionnel)
                <tr>
                    <td>{{ $professionnel->id }}</td>
                    <td>{{ $professionnel->nom }} {{ $professionnel->prenom }}</td>
                    <td>{{ $professionnel->metier->libelle }}</td>
                    <td>{{ $professionnel->cp }} {{ $professionnel->ville }}</td>
                    <td>{{ $professionnel->formation ? 'Oui' : 'Non' }}</td>
                    <td style="display: flex;">
                        <form action="{{Route('professionnels.show', $professionnel->id)}}" method="POST">
                            @method('GET')
                            @csrf
                            <button type="submit" class="btn btn-outline-primary">consulter</button>
                        </form>
                        <form action="{{Route('professionnels.edit', $professionnel->id)}}" method="POST">
                            @method('GET')
                            @csrf
                            <button type="submit" class="btn btn-outline-warning">Modifier</button>
                        </form>
                        <form action="{{Route('professionnels.delete', $professionnel->id)}}" method="POST">
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
