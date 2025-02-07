<?php

return [
    /*
        |--------------------------------------------------------------------------
        | Commentables Configuration
        |--------------------------------------------------------------------------
        |
        | This array defines the list of models that can have comments associated
        | with them. Each entry should be added as a key-value pair, where the key
        | represents the model's identifier, and the value is the fully qualified
        | class name of the model.
        |
        | Example:
        | 'order' => Order::class,
        | 'post'  => Post::class,
        |
        | This allows flexibility in attaching comments to different models within
        | your application. Ensure that the specified models implement the necessary
        | commentable traits or relationships to work correctly.
        |
    */
    'commentables' => [
        // Define models that can have comments here
        // Example: 'order' => Order::class,
    ],
];
