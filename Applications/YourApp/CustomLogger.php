<?php

/**
 * Created by PhpStorm.
 * User: weilun
 * Date: 2015/7/28
 * Time: 18:03
 */
include('log4php/Logger.php');
Logger::configure(__DIR__ . '/Config/config.xml');

class CustomLogger
{
    private static $log = null;
    private static $DEBUG = true;

    private function __construct()
    {
    }

    public static function  getLogger()
    {
        if (self::$log == null) {
            if (self::$DEBUG) {
                // self::$log = Logger::getLogger("db");
                self::$log = Logger::getLogger("console");
            }
            else
                self::$log = Logger::getLogger("custom");
        }
        return self::$log;
    }
}

;
