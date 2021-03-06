<?php
namespace Pay\Controller;
use Think\Controller;
class RechargeController extends Controller {
	public function _initialize() {
		vendor('Alipay.Corefunction');
		vendor('Alipay.Md5function');
		vendor('Alipay.Notify');
		vendor('Alipay.Submit');
	}
	public function index(){
		$this->display();
	}

	/**
	 * 游戏充值整理部分
	 */

	public function unorder(){
		unset($_SESSION['order']);
		unset($_SESSION['paygate']);
	}

	public function order(){ //临时订单写入数据库

//		订单号
		$order_num = 'Z'.date('YmdHis',time()).mt_rand(10000,99999);
		$_SESSION['or'] = $order_num;

		$data["stats"] = "1";  //未支付
		$data["paytype"] = "1"; //支付宝支付


		// 写入数据
		if(业务成功){
			$this->paygate();
		} else {
			$this->error('数据写入错误！');
		}
	}

	public function paygate(){ //支付页面
		/**************************请求参数**************************/
		//商户订单号，商户网站订单系统中唯一订单号，必填
		$out_trade_no = $_SESSION['or'];
		//订单名称，必填
		 $subject = '';

		//付款金额，必填
		$total_fee = $_POST['money'];
		//商品描述，可空
//		$body = '测试支付';
		//判断移动端
		is_mobile_request() && $show_url = 'www.5388wan.com';
		echo '<meta charset="UTF-8">';
		/************************************************************/
		//构造要请求的参数数组，无需改动
		$parameter = array(
			"service"       => is_mobile_request()?C('alipay_config.wap_service'):C('alipay_config.service'),
			"partner"       => C('alipay_config.seller_id'),
			"seller_id"  	=> C('alipay_config.partner'),
			"payment_type"	=> C('alipay_config.payment_type'),
			"notify_url"	=> C('alipay_config.notify_url'),
			"return_url"	=> C('alipay_config.return_url'),
			"anti_phishing_key"=> C('alipay_config.anti_phishing_key'),
			"exter_invoke_ip"=> C('alipay_config.exter_invoke_ip'),
			'it_b_pay' => '15m',
			"out_trade_no"	=> $out_trade_no,
			"subject"	=> $subject,
			"total_fee"	=> $total_fee,
//			"body"	=> $body,
			"show_url"	=> $show_url,

			"_input_charset"	=> trim(strtolower(C('alipay_config.input_charset')))
			//其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.kiX33I&treeId=62&articleId=103740&docType=1
			//如"参数名"=>"参数值"
		);
//		var_dump($parameter);exit;
		//建立请求
		$alipaySubmit = new \AlipaySubmit(C('alipay_config'));
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		echo $html_text;

	}

	public function reset(){
		header('content-type:text-html;charset=utf-8');
		//查询订单信息

		if(''){
			$this->display('pay_success');exit;
		}else{
			$this->display('pay_fail');exit;
		}

	}

}