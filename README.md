# Comments Package for Laravel

## Introduction
The **Comments Package** is a powerful and flexible solution for adding comment functionality to any Laravel project. Designed with scalability and ease of use in mind, it integrates seamlessly with Laravel's ecosystem.

This package allows users to add comments to any model in your application with minimal setup. It is ideal for building forums, blogs, ticketing systems, or any other application requiring a robust commenting system.

---

## Features

- **Eloquent Integration**: Easily attach comments to any model.
- **Soft Deletes**: Handle comment deletion without losing data.
- **Highly Configurable**: Customize behaviors via configuration files.
- **PSR-4 Autoloading**: Easy integration into Laravel projects.

---

## Requirements

- PHP 8.0+
- Laravel 8.x or later
---

## Installation

Install the package via Composer:

```bash
composer require bellal22/comments
```

---

## Configuration

### Publish Configuration File

Run the following command to publish the package's configuration file:

```bash
php artisan vendor:publish --tag=comments-config
php artisan vendor:publish --tag=comments-assets
```
This will create a `config/comments.php` file where you can customize the package's behavior.

### set Configuration

write your commentables Model classes in config file
```php
'commentables' => [
        // Define models that can have comments here
        // Example: 'order' => Order::class,
    ],
```


### Clear Configuration Cache

Run the following command to publish the package's configuration file:

```bash
php artisan config:clear
php artisan cache:clear
```



---

## Migrations

Publish and run the package's migrations to set up the required database tables:

```bash
php artisan vendor:publish --tag=comments-migrations
php artisan migrate
```

---

## Usage

### Setting Up Models

Add the `Commentable` trait to any model that you want to associate with comments:

```php
namespace App\Models;

use Bellal22\Comments\Traits\Commentable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Commentable;
}
```

### Adding Comments

You can add a comment to a model instance as follows:

```php
use App\Models\Post;
use Bellal22\Comments\Models\Comment;

$post = Post::find(1);
$comment = $post->addComment([
    'user_id' => auth()->id(),
    'content' => 'This is a great post!',
]);
```

### Retrieving Comments

Retrieve all comments associated with a model:

```php
$comments = $post->comments;
```

### Delete Comment

Delete specific Comment:

```php
$comments = $post->removeComment($comment);
```

### Other Methods

count all comments related to model:

```php
$comments = $post->commentCount();
```
get latest n comments (integer parameter) 5 is default:

```php
$comments = $post->latestComments();
```

retrieve comments without replies:

```php
$comments = $post->allComments();
```


---

## Blade Components

The package provides ready-to-use Blade components for managing and displaying comments.

### Comment Form

Include the comment form component in your Blade views:

```blade
<x-comments-new-comment-form :model="$post" />
```

### Comments List

Render a list of comments:

```blade
<x-comments-comment-component :comment="$comment" />
```

---

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or fix.
3. Submit a pull request with a detailed explanation of your changes.

---

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## Author

Developed and maintained by **Bellal Hassen**. Connect with me on [GitHub](https://github.com/Bellal22).

---

## Acknowledgments

- [Laravel Framework](https://laravel.com)

---
