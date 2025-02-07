<?php

namespace Bellal22\Comments;

use Bellal22\Comments\Services\ModelResolver;
use Illuminate\Support\ServiceProvider;

class CommentsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/comments.php', 'comments');
        $this->app->singleton(\Bellal22\Comments\Facades\ModelResolver::class, function () {
            return new ModelResolver();
        });

        $this->app->alias(\Bellal22\Comments\Facades\ModelResolver::class, 'comment-model-resolver');

    }

    public function boot()
    {
        // Publish Config
        $this->publishes([
            __DIR__ . '/../config/comments.php' => config_path('comments.php'),
        ], 'comments-config');

        // Publish Migrations
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'comments-migrations');

        $this->publishes([
            __DIR__ . '/../resources/css' => public_path('vendor/comments/css'),
        ], 'comments-assets');

        // Load Views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'comments');

        // Load Routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Load Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Register Components
        $this->loadViewComponentsAs('comments', [
            \Bellal22\Comments\View\Components\CommentComponent::class,
            \Bellal22\Comments\View\Components\NewCommentForm::class,
        ]);
    }
}
