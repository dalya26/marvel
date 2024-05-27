<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marvel</title>
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
            </ul>

        </div>

    </nav>
    <div class="col-md-8 offset-md-2" style="margin-top: 50px;">
        <div class="card border border-danger ">
            <div class="container mt-4 mb-4">
                <div class="card-header text-white bg-danger">
                    <h3>Detalles del personaje</h3>
                </div>

                <div class="row">
                    <div class="card h-100">
                        <div class="row g-5">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $character->thumbnail) }}" alt="{{ $character->name }}" class="img-fluid">
                            </div>
                            <div class="col-md-5">
                                <div class="card-body">

                                    <h5 class="card-title">{{ $character->name }}</h5>
                                    <p class="card-text">{{ $character->description }}</p>

                                </div>

                            </div>
                            <div>
                                <a href="{{ route('characters.index')}}" class="btn btn-outline-info mt-6">Volver</a>
                                <a href="{{ route('characters.edit', $character->id) }}" class="btn btn-outline-warning">Editar</a>
                                <form action="{{ route('characters.destroy', $character->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" >Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>