# Laravel Smart Query

## Introduction

Smart-Query is a Laravel package that utilizes spatie-query-builder to enable smart queries with minimal configuration. With this package, you can create powerful, dynamic queries by simply adding the HasSmartQuery trait to your models.

## Installation

To install Smart-Query, you need to have a Laravel application set up. Then, you can install the package via composer by running the command:

```bash
composer require claver/smart-query:@dev
```

After installing the package, you need to register the `SmartQueryServiceProvider` in your `config > app.php`
##
```php
'providers' => [
    ...,
    \Claver\SmartQuery\SmartQueryServiceProvider::class,
    ...
]
```
##
```bash
php artisan vendor:publish --provider="Spatie\\QueryBuilder\\QueryBuilderServiceProvider" --tag="config"
```

This will publish the `query-builder.php` file to your `config` directory.

## Usage

To use Smart-Query, add the `HasSmartQuery` trait to any model you want to enable smart queries on.

```php
use Claver\SmartQuery\HasSmartQuery;

class User extends Model
{
    use HasSmartQuery;
}
```

This trait provides a `scopeSmartQuery` method, which you can use to apply smart queries to your model.

```php
use Claver\SmartQuery\HasSmartQuery;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = (new User())->resolve();
        return view('users.index', compact('users'));
    }
}
```

The `smartQuery` method will apply any filters, sorts, includes, and fields specified in the query string to the model.

## Conclusion

Smart-Query is a powerful package that simplifies creating dynamic queries in Laravel. By using the `HasSmartQuery` trait, you can take advantage of the spatie-query-builder package and create smart queries with minimal configuration.
