@extends('layouts.app')

@section('title', 'Edit')

@section('content')
    <h1>Artikel Bewerken</h1>

    <form action="{{ route('user.update', ['user_id' => $user_id, 'post' => $post->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" value="{{ $post->title }}" required>
        <br>
        <label for="body">Tekst:</label>
        <textarea id="body" name="body" required>{{ $post->body }}</textarea>
        <br>
        <label for="categories">Kies categorieën:</label>
        <select id="categories" name="categories[]" multiple>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ in_array($category->id, $post->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <br>
        <button type="submit">Opslaan</button>
    </form>
@endsection