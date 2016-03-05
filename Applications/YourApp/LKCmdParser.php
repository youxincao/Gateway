<?php
/**
 * Created by PhpStorm.
 * User: weilun
 * Date: 2015/8/6
 * Time: 14:31
 */

use \GatewayWorker\Lib\Gateway;
require_once 'meekrodb.2.3.class.php';

class LKCmdParser extends CmdParser{

    public function __construct($protocol_data)
    {
        parent::__construct($protocol_data);
        $this->_need_reply = true;
    }

    public function parse()
    {
        CustomLogger::getLogger()->info("LKCmdParser parse the cmd");
        $this->_protocol_data->getContent();
        $parts = explode("," , $this->_protocol_data->getContent());
        $len = count($parts);
        if( $len != 1 && $len != 7 ) {
            CustomLogger::getLogger()->error("[ERR] The LK data (len:".$len.")is not correct" . $this->_protocol_data->getContent());
            return null;
        }
        if( $len == 7) {
            $walk_num = $parts[1];
            $sleep_num = $parts[2];
            $battery_left = $parts[3];
            $temp = $parts[4];
            $humi = $parts[5];
            $bt_status = $parts[6];


            DB::insert('db_record', array(
                'sn' => $this->_protocol_data->getDeviceSn(),
                'walk_num' => $walk_num ,
                'sleep_num' => $sleep_num,
                'battery_left' => $battery_left,
                'temp' => $temp,
                'humi' => $humi,
                'bt_status' => $bt_status,
                'record_time' => time()
            ));
        }
    }

    private function format_reply_string(){
        return "[".$this->_protocol_data->getFactoryCode()."*"
            .$this->_protocol_data->getDeviceSn()."*"
            .$this->_protocol_data->getDataLen()."*"
            ."LK]";
    }
    public function reply()
    {
        CustomLogger::getLogger()->info("LKCmdParser reply the cmd");
        Gateway::sendToUid($this->_protocol_data->getDeviceSn(), $this->format_reply_string());
    }
}