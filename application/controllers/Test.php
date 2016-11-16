<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller
{
    public function test1()
    {
        echo "hello world！";
       exit;
    }
}