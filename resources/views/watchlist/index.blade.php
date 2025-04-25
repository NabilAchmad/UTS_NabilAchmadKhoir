@extends('layout.template')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">🎬 My Watch List</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form tambah film --}}
    <form method="POST" action="{{ route('watchlist.store') }}" class="mb-4">
        @csrf
        <div class="input-group">
            <input type="text" name="movie_title" class="form-control" placeholder="Enter movie title..." required>
            <input type="hidden" name="movie_id" value="{{ Str::uuid() }}"> {{-- Optional --}}
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>

    {{-- Tampilkan daftar film --}}
    @if ($watchlist->count())
        <ul class="list-group">
            @foreach ($watchlist as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $item->movie_title }}
                    <form action="{{ route('watchlist.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Remove</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted">You have no movies in your watchlist yet.</p>
    @endif
</div>
@endsection
