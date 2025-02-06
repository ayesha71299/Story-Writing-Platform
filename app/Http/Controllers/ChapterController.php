<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ChapterAdded;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Story;
use App\Models\Contribution;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{
    public function create(Story $story)
{
    if ($story->status !== 'published') {
        return redirect()->route('stories.show', $story->id)
                         ->with('error', 'Cannot add chapters to an unpublished story');
    }
    return view('chapters.create', compact('story'));
}

public function store(Request $request, Story $story)
{
    $request->validate([
        'title'   => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    if ($story->status !== 'published') {
        return redirect()->route('stories.show', $story->id)
                         ->with('error', 'Cannot add chapters to an unpublished story');
    }

    $chapter = Chapter::create([
        'story_id'   => $story->id,
        'user_id'    => Auth::id(),
        'title'      => $request->title,
        'content'    => $request->content,
        'word_count' => str_word_count($request->content),
    ]);

    // Send the notification with the chapter instance
    $users = User::all(); // Or use specific users who should receive the notification
    foreach ($users as $user) {
        $user->notify(new ChapterAdded($chapter)); // Pass the chapter object to the notification
    }
    return redirect()->route('stories.show', $chapter->story_id); // Corrected redirect
}

public function show($story_id, $chapter_id)
{
    $story = Story::findOrFail($storyId);
    $chapter = Chapter::findOrFail($chapterId);

    return view('chapters.show', compact('story', 'chapter'));
}
}
