<?php
namespace Bellal22\Comments\Facades;

use Illuminate\Support\Facades\Facade;

class ModelResolver extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ModelResolver::class;
    }
}
