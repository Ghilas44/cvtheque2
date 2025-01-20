<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$description ?? ''}}">
    <title>{{$titre ?? ''}}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
        
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{Route('Accueil')}}">Accueil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
            <a class="nav-link" href="{{Route('competences.index')}}">Compétences</a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="{{Route('metiers.index')}}">Métiers</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{Route('professionnels.index')}}">Professionnels</a>
            </li>
        </ul>
        <form class="d-flex" action="{{ route('professionnels.index') }}" method="GET">
            <input class="form-control me-sm-2" type="search" placeholder="Par professionnel . . ."
                    name = "professionnel" value="{{ request('professionnel') }}">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Rechercher</button>
        </form>
        </div>
    </div>
    </nav>

    @yield('contenu')
</body>
</html>