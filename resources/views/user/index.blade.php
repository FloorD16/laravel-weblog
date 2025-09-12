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
                <tr onclick="" class="hover:bg-gray-100 cursor-pointer"
                    style="cursor: pointer;" onmouseover="this.style.color='#1b74bdff';" onmouseout="this.style.color='#000000ff';">
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td><a href="{{ route('user.edit', ['user_id' => $user_id, 'post_id' => $post->id]) }}">Bewerken</a></td>
                    <td>
                        <form action="{{ route('user.destroy', ['user_id' => $user_id, 'post' => $post->id]) }}" method="POST">
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