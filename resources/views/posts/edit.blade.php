@extends('layouts.app')

@section('title', 'Edit')

@section('content')
    <h1>Artikel Bewerken</h1>

    <form action="{{ route('post.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" value="{{ $post->title }}" required>
        <br>
        <label for="body">Tekst:</label>
        <textarea id="body" name="body" required>{{ $post->body }}</textarea>
        <br>
        <label for="image">Afbeelding toevoegen:</label>
        <input type="file" id="image" name="image">
        <br>

        @if ($post->image)
            <div style="margin-top: 10px;">
                <p>Huidige afbeelding:</p>
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="max-width: 200px;">
            </div>
        @endif

        <label for="categories">Kies categorieën:</label>
        <select id="categories" name="categories[]" multiple>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ in_array($category->id, $post->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <br>
        <label for="premium">Markeer als premium</label>
        <input type="checkbox" id="premium" name="premium" value=1 {{ $post->is_premium === 1 ? 'checked' : '' }}>
        <br>
        <button type="submit">Opslaan</button>
    </form>
@endsection