@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6">
    <h1 class="text-2xl font-bold text-purple-700 mb-4">Create a New Story</h1>
    <form method="POST" action="{{ route('stories.store') }}" class="space-y-4">
        @csrf
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500" required>
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" rows="3" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500" required></textarea>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg shadow-md hover:bg-purple-700 transition">
                Create Story
            </button>
        </div>
    </form>
</div>
@endsection
