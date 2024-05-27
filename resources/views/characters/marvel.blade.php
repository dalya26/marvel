<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marvel</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark nav d-flex">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b9/Marvel_Logo.svg/2560px-Marvel_Logo.svg.png" alt="" width="150" height="50" class="d-inline-block align-text-top">
            </a>


            <ul class="d-flex">

                <li class="nav-item">
                    <a class="nav-link text-white" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('characters.create') }}">Nuevo personaje</a>
                </li>
                <li>
                    <form class="d-flex" action="{{ route('characters.search') }}" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="name" value="{{ request('name') }}">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </li>
            </ul>

        </div>
    </nav>

    <div class=" container mt-5">
        <div class="col-md-12">
            <h1>Marvel Characters</h1>
            
            <div class="row">
            @forelse($characters as $character)
                <div class="col-md-5 mb-3">
                    <div class="card h-100">
                        <div class="row g-0">
                            <div class="col-md-5">
                            <img src="{{ $character['thumbnail']['path'] . '.' . $character['thumbnail']['extension'] }}" alt="{{ $character['name'] }}" width="200">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $character['name'] }}</h5>
                                    <p class="card-text">{{ $character['description'] }}</p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="mt-4">
                @if($offset > 0)
                <a href="{{ url('charactersm/' . ($offset - 20)) }}" class="btn btn-secondary">Previous</a>
                @endif
                <a href="{{ url('charactersm/' . ($offset + 20)) }}" class="btn btn-primary">Next</a>
            </div>
        </div>
    </div>

</body>

</html>