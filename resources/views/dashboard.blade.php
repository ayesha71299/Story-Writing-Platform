@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-6xl p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">All Stories</h2>

    @if($stories->isEmpty())
        <p class="text-gray-500">No stories available.</p>
    @else
        <div class="space-y-6">
            @foreach($stories as $story)
                <div class="p-6 border border-gray-300 rounded-lg shadow-sm">
                    <h3 class="text-2xl font-bold text-purple-700">{{ $story->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ $story->description }}</p>

                    <h4 class="text-lg font-semibold text-gray-800">Chapters:</h4>
                    @if($story->chapters->isEmpty())
                        <p class="text-gray-500">No chapters yet.</p>
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
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
