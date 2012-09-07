php-cache-class
===========

Example use case:

```php

// Get an instance for the cache object
$cache = Cache::getInstance();

// Define the name of the cache
$cachename = 'change_this_to_a_unique_cache_name_for_this_data';

// Get the cache for $cachename if it exists 
$data = $cache->getVar($cachename);
if ($data === FALSE) {
    // The data hasn't been cached before, so set up your data that you need to store
    $myarray = ('apples','pears','bananas','oranges');
    
    // Save the data in the cache for one day
    $cache->setVar($cachename, serialize($myarray), Cache::CACHE_ONE_DAY);
} else {
    // The data was retrieved from the cache, so save it in a local variable for use later
    $myarray = unserialize($data);
}

print_r($myarray);

```