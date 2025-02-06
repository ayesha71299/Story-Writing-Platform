@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold text-gray-800">Welcome to the Story App</h1>
        <p class="mt-2 text-gray-600">Start creating collaborative stories today!</p>
    </div>
    <div class="container">
        <h1 class="text-[#6A0DAD] font-bold">Stories</h1>

        <!-- Search Form -->
        <form action="{{ route('stories.index') }}" method="GET" class="mb-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search stories..."
                   class="border rounded-lg p-2 w-1/3">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Search</button>
        </form>
        <a href="{{ route('stories.create') }}" class="btn bg-purple-500 text-white py-2 px-4 rounded-full">Create Story</a>
        <ul class="list-group mt-3">
            @foreach($stories as $story)
                <li class="list-group-item flex justify-between items-center">
                    <a href="{{ route('stories.show', $story->id) }}">{{ $story->title }}</a>

                    @if($story->status === 'published')
                        <span class="badge bg-green-500 text-white text-xs py-1 px-2 rounded-full">
                            <i class="fas fa-check-circle"></i> Published
                        </span>
                    @elseif($story->status === 'draft')
                        <span class="badge bg-yellow-500 text-white text-xs py-1 px-2 rounded-full">
                            <i class="fas fa-pencil-alt"></i> Draft
                        </span>
                    @endif
                    @if(auth()->id() === $story->user_id && $story->status === 'draft')
                        <form action="{{ route('stories.publish', $story->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Publish</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endsection
