<?php

/**
 * Created by PhpStorm.
 * User: weilun
 * Date: 2015/8/9
 * Time: 0:14
 */

use \GatewayWorker\Lib\Gateway;

class ALCmdParser extends CmdParser
{

    public function __construct($protocol_data)
    {
        parent::__construct($protocol_data);
        $this->_need_reply = true;
    }

    public function parse()
    {

    }

    private function format_reply_string(){
        return "[".$this->_protocol_data->getFactoryCode()."*"
        .$this->_protocol_data->getDeviceSn()."*"
        ."0002"."*"
        ."AL]";
    }
    public function reply()
    {
        CustomLogger::getLogger()->info("ALCmdParser reply the cmd");
        Gateway::sendToUid($this->_protocol_data->getDeviceSn(), $this->format_reply_string());
    }


}