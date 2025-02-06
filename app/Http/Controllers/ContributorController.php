<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContributorController extends Controller
{
    public function index()
    {
        $contributors = User::withCount('chapters')
            ->orderByDesc('chapters_count')
            ->get()
            ->map(function ($user) {
                return [
                    'name' => $user->name,
                    'chapter_count' => $user->chapters_count,
                    'ranking' => $this->getRanking($user->chapters_count),
                ];
            });

        return response()->json($contributors);
    }

    private function getRanking($count)
    {
        if ($count >= 10) return 'Top Contributor';
        if ($count >= 5) return 'Active Contributor';
        return 'New Contributor';
    }
}

