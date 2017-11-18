<?php
namespace Pay\Controller;
use Think\Controller;
class IpayreturnController extends Controller {
	public function _initialize() {
		vendor('Alipay.Corefunction');
		vendor('Alipay.Md5function');
		vendor('Alipay.Rsafunction');
		vendor('Alipay.Notify');
		vendor('Alipay.Submit');
	}
	public function return_url(){
		$alipayNotify = new \AlipayNotify(C('alipay_config'));
		$verify_result = $alipayNotify->verifyReturn();
		if($verify_result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代码
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
			//获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

			$out_trade_no = $_GET['out_trade_no'];//商户订单号
			$trade_status = $_GET['trade_status'];//交易状态
			$total_fee = $_GET['total_fee'];//交易金额
			if($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				//如果有做过处理，不执行商户的业务程序
				$this->rfile();
				//$this->order_return($out_trade_no,$total_fee,$trade_status);
			} else {
				echo "trade_status=".$_GET['trade_status'];
				$this->error('亲!您的充值出现特殊情况了，如果发现已被扣费请联系客服处理');
			}
			echo "验证成功<br />";

				redirect('http://域名/Pay/Recharge/reset?order_num='.$out_trade_no);

			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
			//验证失败
			//如要调试，请看alipay_notify.php页面的verifyReturn函数
			echo "验证失败";
		}
	}
//	log
	private function rfile(){
		header("Content-type:text/html;charset=utf-8");
		$time=date('Y-m-d H:i:s',time());
		$filename = './jhlog.txt';
		$somecontent ="---------------------------------------------\r\n".$time;
		if(!empty($_GET)){
			$somecontent .="\r\n---------------------------------------------\r\nget\r\n";
			foreach($_GET as $key=>$val){
				$somecontent .= $key.':'.$val."\r\n";
			}
		}
		if(!empty($_POST)){
			$somecontent .="\r\n---------------------------------------------\r\npost"."\r\n";
			foreach($_POST as $key=>$val){
				$somecontent .= $key.':'.$val."\r\n";
			}
		}
		$somecontent .= "--------------------------------------------------\r\n";
		$handle = fopen($filename, 'a');
		fwrite($handle, $somecontent);
		fclose($handle);
	}
	public function notify_url($whyconfig="web"){
		switch($whyconfig){//异步请求配置选择app或者web
			case 'web' : $confis=C('alipay_config');
				break;
			case 'app' : $confis=C('alipay_configapp');
				break;
		}
		$fileName = './jhlog.txt';
		//计算得出通知验证结果
		$alipayNotify = new \AlipayNotify($confis);
		$verify_result = $alipayNotify->verifyNotify();
		if($verify_result) { //验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
			//获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
			//商户订单号
			$out_trade_no = $_POST['out_trade_no'];
			//交易状态
			$trade_status = $_POST['trade_status'];
			//交易金额
			$total_fee = $_POST['total_fee'];
			if( ($_POST['trade_status'] == 'TRADE_FINISHED' || $_POST['trade_status'] == 'TRADE_SUCCESS') && C('alipay_config.seller_id')==$_POST['seller_id'] ) {
				//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				//请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
				//如果有做过处理，不执行商户的业务程序
				//注意：
				//退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
				//调试用，写文本函数记录程序运行情况是否正常
				//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
				$this->rfile();
				$this->order_return($out_trade_no,$total_fee,$trade_status);

			}else{
				logResult($fileName,"异步处理失败");
				$this->error('亲!您的充值出现特殊情况了，如果发现已被扣费请联系客服处理');
			}
			echo "success";        //请不要修改或删除
		}else {
			//验证失败
			echo "fail";
			//调试用，写文本函数记录程序运行情况是否正常
			logResult($fileName,"\r\n----------------------\r\n支付异步请求页面失败!\r\n----------------------\r\n");
		}

		//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	}


	private function order_return($out_trade_no,$total_fee,$trade_status){

		switch($trade_status){
			case 'TRADE_FINISHED' : $dataid['stats'] = 3; //交易完成
				break;
			case 'TRADE_SUCCESS' : $dataid['stats'] = 2; //支付成功
				break;
		}
		$_POST['gmt_payment'];//付款日期
		$_REQUEST['trade_no'];//支付宝交易号
		$_REQUEST['buyer_email'];//支付宝买家账户

			//业务处理



	}

	/**
	 * 支付签名
	 */
	private function sign_red($return,$secret){

		//实例化加密对像
		$kk = new \myapi();
		//将数据传进去
		$kk->FromArray($return);
		$kk->ksort();
		//echo $kk->ToUrlParams();
		$return['sign']=$kk->MakeSign($secret);
		return $return;
	}
	public function action(){

	}
	public function notify_url_m(){//app异步支付请求页
		$this->notify_url('app');
	}
}