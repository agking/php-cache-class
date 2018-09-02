<?php
namespace agking\Cache;

/**
 * Simple class to deal with XCache.
 * @author Iain Cambridge
 * @copyright All rights reserved 2009-2010 (c)
 * @license http://backie.org/copyright/bsd-license BSD License
 */
class XCache implements CacheBase {

    /**
     * Returns the cached variable or
     * false if it doesn't exist.
     * @param $VarName string
     * @return mixed
     */
    public function getVar($VarName)
    {
        return ( $VarValue = xcache_get($VarName) ) ? $VarValue : false;
    }

    /**
     * Sets a variable to the cache.
     * Returns true if successful and
     * false if fails.
     * Default time to live timeout is one hour
     * @param $VarName string
     * @param $VarValue mixed
     * @param $TimeLimit int the amount of time before it expires
     * @return bool
     */
    public function setVar($VarName,$VarValue,$TimeLimit = 3600)
    {
        return ( xcache_set($VarName,$VarValue,$TimeLimit) ) ? true : false;
    }

    /**
     * Deletes a variable from the cache.
     * Returns true if successful and false
     * if fails.
     * @param $VarName string
     * @return bool
     */
    public function deleteVar($VarName)
    {
        return ( xcache_unset($VarName) ) ? true : false;
    }

    /**
     * Clears the cache of the all the
     * variables in it. Returns true if
     * successful and false if it fails.
     * @return bool
     */
    public function clear()
    {
        for ($i = 0, $c = xcache_count(XC_TYPE_VAR); $i < $c; $i ++) {
            xcache_clear_cache(XC_TYPE_VAR, $i);
        }
        return TRUE;
    }

}
