<?php

function new_md5($pwd,$value=''){//密码加密(需传入密码和掩码)
    if($value==''){
        $value=$_SESSION['yanma'];
    }
    $new_pwd=md5(md5($pwd).$value.'longyu');
    unset ($_SESSION['yanma']);
    return $new_pwd;
}

function randstr($len=6) {//获取6位数随机码
    $_SESSION['yanma']='';
    $chars='abcdefghijklmnopqrstuvwxyz0123456789';
    $password='';
    while(strlen($password)<$len)
        $password.=substr($chars,(mt_rand()%strlen($chars)),1);

    $_SESSION['yanma']=$password;
    return $password;
}


function checkName($val){//真实姓名
    if(!preg_match('/^[\x80-\xff]{4,15}$/', $val)){
        return false;
    }else{
        return true;
    }
}
function checkNickname($val){//昵称验证
    if(!preg_match('/^[\x80-\xff]|[A-Za-z0-9]{3,60}$/', $val)){
        return false;
    }else{
        return true;
    }
}
function Icd($idcard){//身份证号码
    // 只能是18位  
    if(strlen($idcard)!=18){  
        return false;  
    }  
  
    // 取出本体码  
    $idcard_base = substr($idcard, 0, 17);  
  
    // 取出校验码  
    $verify_code = substr($idcard, 17, 1);  
  
    // 加权因子  
    $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);  
  
    // 校验码对应值  
    $verify_code_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');  
  
    // 根据前17位计算校验码  
    $total = 0;  
    for($i=0; $i<17; $i++){  
        $total += substr($idcard_base, $i, 1)*$factor[$i];  
    }  
  
    // 取模  
    $mod = $total % 11;  
  
    // 比较校验码  
    if($verify_code == $verify_code_list[$mod]){  
        return true;  
    }else{  
        return false;  
    }  
  
}
function V($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/**
 * 邮件发送函数
 */
function sendMail($to, $title, $content) {

    Vendor('PHPMailer.PHPMailerAutoload');
    $mail = new PHPMailer(); //实例化
    $mail->IsSMTP(); // 启用SMTP
    $mail->Host=C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
    $mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
    $mail->Username = C('MAIL_USERNAME'); //你的邮箱名
    $mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
    $mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
    $mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
    $mail->AddAddress($to,"尊敬的客户");
    $mail->WordWrap = 50; //设置每行字符长度
    $mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
    $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
    $mail->Subject =$title; //邮件主题
    $mail->Body = $content; //邮件内容
    $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
    return($mail->Send());
}

define('WBLOG_ROOT_PATH', rtrim(dirname(__FILE__), '/\\') . DIRECTORY_SEPARATOR);

define('URL_5W', 'http://'.$_SERVER['HTTP_HOST'].__ROOT__);


//计算字符串长度函数，包括中文
function abslength($str){     
       $len=strlen($str);     
       $i=0; $j=0;    
       while($i<$len)     
       {     
             if(preg_match("/^[".chr(0xa1)."-".chr(0xf9)."]+$/",$str[$i]))     
             {     
               $i+=3;//注意TP中的编码都是utf-8，所以+3;如果是GBK改为+2   
             }else{     
               $i+=1;     
                  }     
          $j++;  
       }  
       return $j;  
}
//输出内容显示定长
//@length显示长度,@content需要处理的内容

function output($content,$length=5){
     
    if(abslength($content)>$length){
     
     return mb_substr($content,0,$length,'utf-8').'…';

    }else{

    return $content;

    }

    
}