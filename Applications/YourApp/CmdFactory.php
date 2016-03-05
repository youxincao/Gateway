<?php

/**
 * Created by PhpStorm.
 * User: weilun
 * Date: 2015/8/6
 * Time: 14:53
 */
class CmdFactory
{

    public static function createCMDParserFromProtocolData($protocol_data)
    {
        $content = $protocol_data->getContent();

        $parts = explode(",", $content);

        if ($parts[0] == "LK") {
            CustomLogger::getLogger()->info("Create the LKCmdParser");
            return new LKCmdParser($protocol_data);
        } else if ($parts[0] == "UD" || $parts[0] == "UD2") {
            CustomLogger::getLogger()->info("Create the UDCmdParser");
            return new UDCmdParser($protocol_data);
        } else if ($parts[0] == "AL") {
            CustomLogger::getLogger()->info("Create the ALCmdParser");
            return new ALCmdParser($protocol_data);
        } else {
            CustomLogger::getLogger()->error("unknown command type" . $parts[0]);
        }
    }
}
