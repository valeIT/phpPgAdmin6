# Changelog

This section is incomplete. I hope some day it will be up to date.

### v6.0.0-alpha1

- the app was fully refactored adding:
    - namespaces
    - proper (yet arbitrary :sad:) folder hierarchy
    - separate files for separate classes
- strips the use of require and include to the bare minimum
- drops support for PHP < 5.4.
- provides full composer compatibility
- PSR-4 autoloading
- makes requirement checks for PHP version and ext-pgsql


### v6.0.0-alpha2

- most entrypoints were moved to `src/views` and do now instance a controller, then call one of its methods depending on the `action` parameter
- due to this, entrypoint logic was moved into controller classes in  `src/controllers`
- usage of global variables is being replaced by member properties and usage of `use` where is due.
- usage of global functions is being replaced by anonymous fuctions 
- usage of explicit includes/requires is being replaced by composer's autoloader (except for `src/lib.inc.php`)
- global decorator functions are being replaced by static methods of the Decorator class. 

### v6.0.0-beta2

- moves HTML printing methods to their own class, which is in turn used by controllers
- this is the last release that will support the "processes" view for Postgres 9.5, b/c *pg_stat_activity* has changed its structure in PG 9.6.