<?php
namespace Pay\Controller;
use Think\Controller;
class JsapiController extends Controller {

    public function _initialize()
    {

        ini_set('date.timezone','Asia/Shanghai');
        Vendor('weixin.WxPayApi');
        Vendor('weixin.JsApiPay');
        Vendor('weixin.WxPayNotify');
        Vendor("weixin.NativePay");
		Vendor('weixin.WxPay.Data');
    }

    public function index(){
		
			//①、获取用户openid
			$tools = new \JsApiPay();
			$openId = $tools->GetOpenid();
			if(isset($openId)){
				cookie("openId",$openId);
			}else{
				$openId=cookie("openId");
			}

			//②、统一下单
			$input = new \WxPayUnifiedOrder();
			$input->SetBody('');
			$input->SetOut_trade_no();
			$input->SetTotal_fee();
			$input->SetTime_start(date("YmdHis"));
			$input->SetTime_expire(date("YmdHis", time() + 600));
			$input->SetGoods_tag("test");
			$input->SetNotify_url("");
			$input->SetTrade_type("JSAPI");
			$input->SetOpenid($openId);
			$order = \WxPayApi::unifiedOrder($input);

			$jsApiParameters = $tools->GetJsApiParameters($order);


			$this->assign("jsApiParameters",$jsApiParameters);
			$this->display();
			
		

        
    }
	
	/**
	 *临时表
	 *
	 *
	 */
	public function ls(){
		//填写业务逻辑
			$this->index();

	}


    /**
     * 支付后回调处理
     * @param $data
     * @param $msg
     * @return bool
     */
    public function notify(){
		ini_set('date.timezone','Asia/Shanghai');
        error_reporting(E_ERROR);
        vendor('weixin/WxPa.yException');
        vendor('weixin/WxPay.Config');
        vendor('weixin/WxPay.Data');
        vendor('weixin/WxPayApi');
        $xmlstring = file_get_contents('php://input');
        //接收微信请求（将XML数据转化成数组）
        $xml = (array)simplexml_load_string($xmlstring, 'SimpleXMLElement', LIBXML_NOCDATA);

        //设置日志目录
        $log_filename = "./Public/jhpay/weixin/native_call.log";
        file_put_contents($log_filename, date('Y-m-d H:i:s')." 【接收到的native通知】".$xmlstring."\r\n", FILE_APPEND);

        $nativeCall=new \WxPayResults();
        $nativeCall->FromArray($xml);

        if($nativeCall->CheckSign() == FALSE){
            $nativeCall->SetData("return_code","FAIL");//返回状态码
            $nativeCall->SetData("return_msg","签名失败");//返回信息
            file_put_contents($log_filename, date('Y-m-d H:i:s')." 【签名失败】\r\n", FILE_APPEND);
        }else{
            //返回订单结果成功
            if($xml['result_code']=='SUCCESS'){
                file_put_contents($log_filename, date('Y-m-d H:i:s')." 【接收到的native通知】订单支付成功！\r\n", FILE_APPEND);
                $order_ls=M('');
                $where['订单号']=$xml['out_trade_no'];
                $result=$order_ls->where($where)->find();
                if($result){


                }else{
                    file_put_contents($log_filename, date('Y-m-d H:i:s')." 【接收到的native通知】临时订单不存在！\r\n", FILE_APPEND);
                    $nativeCall->SetData("return_code","SUCCESS");//返回状态码
                    $nativeCall->SetData("result_code","FAIL");//业务结果
                }
            }else{
                //返回订单结果失败
                file_put_contents($log_filename, date('Y-m-d H:i:s')." 【接收到的native通知】订单未支付！\r\n", FILE_APPEND);
                $nativeCall->SetData("return_code","SUCCESS");//返回状态码
                $nativeCall->SetData("result_code","FAIL");//业务结果
            }
        }
        //将结果返回微信
        $returnXml = $nativeCall->ToXml();
        file_put_contents($log_filename, date('Y-m-d H:i:s')." 【返回微信的native响应】：".$returnXml."\r\n", FILE_APPEND);
        echo $returnXml;
    }


	
    /**
     * 订单查询
     * @param $transaction_id
     * @return bool
     */
    public function Queryorder($transaction_id)
    {
        $input = new \WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = \WxPayApi::orderQuery($input);
        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS")
        {
            //如果订单存在则处理相关业务逻辑

        }else{
            //如果订单不存在则处理相关业务逻辑
        }
    }
}