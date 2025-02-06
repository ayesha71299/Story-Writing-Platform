@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-4xl p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Add a New Chapter</h2>

    <form method="POST" action="{{ route('chapters.store', $story) }}">
        @csrf
        <div class="mb-3">
            <label class="block text-gray-700 font-semibold">Chapter Title</label>
            <input type="text" name="title" class="form-control border rounded-lg p-2 w-full" required>
        </div>

        <div class="mb-3">
            <label class="block text-gray-700 font-semibold">Chapter Content</label>
            <textarea name="content" class="form-control border rounded-lg p-2 w-full" rows="4" required></textarea>
        </div>

        <button type="submit" class="bg-purple-500 text-white px-6 py-2 rounded-lg hover:bg-purple-600">
            Submit Chapter
        </button>
    </form>
</div>
@endsection
