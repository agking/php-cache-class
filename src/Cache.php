<?php
namespace agking\Cache;


class Cache
{
    const CACHE_ONE_DAY = 86400;
    const CACHE_ONE_HOUR = 3600;
    const CACHE_HALF_HOUR = 1800;
    const CACHE_FIVE_MINUTES = 300;

    /**
     * @var CacheBase
     */
    private static $cache;

    /**
     * Hold an instance of this class
     * @var
     */
    private static $instance;

    /**
     * The type of cache class
     * @var CacheType
     */
    private static $cacheType;

    /**
     * A private constructor; prevents direct creation of object
     * @param CacheType $cacheType
     */
    private function __construct(CacheType $cacheType)
    {
        self::$cacheType = $cacheType;
    }

    /**
     * The singleton factory method
     * @return mixed
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            switch (self::$cacheType) {
                case CacheType::apc:
                    self::$cache = new APC();
                    break;
                case CacheType::eaccelerator:
                    self::$cache = new eAccelerator;
                    break;
                case CacheType::xcache:
                    self::$cache = new XCache;
                    break;
                case CacheType::file:
                    self::$cache = new File;
                    break;

                case CacheType::none:
                default:
                    self::$cache = new NoCache;
                    break;
            }

            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

    /**
     * Prevent users to clone the instance
     */
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    /**
     * @param $VarName
     * @return mixed
     */
    public function getVar($VarName)
    {
        return self::$cache->getVar($VarName);
    }

    /**
     * Default time to live timeout is one hour
     * @param $VarName
     * @param $VarValue
     * @param int $TimeLimit
     * @return mixed
     */
    public function setVar($VarName, $VarValue, $TimeLimit = 3600)
    {
        return self::$cache->setVar($VarName, $VarValue, $TimeLimit);
    }

    /**
     * @param $VarName
     * @return mixed
     */
    public function deleteVar($VarName)
    {
        return self::$cache->deleteVar($VarName);
    }

    /**
     * @return mixed
     */
    public function clear()
    {
        return self::$cache->clear();
    }

}
