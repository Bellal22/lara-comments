<?php

namespace Bellal22\Comments\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Bellal22\Comments\Facades\ModelResolver;
use Bellal22\Comments\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends BaseController
{
    public function store(Request $request, $modelType, $modelId)
    {
        // Resolve model dynamically
        try {
            \DB::transaction(function()use($modelType,$modelId,$request){
                $modelClass = ModelResolver::resolve($modelType, $modelId);

                if (!$modelClass || !$modelClass::find($modelId)) {
                    return redirect()->back()->withErrors('Model not found.');
                }

                $model = $modelClass::find($modelId);
                // Validate the request
                $request->validate([
                    'content' => 'required|string',
                    'attachment' => 'nullable|array',
                    'attachment.*' => 'file'

                ]);

                // Create comment
                $model->addComment(
                    $request->input('content'),
                    auth()->id(),
                );
            });
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Comment failed. ' . $th->getMessage());
        }

        return redirect()->back()->with('success', 'Comment added.');
    }

    public function reply(Request $request, Comment $comment)
    {
        \DB::transaction(function()use($request,$comment){
            $request->validate([
                'content' => 'required|string',
            ]);

            Comment::create([
                'parent_id' => $comment->id,
                'user_id' => auth()->id(),
                'content' => $request->input('content'),
                'commentable_type' => $comment->commentable_type,
                'commentable_id' => $comment->commentable_id,
            ]);
        });

        return redirect()->back()->with('success', 'Reply added.');
    }

    public function destroy(Comment $comment)
    {
        if (auth()->id() !== $comment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted.');
    }
}
