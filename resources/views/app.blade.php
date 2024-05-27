<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARVEL</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="https://getdrawings.com/vectors/marvel-vector-images-17.png">
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
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10">
                <img src="https://i0.wp.com/jediyuth.com/wp-content/uploads/2015/04/avengers-2-banner.jpg?ssl=1" class="d-block w-100">
                <div class="carousel-caption d-none d-md-block text-white">
                    <h1 class="lead display-5" > <strong>Bienvenido al mundo de Marvel </strong></h1>
                    <br>
                    <a href="{{ route('characters.sync') }}" class="btn btn-outline-danger">Personajes de Marvel</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>