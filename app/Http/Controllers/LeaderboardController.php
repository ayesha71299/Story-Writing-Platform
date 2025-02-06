<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contribution;

class LeaderboardController extends Controller
{
    public function index()
    {
        $topContributors = User::withSum('contributions', 'word_count')
            ->orderByDesc('contributions_sum_word_count')
            ->take(10)
            ->get();

        return view('leaderboard', compact('topContributors'));
    }
}
