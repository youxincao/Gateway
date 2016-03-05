<?php

/**
 * Created by PhpStorm.
 * User: weilun
 * Date: 2015/7/27
 * Time: 15:01
 */

class ProtocolParser
{

    public static function parseProtocolData($buf)
    {
        $buf = trim($buf);
        $parts = explode("*", $buf);
        if (count($parts) != ProtocolData::$PART_LEN) {
            CustomLogger::getLogger()->error("The Content[" . $buf . "] is not valid");
            return null;
        }

        if (Utils::startsWith($parts[0], "["))
            $parts[0] = substr($parts[0], 1, strlen($parts[0]) - 1);
        if (Utils::endsWith($parts[3], "]")) {
            $parts[3] = substr($parts[3], 0, strlen($parts[3]) -1 );
        }
        return new ProtocolData($parts[0], $parts[1], $parts[2], $parts[3]);
    }

}

;