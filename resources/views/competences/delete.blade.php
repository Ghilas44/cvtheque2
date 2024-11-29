{{-- Directive de blade spécifiant l'héritage--}}
@extends ('cvtheque')

{{-- Directive de blade spécifiant l'injection du contenue de la section qui suit
        Le lien est réalisé avec la directive @yield()--}}
@section('contenu')
<form action ="{{ Route('competences.destroy', ['competence'=>$competence->id])}}" method="POST">
    @method('DELETE')
    @csrf
    <fieldset>
        <legend>Suppression de la compétence : {{$competence->intitule}}</legend>
    </fieldset>
 
    <div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('intitule') is-invalid @enderror" id="intitule" name="intitule" placeholder="name@example.com" value="{{old('intitule', $competence->intitule)}}">
            @error('intitule')
            <p class = "text-danger" role="alert">{{$message}}</p>
            @enderror
            <label for="floatingInput">Intitulé</label>
        </div>  
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="name@example.com" value="{{old('description',$competence->description)}}"/>
            @error('description')
            <p class = "text-danger" role="alert">{{$message}}</p>
            @enderror
            <label for="floatingInput">Description</label>
        </div>
        <div>
            <a href="{{Route('competences.index')}}" class="btn btn-outline-primary">Retour</a>
            <button type="submit" class="btn btn-outline-danger">Supprimer</button>
        </div>
    </div>

</form>
@endsection