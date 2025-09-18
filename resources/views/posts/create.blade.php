@extends('layouts.app')

@section('title', 'Create')

@section('content')
    <h1>Nieuw Artikel Schrijven</h1>
    
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="body">Tekst:</label>
        <textarea id="body" name="body" required></textarea>
        <br>
        <label for="image">Afbeelding toevoegen:</label>
        <input type="file" id="image" name="image">
        <br>
        <label for="categories">Kies categorieën:</label>
        <select id="categories" name="categories[]" multiple>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <br>
        <label for="premium">Markeer als premium</label>
        <input type="checkbox" id="premium" name="premium" value=1>
        <br>
        <button type="submit">Opslaan</button>
    </form>
@endsection