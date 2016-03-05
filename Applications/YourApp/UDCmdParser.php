<?php

/**
 * Created by PhpStorm.
 * User: weilun
 * Date: 2015/8/9
 * Time: 0:00
 */
class UDCmdParser extends CmdParser
{
    public function __construct($protocol_data)
    {
        parent::__construct($protocol_data);
        $this->_need_reply = false;
    }

    public function parse()
    {
        $content = $this->_protocol_data->getContent();
        CustomLogger::getLogger()->info("UD Command Parser handler data [" . $content . "]");
        $parts = explode(",", $content);

        try {
            $report_time = $parts[1] . " " . $parts[2];
            $flag = $parts[3];

            //分析维度信息,如果是南纬,在数据前添加负号
            $lat = $parts[4];
            if ($parts[5] == "S") {
                $lat = "-" . $lat;
            }

            // 分析经度信息,如果是西经,则在前面添加负号
            $long = $parts[6];
            if ($parts[7] == "W") {
                $long = "-" . $parts[6];
            }
            CustomLogger::getLogger()->info("[" . $report_time . "]" . " Update location [$lat,$long]");

            // save to the database
            DB::insert('db_location', array(
                'sn' => $this->_protocol_data->getDeviceSn(),
                'latitude' => $lat ,
                'longitude' => $long,
                'report_time' => $report_time,
                'record_time' => time(),
                'flag' => $flag
            ));

            $speed = $parts[8];
            $direction = $parts[9];
            $height = $parts[10];
            $num_starts = $parts[11];
            $gsm_info = $parts[12];
            $power = $parts[13];
            $walk_num = $parts[14];
            $rotate_num = $parts[15];
            $device_status = $parts[16];
            $num_bases = $parts[17];
            $connect_base = $parts[18];
            $contry_code = $parts[19];
            $net_code = $parts[20];
            $tmp = $parts[21];
            $humi = $parts[22];
            $bt_status = $parts[23];

            // discard other info

        } catch (Exception $e) {
            CustomLogger::getLogger()->error($e->getMessage());
        }
    }
}
