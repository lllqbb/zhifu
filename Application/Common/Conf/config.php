<?php
return array(
	//'配置项'=>'配置值'

	/* 数据库设置 */
		'DB_TYPE'               =>  'mysql',     // 数据库类型
		'DB_HOST'               =>  'localhost', // 服务器地址
		'DB_NAME'               =>  'bai',          // 数据库名
		'DB_USER'               =>  'root',      // 用户名
		'DB_PWD'                =>  '',          // 密码
		'DB_PORT'               =>  '3306',        // 端口
		'DB_PREFIX'             =>  'cs_',    // 数据库表前缀
		'DB_PARAMS'          	=>  array(), // 数据库连接参数
		'DB_DEBUG'  			=>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
		'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
		'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
		'DB_DEPLOY_TYPE'        =>  0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
		'DB_RW_SEPARATE'        =>  false,       // 数据库读写是否分离 主从式有效
		'DB_MASTER_NUM'         =>  1, // 读写分离后 主服务器数量
		'DB_SLAVE_NO'           =>  '', // 指定从服务器序号




	/*模板配置*/
		'TMPL_L_DELIM' => '{', // 模板引擎普通标签开始标记
		'TMPL_R_DELIM' => '}', // 模板引擎普通标签结束标记
	/*URL模式*/
		'URL_MODEL' => '2',
		'URL_ROUTER_ON' => true, //开启路由
		'URL_ROUTE_RULES'=>array(
				// 'login'=>'Home/Public/login',
//		'News/:id\d'=>'Home/News/text',
			// 'blog/:id'=>'http://koi.5388.cn/read/:1',
			// 'public/:year/:month/:day' => array('Public/login'),
			// 'news/:id' => 'News/read',
			// 'news/read/:id' => '/news/:1',
		),
		'APP_SUB_DOMAIN_DEPLOY' => 1, // 开启子域名配置
		'APP_SUB_DOMAIN_RULES' => array(
		),
	// 设置禁止访问的模块列表
		'MODULE_DENY_LIST' => array('Common','Runtime'),
	//允许模块列表
		'MODULE_ALLOW_LIST' => array('Home','Pay'),
		'DEFAULT_MODULE' => 'Home', // 默认模块


);
