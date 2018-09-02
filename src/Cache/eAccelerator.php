<?php
namespace agking\Cache;

/**
 * Created by PhpStorm.
 * User: agkin
 * Date: 13/01/2017
 * Time: 15:16
 */
/**
 * Simple class to deal with eAccelerator.
 * @author Iain Cambridge
 * @copyright All rights reserved 2009-2010 (c)
 * @license http://backie.org/copyright/bsd-license BSD License
 */
class eAccelerator implements CacheBase {

    /**
     * Returns the cached variable or
     * false if it doesn't exist.
     * @param $VarName string
     * @return mixed
     */
    public function getVar($VarName)
    {
        $VarValue = eaccelerator_get($VarName);
        return ($VarValue == NULL) ? false : $VarValue;
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
        return eaccelerator_put($VarName,$VarValue,$TimeLimit);
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
        return eaccelerator_rm($VarName);
    }

    /**
     * Clears the cache of the all the
     * variables in it. Returns true if
     * successful and false if it fails.
     * @return bool
     */
    public function clear()
    {
        return eaccelerator_clear();
    }

}
