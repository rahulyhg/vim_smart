<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/1/5
 * Time: 10:21
 */
import("@.ORG.wxTest.ILogHandler");

class CLogFileHandler implements ILogHandler
{
    private $handle = null;

    public function __construct($file = '')
    {
        $this->handle = fopen($file,'a');
    }

    public function write($msg)
    {
        fwrite($this->handle, $msg, 4096);
    }

    public function __destruct()
    {
        fclose($this->handle);
    }
}