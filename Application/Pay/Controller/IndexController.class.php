<?php
namespace Pay\Controller;
use Think\Controller;
class IndexController extends Controller {

//支付宝
    public function index(){

            //        获取参数

            $this->display();

    }

//	 微信jsapi
    public function windex(){


            //        获取参数

            $this->display();
        }

}