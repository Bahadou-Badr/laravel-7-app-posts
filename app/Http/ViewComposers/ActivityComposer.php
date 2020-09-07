<?php

namespace App\Http\ViewComposers;

use App\Post;
use App\User;
use Illuminate\View\View;

class ActivityComposer {
    public function compose(View $view) {
        $mostCommented = Post::mostCommented()->take(5)->get();
        $activeUsers = User::activeUsers()->take(5)->get();
        $activeUsersLastMonth = User::usersActiveInLastMonth()->take(5)->get();

        $view->with([
            'mostCommented' => $mostCommented,
            'activeUsers' => $activeUsers,
            'activeUsersLastMonth' => $activeUsersLastMonth

        ]);
    }
}
