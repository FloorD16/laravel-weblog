@extends('layouts.app')

@section('title', 'My Posts')

@section('content')

    <h1>Mijn Artikelen</h1>

    <table>
        <thead>
            <tr>
                <th>Titel</th>
                <th></th>
                <th>Plaatsingsdatum</th>
                <th colspan=2>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr onclick="window.location='{{ route('posts.show', $post->id) }}'" class="hover:bg-gray-100 cursor-pointer"
                    style="cursor: pointer;" onmouseover="this.style.color='#1b74bdff';" onmouseout="this.style.color='#000000ff';">
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td><a href="{{ route('post.edit', ['post' => $post->id]) }}">Bewerken</a></td>
                    <td>
                        <form action="{{ route('post.destroy', ['post' => $post->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Weet je zeker dat je deze post wilt verwijderen?')">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection