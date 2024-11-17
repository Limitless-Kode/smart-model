# Laravel Smart Query

[![wakatime](https://wakatime.com/badge/github/Limitless-Kode/smart-model.svg)](https://wakatime.com/badge/github/Limitless-Kode/smart-model)

## Introduction

Smart-Query is a Laravel package that utilizes spatie-query-builder to enable smart queries with minimal configuration. With this package, you can create powerful, dynamic queries by simply adding the HasSmartQuery trait to your models.

## Installation

To install Smart-Query, you need to have a Laravel application set up. Then, you can install the package via composer by running the command:

```bash
composer require claver/smart-query
```

After installing the package, you need to register the `SmartQueryServiceProvider` in your `config > app.php`

```php
'providers' => [    
	...,    
	\Claver\SmartQuery\Providers\SmartQueryServiceProvider::class,    
	...
]
```

```bash
php artisan vendor:publish --provider="Spatie\\QueryBuilder\\QueryBuilderServicProvider" --tag="config"
```

This will publish the `query-builder.php` file to your `config` directory.

## Usage

To use Smart-Query, add the `HasSmartQuery` trait to any model you want to enable smart queries on.

```php
use Claver\SmartQuery\HasSmartQuery;

class User extends Model{    
	use HasSmartQuery;
}
```

This trait provides a `resolve` method, which you can use to apply smart queries to your model.
you can also `@override` the method name to any name if you do not like the name `resolve`

```php
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Claver\SmartQuery\HasSmartQuery;

class User extends Model{    
	use HasSmartQuery;
	
	public function customName(): LengthAwarePaginator|ResourceCollection
    {
        parent::resolve();
    }
}
```

Finally, you can call your custom method name or resolve if you didn't change the default name. 
```php
class UserController extends Controller{    
	public function index(Request $request){        
		$users = (new User())->resolve();        
		return response()->json($users);  
	}
}
```

The `smartQuery` method will apply any filters, sorts, includes, and fields specified in the query string to the model.

To learn more about how to make simple and advanced queries, visit [**Spatie-Query-Builder**](https://spatie.be/docs/laravel-query-builder/v5/features)

You do not have to create your own query builder every single time you need it. Just override these methods.

| Method | Description |
| --- | --- |
| getAllowedFilters | Returns an array that includes all the fields that could be filtered  |
| getAllowedIncludes | Returns an array that includes all the relationships that could be included  |
| getAllowedSorts | Returns an array that includes all the fields that could be sorted. you don't need to include this method because it's dynamically generated  |

## Conclusion

Smart-Query is a powerful package that simplifies creating dynamic queries in Laravel. By using the `HasSmartQuery` trait, you can take advantage of the `spatie-query-builder` package and create smart queries with minimal configuration.
