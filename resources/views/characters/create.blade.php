<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marvel</title>
    <link rel="icon" href="https://getdrawings.com/vectors/marvel-vector-images-17.png">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="https://developer.marvel.com/">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b9/Marvel_Logo.svg/2560px-Marvel_Logo.svg.png" alt="" width="150" height="50" class="d-inline-block align-text-top">
            </a>
        </div>
    </nav>

    <div class="col-md-8 offset-md-2" style="margin-top: 100px;">
        
        <div class="card ">
            <div class="card-body border border-danger">
                <form action="{{ route('characters.index') }}" method="POST" enctype="multipart/form-data">
                <div class="card-header text-white bg-danger">    
                <h3>Nuevo personaje</h3>
                </div>
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripcion</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Foto del personaje</label>
                        <input type="file" name="thumbnail" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-outline-success mt-5 ">Aceptar</button>
                    <a href="{{ route('characters.index')}}" class="btn btn-outline-secondary mt-5">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>