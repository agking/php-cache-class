<?php
namespace agking\Cache;

/**
 * Simple class to deal with APC.
 * @author Iain Cambridge
 * @copyright All rights reserved 2009-2010 (c)
 * @license http://backie.org/copyright/bsd-license BSD License
 */
class NoCache implements CacheBase {

    /**
     * Returns the cached variable or
     * false if it doesn't exist.
     * @param $VarName string
     * @return mixed
     */
    public function getVar($VarName)
    {
        return FALSE;
    }

    /**
     * Sets a variable to the cache.
     * Returns true if successful and
     * false if fails.
     * @param $VarName string
     * @param $VarValue mixed
     * @param $TimeLimit int the amount of time before it expires
     * @return bool
     */
    public function setVar($VarName,$VarValue,$TimeLimit = 3600)
    {
        return FALSE;
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
        return FALSE;
    }

    /**
     * Clears the cache of the all the
     * variables in it. Returns true if
     * successful and false if it fails.
     * @return bool
     */
    public function clear()
    {
        return FALSE;
    }

}
