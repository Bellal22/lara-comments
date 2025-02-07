<?php

namespace Bellal22\Comments\Traits;

use Bellal22\Comments\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Commentable
{
    /**
     * Get all the comments for the model.
     *
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Add a comment to the model.
     *
     * @param string $content
     * @param int $userId
     * @param int|null $parentId
     * @return Comment
     */
    public function addComment(string $content, int $userId, int $parentId = null): Comment
    {
        return $this->comments()->create([
            'content' => $content,
            'user_id' => $userId,
            'parent_id' => $parentId,
        ]);
    }

    /**
     * Remove a comment from the model.
     *
     * @param Comment $comment
     * @return bool|null
     * @throws \Exception
     */
    public function removeComment(Comment $comment): ?bool
    {
        try {
            return $comment->delete();
        }catch (\Throwable $throwable){
            throw new \Exception("Unable to delete comment: ".$throwable->getMessage());
        }
    }

    /**
     * Get the count of comments for the model.
     *
     * @return int
     */
    public function commentCount(): int
    {
        return $this->comments()->count();
    }

    /**
     * Get the latest comments for the model.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function latestComments(int $limit = 5)
    {
        return $this->comments()->latest()->limit($limit)->get();
    }

    /**
     * Get the latest comments for the model.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allComments()
    {
        return $this->comments()->whereNull('parent_id')->get();
    }
}
