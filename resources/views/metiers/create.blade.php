{{-- Directive de blade spécifiant l'héritage--}}
@extends ('cvtheque')

{{-- Directive de blade spécifiant l'injection du contenue de la section qui suit
        Le lien est réalisé avec la directive @yield()--}}
@section('contenu')
<form action ="{{ Route('metiers.store')}}" method="POST">
    @method('POST')
    @csrf
    <fieldset>
        <legend>Création d'un nouveau Métier : </legend>
    </fieldset>
 
    <div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('libelle') is-invalid @enderror" id="libelle" name="libelle" placeholder="name@example.com" value="{{old('libelle')}}">
            @error('libelle')
            <p class = "text-danger" role="alert">{{$message}}</p>
            @enderror
            <label for="floatingInput">Libellé</label>
        </div>  
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="name@example.com" value="{{old('description')}}"/>
            @error('description')
            <p class = "text-danger" role="alert">{{$message}}</p>
            @enderror
            <label for="floatingInput">Description</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="name@example.com" value="{{old('slug')}}"/>
            @error('slug')
            <p class = "text-danger" role="alert">{{$message}}</p>
            @enderror
            <label for="floatingInput">Slug</label>
        </div>
        <div>
            <a href="{{Route('metiers.index')}}" class="btn btn-outline-primary">Retour</a>
            <button type="submit" class="btn btn btn-outline-success">Créer</button>
        </div>
    </div>

</form>
@endsection