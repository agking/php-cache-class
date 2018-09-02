<?php

namespace agking\Cache;

/**
 * Simple class to deal with File Cache.
 * @author Iain Cambridge
 * @copyright All rights reserved 2009-2010 (c)
 * @license http://backie.org/copyright/bsd-license BSD License
 */
class File implements CacheBase
{

    /**
     * Returns the cached variable or
     * false if it doesn't exist.
     * @param $VarName string
     * @return mixed
     */
    public function getVar($VarName)
    {
        $filename = $this->getFileName($VarName);
        if (!file_exists($filename)) return false;
        $h = fopen($filename, 'rb');

        if (!$h) return false;

        // Getting a shared lock
        flock($h, LOCK_SH);
        $data = file_get_contents($filename);
        fclose($h);

        $data = unserialize($data);

        if (!$data) {
            // If unserializing somehow didn't work out, we'll delete the file
            unlink($filename);
            return false;
        }

        if (is_readable($filename) && time() > $data[0]) {
            // Unlinking when the file was expired
            unlink($filename);
            return false;
        }

        return $data[1];
    }

    /**
     * Sets a variable to the cache.
     * Returns true if successful and
     * false if fails.
     * Default time to live timeout is one hour
     * @param $VarName string
     * @param $VarValue mixed
     * @param int $TimeLimit
     * @return bool
     * @throws \RuntimeException
     * @internal param int $TimeLimit the amount of time before it expires
     */
    public function setVar($VarName, $VarValue, $TimeLimit = 3600)
    {
        // Opening the file in read/write mode
        $h = fopen($this->getFileName($VarName), 'ab+');
        if (!$h) throw new \RuntimeException('Could not write to cache');

        flock($h, LOCK_EX); // exclusive lock, will get released when the file is closed

        fseek($h, 0); // go to the start of the file

        // truncate the file
        ftruncate($h, 0);

        // Serializing along with the TTL
        $data = serialize(array(time() + $TimeLimit, $VarValue));
        if (fwrite($h, $data) === false) {
            throw new \RuntimeException('Could not write to cache');
        }
        fclose($h);

        return true;
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
        $filename = $this->getFileName($VarName);
        if (file_exists($filename)) {
            return unlink($filename);
        }

        return false;
    }

    /**
     * Clears the cache of the all the
     * variables in it. Returns true if
     * successful and false if it fails.
     * @return bool
     */
    public function clear()
    {
        $handle = opendir(CACHE_FOLDER);
        while (false !== ($file = readdir($handle))) {
            if ($file !== '.' && $file !== '..') {
                if (is_dir(CACHE_FOLDER . $file)) {
                    //purge ($dir.$file.'/');
                    //rmdir($dir.$file);
                } else {
                    unlink(CACHE_FOLDER . $file);
                }
            }
        }
        closedir($handle);

        return true;
    }

    private function getFileName($VarName)
    {
        return CACHE_FOLDER . md5($VarName) . '.cache';
    }
}
