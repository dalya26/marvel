@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Search Results</h1>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Thumbnail</th>
                </tr>
            </thead>
            <tbody>
                @forelse($characters as $character)
                <tr>
                    <td>{{ $character['name'] }}</td>
                    <td>{{ $character['description'] }}</td>
                    <td><img src="{{ $character['thumbnail']['path'] . '.' . $character['thumbnail']['extension'] }}" alt="{{ $character['name'] }}" width="50"></td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">No characters found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            @if($offset > 0)
                <a href="{{ url('characters/search?name=' . request('name') . '&offset=' . ($offset - 20)) }}" class="btn btn-secondary">Previous</a>
            @endif
            @if(count($characters) >= 20)
                <a href="{{ url('characters/search?name=' . request('name') . '&offset=' . ($offset + 20)) }}" class="btn btn-primary">Next</a>
            @endif
        </div>
    </div>
</div>
@endsection
