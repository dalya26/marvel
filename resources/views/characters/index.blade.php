<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marvel Personajes</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="https://developer.marvel.com/">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b9/Marvel_Logo.svg/2560px-Marvel_Logo.svg.png" alt="" width="150" height="50" class="d-inline-block align-text-top">
            </a>
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link text-white" href="/">Inicio</a>
                </li>
                <li>
                    <form class="d-flex" action="{{ route('characters.index') }}" method="get">
                        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" name="busqueda" value="{{ $busqueda ?? '' }}">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </li>
            </ul>

        </div>

    </nav>
    <div class="container mt-5">
        <h1>Marvel Personajes</h1>
        <a href="{{ route('characters.create') }}" class="btn btn-outline-warning mb-3">Nuevo personaje</a>

        <div class="row">
            @forelse($characters as $character)
            <div class="col-md-5 mb-3">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src="{{ asset('storage/' . $character->thumbnail) }}" alt="{{ $character->name }}" class="img-fluid">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title">{{ $character->name }}</h5>
                                <p class="card-text">{{ $character->description }}</p>
                                <a href="{{ route('characters.edit', $character->id) }}" class="btn btn-outline-warning">Editar</a>
                                <form action="{{ route('characters.destroy', $character->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" >Eliminar</button>
                                </form>
                                <a href="{{ route('characters.show', $character->id) }}" class="btn btn-outline-info">Ver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p>No characters found.</p>
            @endforelse
        </div>
        {{ $characters->links() }}
        
    </div>
</body>

</html>