<?php

namespace Bellal22\Comments\View\Components;

use Bellal22\Comments\Models\Comment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class CommentComponent extends Component
{
    public $comment;
    public $user;

    /**
     * Create a new component instance.
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
        $this->user = auth()->user();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('comments::components.comment-component');
    }
}
