@extends('layouts.app')

@section('title', 'Edit')

@section('content')
    <h1>Artikel Bewerken</h1>

    <form action="{{ route('user.update', ['user_id' => $user_id, 'post_id' => $post->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" value="{{ $post->title }}" required>
        <br>
        <label for="body">Tekst:</label>
        <textarea id="body" name="body" required>{{ $post->body }}</textarea>
        <br>
        <button type="submit">Opslaan</button>
    </form>
@endsection