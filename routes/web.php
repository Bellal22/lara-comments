<?php

use Bellal22\Comments\Http\Controllers\CommentController;


Route::middleware(['web'])->group(function () {
    Route::post('comments/store/{modelType}/{modelId}', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::post('comments/reply/store/{comment}', [CommentController::class, 'reply'])
        ->name('comments.reply');
});


?>
