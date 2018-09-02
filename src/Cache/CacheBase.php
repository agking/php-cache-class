<?php
namespace agking\Cache;

interface CacheBase
{
    public function getVar($VarName);
    public function setVar($VarName,$VarValue,$TimeLimit = 3600);
    public function deleteVar($VarName);
    public function clear();
}
