@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Leaderboard</h1>
    <ul class="list-group">
        @foreach($topContributors as $user)
            <li class="list-group-item">
                {{ $user->name }} - {{ $user->contributions_sum_word_count }} words
            </li>
        @endforeach
    </ul>
</div>
@endsection
