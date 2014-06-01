# µMVC

The goal is to provide a **bare essentials**, loosely coupled approach to the often bulky solutions like CakePHP, Symfony and even CodeIgniter.

µMVC comes with one easy config file, optional PDO database connection and just three helper methods. All while still **providing core features** like view caching, custom URL routing and error pages.

http://rick-stevens.github.io/umvc/

## Requirements

* PHP >= 5.3.0 ([PDO](http://php.net/manual/en/book.pdo.php), [ReflectionClass](http://www.php.net/manual/en/class.reflectionclass.php) and [object model](http://php.net/manual/en/language.oop5.php))
* .htaccess privilege ([AllowOverride All](http://httpd.apache.org/docs/current/mod/core.html#allowoverride))
* Apache's [mod\_rewrite](http://httpd.apache.org/docs/current/mod/mod_rewrite.html)
* A (sub)domain name

## Installing

1. [Download](https://github.com/rick-stevens/umvc/archive/master.zip) and extract the latest copy of µMVC.
2. Make all subfolders of `/system/tmp/` writable (chmod).
3. Modify `/app/configs/config.php` (optional).

## Documentation

### Controllers

File syntax: `/app/controllers/examplename.php` (lowercase filename).  
Class syntax: `class ExampleName extends Controller {}`.

* `$this->view->save( $key [, $value = NULL ] )` saves a view variable (or set of variables when `$key` is an associative array).
* `$this->view->display( $file_name [, $caching = FALSE [, $cache_id = NULL ]] )` prints the view upon destruct.
* `$this->view->fetch( $file_name [, $caching = FALSE [, $cache_id = NULL ]] )` returns the view.
* `$this->view->isCached( $file_name [, $cache_id = NULL ] )` checks if the view is cached.
* `$this->view->clearCache( [ $file_name = NULL [, $cache_id = NULL ]] )` deletes the given view's cache or entire cache directory.

### Models

File syntax: `/app/models/*.php`.  
Class syntax: `class * extends Model {}`.

Use `$this->db` ([PDO instance](http://php.net/manual/en/class.pdo.php)) for database access. Enable this by uncommenting the `$config['db']` lines in `/app/configs/config.php`.

### Views

File syntax: `/app/views/*.php`.  
To access the config variables in views use `$config` (instead of `MVC::$config`).

The following 4 replacements only work through the view's `display()` method and will bypass any caching:

* `#version#` is replaced by the framework's release name (`µMVC vx.x.x`).
* `#mode#` is replaced by the rendering mode (`production` or `development`).
* `#timer#` is replaced by the page's total load time in milliseconds.
* `#queries#` is replaced by the amount of database queries processed.
* `#query_timer#` is replaced by the total database query load time in milliseconds.

### Global helpers

* `MVC::$config` accesses the config variables set in `/app/configs/config.php`.
* `MVC::redirect( $location [, $status_code = 302 ] )` creates a local redirect. (`$location` format: */link/to/page*)
* `MVC::strip( $input )` recursively trims and replaces multiple whitespace characters with a single space (useful for `$_GET` and `$_POST`).
* `MVC::errorPage( $error_code [, $message = NULL ] )` prints an error page. If `$message` is not set, `/app/views/errorPage.php` will try print one based on the `$error_code`.

## Acknowledgements

µMVC is a project by [Rick Stevens](https://rickstevens.nl/).
