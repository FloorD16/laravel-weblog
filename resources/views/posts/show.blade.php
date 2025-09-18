@extends('layouts.app')

@section('title', 'Post')

@section('content')

    <h1>{{ $post->title }}</h1>

    <h5>Geplaatst op {{ $post->created_at }}, geüpdatet op {{ $post->updated_at }}</h5>
    <h5>Door {{ $post->user->username }}</h5>

    <p>{{ $post->body }}</p>

    @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
    @endif


    <h3>Reacties</h3>

    <table>
        <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->body }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <form action="{{ route('comments.store', $post->id) }}" method="POST">
        @csrf
        <label for="body">Reactie:</label>
        <textarea id="body" name="body" required></textarea>
        <br><br>
        <button type="submit">Plaats reactie</button>
    </form>

@endsection