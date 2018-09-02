<?php
namespace agking\Cache;


abstract class CacheType extends BasicEnum {
    const apc = 0;
    const eaccelerator = 1;
    const xcache = 2;
    const file = 3;
    const none = 4;
}
