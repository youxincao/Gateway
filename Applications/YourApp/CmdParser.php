<?php

/**
 * Created by PhpStorm.
 * User: weilun
 * Date: 2015/8/6
 * Time: 14:21
 */
abstract class CmdParser
{
    protected $_protocol_data;
    protected $_need_reply;

    public function __construct($protocol_data){
        $this->_protocol_data = $protocol_data;
        $this->_need_reply = false;
    }

    public abstract function parse();

    public function reply(){

    }

    public function handleCmd(){
        $this->parse();
        if($this->_need_reply){
            $this->reply();
        }
    }

}