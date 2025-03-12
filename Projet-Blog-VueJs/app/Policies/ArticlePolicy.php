<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user != null; 
    }

    public function update(User $user, Article $article)
    {
        return $user->id === $article->user_id; 
    }

    public function delete(User $user, Article $article)
    {
        return $user->id === $article->user_id; 
    }
}
