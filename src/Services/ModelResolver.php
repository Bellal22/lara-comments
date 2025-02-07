<?php
namespace Bellal22\Comments\Services;

use Bellal22\Comments\Models\Comment;
use Illuminate\Support\Str;

class ModelResolver
{
    public static function resolve($modelType, $modelId)
    {
        $modelClass = config('comments.commentables.' . Str::lower($modelType));

        return class_exists($modelClass) ? $modelClass::find($modelId) : null;
    }
}
