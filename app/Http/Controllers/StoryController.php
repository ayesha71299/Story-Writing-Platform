<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Story::query();
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'LIKE', "%{$search}%");
                  });
            });
        }
        $stories = $query->latest()->get();
        if ($request->wantsJson()) {
            return response()->json($stories);
        }
        return view('stories.index', compact('stories'));
    }

    public function create()
    {
        return view('stories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:stories,title',
            'description' => 'required|max:500',
        ]);
        $story = Story::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'status' => 'draft',
        ]);
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Story created successfully', 'story' => $story], 201);
        }
        return redirect()->route('stories.index')->with('success', 'Story created successfully.');
    }

    public function show(Request $request, Story $story)
    {
        if ($request->wantsJson()) {
            return response()->json($story);
        }
        return view('stories.show', compact('story'));
    }

    public function publish(Request $request, Story $story)
    {
        if (Auth::id() !== $story->user_id) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            return redirect()->back()->with('error', 'Unauthorized');
        }
        $story->update(['status' => 'published']);
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Story published successfully', 'story' => $story]);
        }
        return redirect()->route('stories.index')->with('success', 'Story published.');
    }
}

