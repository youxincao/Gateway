<?php
/**
 * Created by PhpStorm.
 * User: weilun
 * Date: 2015/7/28
 * Time: 16:42
 */

class ProtocolData{
    private $factory_code ;
    private $device_sn ;
    private $data_len;
    private $content ;

    public static  $PART_LEN = 4;

    /**
     * ProtocolData constructor.
     * @param $factory_code
     * @param $device_sn
     * @param $data_len
     * @param $content
     */
    public function __construct($factory_code, $device_sn, $data_len, $content)
    {
        $this->factory_code = $factory_code;
        $this->device_sn = $device_sn;
        $this->data_len = $data_len;
        $this->content = $content;
    }


    /**
     * @return mixed
     */
    public function getFactoryCode()
    {
        return $this->factory_code;
    }

    /**
     * @return mixed
     */
    public function getDeviceSn()
    {
        return $this->device_sn;
    }

    /**
     * @return mixed
     */
    public function getDataLen()
    {
        return $this->data_len;
    }


    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }
};