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
    <nav class="navbar navbar-dark bg-dark nav justify-content-center " >
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
        </ul>
    </nav>
    <div class="col-md-12">
        <h1>Marvel Personajes</h1>
        <a href="{{ route('characters.create') }}" class="btn btn-primary">Add Character</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Thumbnail</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($characters as $character)
                <tr>
                    <td>{{ $character->name }}</td>
                    <td>{{ $character->description }}</td>
                    <td><img src="{{ asset('storage/' . $character->thumbnail) }}" alt="{{ $character->name }}" width="200">
                    <td>
                        <a href="{{ route('characters.edit', $character->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('characters.destroy', $character->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No characters found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
</body>

</html>