<?php

namespace Bellal22\Comments\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class NewCommentForm extends Component
{
    public $user;
    public $model;
    public $modeldetails;

    /**
     * Create a new component instance.
     */
    public function __construct(Model $model,$modeldetails = [])
    {
        $this->user = auth()->user();
        $this->model = $model;
        $this->modeldetails = $modeldetails;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('comments::components.new-comment-form');
    }
}
