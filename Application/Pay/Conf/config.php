<?php
return array(

		//'配置项'=>'配置值'

		/* 数据库设置 */
			'DB_TYPE'               =>  '',     // 数据库类型(sqlsrv)(mysql)
			'DB_HOST'               =>  '', // 服务器地址
			'DB_NAME'               =>  '',          // 数据库名
			'DB_USER'               =>  '',      // 用户名
			'DB_PWD'                =>  '',          // 密码
			'DB_PORT'               =>  '3306',        // 端口
			'DB_PREFIX'             =>  '',    // 数据库表前缀
			'DB_PARAMS'          	=>  array(), // 数据库连接参数
			'DB_DEBUG'  			=>  true, // 数据库调试模式 开启后可以记录SQL日志
			'DB_FIELDS_CACHE'       =>  false,        // 启用字段缓存
			'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
			'DB_DEPLOY_TYPE'        =>  0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
			'DB_RW_SEPARATE'        =>  false,       // 数据库读写是否分离 主从式有效
			'DB_MASTER_NUM'         =>  1, // 读写分离后 主服务器数量
			'DB_SLAVE_NO'           =>  '', // 指定从服务器序号

		/* 数据缓存设置 */
			'DATA_CACHE_TIME'       =>  0,      // 数据缓存有效期 0表示永久缓存
			'DATA_CACHE_COMPRESS'   =>  false,   // 数据缓存是否压缩缓存
			'DATA_CACHE_CHECK'      =>  false,   // 数据缓存是否校验缓存
			'DATA_CACHE_PREFIX'     =>  '',     // 缓存前缀
			'DATA_CACHE_TYPE'       =>  'File',  // 数据缓存类型,

		//'配置项'=>>'配置值'
	//支付宝配置参数
		'alipay_config'=> array(
			//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
			//合作身份者ID，签约账号，以2088开头由16位纯数字组成的字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
				'partner'		=> '',//
			//收款支付宝账号，以2088开头由16位纯数字组成的字符串，一般情况下收款账号就是签约账号
				'seller_id'	=> '',//
			// MD5密钥，安全检验码，由数字和字母组成的32位字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
				'key'	=> '',
			// 服务器异步通知页面路径  需http://格式的完整路径，不能加?id=>123这类自定义参数，必须外网可以正常访问
				'notify_url' => "http://域名/Pay/Ipayreturn/notify_url",
			// 页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=>123这类自定义参数，必须外网可以正常访问
				'return_url' => "http://域名/Pay/Ipayreturn/return_url",
			//签名方式
				'sign_type'    => strtoupper('MD5'),
			//字符编码格式 目前支持 gbk 或 utf-8
				'input_charset'		=> strtolower('utf-8'),
			//ca证书路径地址，用于curl中ssl校验
			//请保证cacert.pem文件在当前文件夹目录中
				'cacert'    => getcwd().'\\cacert.pem',
			//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
				'transport'    => 'http',
			// 支付类型 ，无需修改
				'payment_type' => "1",
			// 产品类型，无需修改
				'service' => "create_direct_pay_by_user",
			//手机支付类型
				'wap_service' => "alipay.wap.create.direct.pay.by.user",
			//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
			//↓↓↓↓↓↓↓↓↓↓ 请在这里配置防钓鱼信息，如果没开通防钓鱼功能，为空即可 ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
			// 防钓鱼时间戳  若要使用请调用类文件submit中的query_timestamp函数
				'anti_phishing_key' => "",
			// 客户端的IP地址 非局域网的外网IP地址，如：221.0.0.1
				'exter_invoke_ip' => "",
			//↑↑↑↑↑↑↑↑↑↑请在这里配置防钓鱼信息，如果没开通防钓鱼功能，为空即可 ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
		),
		'GET_GKEYM'=> '-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQCqGKukO1De7zhZj6+H0qtjTkVxwTCpvKe4eCZ0FPqri0cb2JZfXJ/DgYSF6vUp
wmJG8wVQZKjeGcjDOL5UlsuusFncCzWBQ7RKNUSesmQRMSGkVb1/3j+skZ6UtW+5u09lHNsj6tQ5
1s1SPrCBkedbNf0Tp0GbMJDyR4e9T04ZZwIDAQABAoGAFijko56+qGyN8M0RVyaRAXz++xTqHBLh
3tx4VgMtrQ+WEgCjhoTwo23KMBAuJGSYnRmoBZM3lMfTKevIkAidPExvYCdm5dYq3XToLkkLv5L2
pIIVOFMDG+KESnAFV7l2c+cnzRMW0+b6f8mR1CJzZuxVLL6Q02fvLi55/mbSYxECQQDeAw6fiIQX
GukBI4eMZZt4nscy2o12KyYner3VpoeE+Np2q+Z3pvAMd/aNzQ/W9WaI+NRfcxUJrmfPwIGm63il
AkEAxCL5HQb2bQr4ByorcMWm/hEP2MZzROV73yF41hPsRC9m66KrheO9HPTJuo3/9s5p+sqGxOlF
L0NDt4SkosjgGwJAFklyR1uZ/wPJjj611cdBcztlPdqoxssQGnh85BzCj/u3WqBpE2vjvyyvyI5k
X6zk7S0ljKtt2jny2+00VsBerQJBAJGC1Mg5Oydo5NwD6BiROrPxGo2bpTbu/fhrT8ebHkTz2epl
U9VQQSQzY1oZMVX8i1m5WUTLPz2yLJIBQVdXqhMCQBGoiuSoSjafUhV7i1cEGpb88h5NBYZzWXGZ
37sJ5QsW+sJyoNde3xH8vdXhzU7eT82D6X/scw9RZz+/6rCJ4p0=
-----END RSA PRIVATE KEY-----',
		'GET_SKEYM'=>'-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCqGKukO1De7zhZj6+H0qtjTkVxwTCpvKe4eCZ0
FPqri0cb2JZfXJ/DgYSF6vUpwmJG8wVQZKjeGcjDOL5UlsuusFncCzWBQ7RKNUSesmQRMSGkVb1/
3j+skZ6UtW+5u09lHNsj6tQ51s1SPrCBkedbNf0Tp0GbMJDyR4e9T04ZZwIDAQAB
-----END PUBLIC KEY-----',
		'PRIVATEKEY' =>'MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAKoYq6Q7UN7vOFmPr4fSq2NORXHBMKm8p7h4JnQU+quLRxvYll9cn8OBhIXq9SnCYkbzBVBkqN4ZyMM4vlSWy66wWdwLNYFDtEo1RJ6yZBExIaRVvX/eP6yRnpS1b7m7T2Uc2yPq1DnWzVI+sIGR51s1/ROnQZswkPJHh71PThlnAgMBAAECgYAWKOSjnr6obI3wzRFXJpEBfP77FOocEuHe3HhWAy2tD5YSAKOGhPCjbcowEC4kZJidGagFkzeUx9Mp68iQCJ08TG9gJ2bl1irddOguSQu/kvakghU4UwMb4oRKcAVXuXZz5yfNExbT5vp/yZHUInNm7FUsvpDTZ+8uLnn+ZtJjEQJBAN4DDp+IhBca6QEjh4xlm3iexzLajXYrJid6vdWmh4T42nar5nem8Ax39o3ND9b1Zoj41F9zFQmuZ8/AgabreKUCQQDEIvkdBvZtCvgHKitwxab+EQ/YxnNE5XvfIXjWE+xEL2broquF470c9Mm6jf/2zmn6yobE6UUvQ0O3hKSiyOAbAkAWSXJHW5n/A8mOPrXVx0FzO2U92qjGyxAaeHzkHMKP+7daoGkTa+O/LK/IjmRfrOTtLSWMq23aOfLb7TRWwF6tAkEAkYLUyDk7J2jk3APoGJE6s/EajZulNu79+GtPx5seRPPZ6mVT1VBBJDNjWhkxVfyLWblZRMs/PbIskgFBV1eqEwJAEaiK5KhKNp9SFXuLVwQalvzyHk0FhnNZcZnfuwnlCxb6wnKg117fEfy91eHNTt5PzYPpf+xzD1FnP7/qsIninQ==',


	'URL_ROUTE_RULES'=>array(
		'news/:id\d'=>'News/text',
	),
	     //以上配置项，是从接口包中alipay.config.php 文件中复制过来，进行配置；

);