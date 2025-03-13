<?php
// app/Policies/ArticlePolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;

class ArticlePolicy
{
    /**
     * Determine if the given article can be created by the user.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        // 9dari tsayb 3la l-logic dyal user wach y9dr ydir create
        return $user->role === 'admin'; // F had tariqa li kaymchi
    }

    /**
     * Determine if the given article can be updated by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Article  $article
     * @return bool
     */
    public function update(User $user, Article $article)
    {
        return $user->id === $article->user_id || $user->role === 'admin';
    }

    /**
     * Determine if the given article can be deleted by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Article  $article
     * @return bool
     */
    public function delete(User $user, Article $article)
    {
        return $user->id === $article->user_id || $user->role === 'admin';
    }
}
