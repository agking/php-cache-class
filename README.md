php-cache-class
===========

A simple PHP class using the singleton design pattern to handle caching data.

Currently supports APC, eaccelerator, xcache and file-based caching.

Example use case:

```php

use agking\Cache\Cache;
use agking\Cache\CacheType;

/*** Composer autoloader ***/
require __DIR__ . '/../vendor/autoload.php';

/*
 * Set the type of cache to use.  Must be one of: 'CacheType::apc', 'CacheType::eaccelerator', 'CacheType::xcache',
 * 'CacheType::file' or 'CacheType::none'
 */
define('CACHE_TYPE', CacheType::file);

// Set the path to the folder containing cache files (only used for the 'file' cache type
define('CACHE_FOLDER', __DIR__ . '/cache/');

// Get an instance for the cache object
$cache = Cache::getInstance();

// Define the name of the cache
$cachename = 'change_this_to_a_unique_cache_name_for_this_data';

// Get the cache for $cachename if it exists
$data = $cache->getVar($cachename);
if ($data === false) {
    echo '<p>The data hasn\'t been cached before</p>';

    // The data hasn't been cached before, so set up your data that you need to store
    $myarray = array('apples','pears','bananas','oranges');

    // Save the data in the cache for one day
    $cache->setVar($cachename, $myarray, Cache::CACHE_ONE_DAY);
} else {
    echo '<p>The data was retrieved from the cache</p>';

    // The data was retrieved from the cache, so save it in a local variable for use later
    $myarray = $data;
}

print_r($myarray);


```
