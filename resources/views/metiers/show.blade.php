{{-- Directive de blade spécifiant l'héritage--}}
@extends ('cvtheque')

{{-- Directive de blade spécifiant l'injection du contenue de la section qui suit
        Le lien est réalisé avec la directive @yield()--}}
@section('contenu')
<form>
    <fieldset>
        <legend>Métier : {{$metier->libelle}}</legend>
    </fieldset>
    <div>
    <fieldset disabled="">
        <label class="form-label" for="disabledInput">Description</label>
        <input class="form-control" id="disabledInput" type="text" placeholder="{{$metier->description}}" disabled="">
    </fieldset>
    </div>
    <div>
    <fieldset disabled="">
        <label class="form-label" for="disabledInput">Slug</label>
        <input class="form-control" id="disabledInput" type="text" placeholder="{{$metier->slug}}" disabled="">
    </fieldset>
    </div>
    <div>
    <fieldset disabled="">
        <label class="form-label" for="disabledInput">Date de création</label>
        <input class="form-control" id="disabledInput" type="text" placeholder="{{$metier->created_at}}" disabled="">
    </fieldset>
    </div>  
    <div>
    <fieldset disabled="">
        <label class="form-label" for="disabledInput">Date de modification</label>
        <input class="form-control" id="disabledInput" type="text" placeholder="{{$metier->updated_at ?? 'Pas de date...'}}" disabled="">
    </fieldset>
    </div>
    <br>   
    <div>
        <a href="{{Route('metiers.index')}}" class="btn btn-outline-primary">Retour</a>
    </div>
</form>
@endsection