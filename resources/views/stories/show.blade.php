@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-4xl p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-3xl font-bold text-gray-800">Title</h2>
    <p class="text-2xl font-semibold text-purple-700 mb-4">{{ $story->title }}</p>
    <h3 class="text-xl font-bold text-gray-800">Description</h3>
    <p class="text-gray-600 mb-6">{{ $story->description }}</p>
    <h3 class="text-xl font-bold text-gray-800 mb-3">Chapters</h3>
    @if($story->chapters->isEmpty())
        <p class="text-gray-500">No chapters yet. Be the first to contribute!</p>
    @else
    <ul class="border border-gray-300 rounded-lg divide-y">
        @foreach($story->chapters as $chapter)
            <li class="p-4 bg-gray-100">
                <p class="text-lg text-gray-700 font-semibold">{{ $chapter->title }}</p>
                <p class="text-gray-600">{{ $chapter->content }}</p>
                <p class="text-sm text-gray-500 mt-2">By {{ $chapter->user->name }}</p>
            </li>
        @endforeach
    </ul>
    @endif

    @if($story->status === 'published')
        <div class="mt-6 flex justify-end">
            <a href="{{ route('chapters.create', $story->id) }}"
                class="bg-purple-500 text-white px-6 py-2 rounded-lg hover:bg-purple-600">
                 Add a Chapter
             </a>
        </div>
    @endif
</div>
@endsection
