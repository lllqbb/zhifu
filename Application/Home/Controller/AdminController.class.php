<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;
class AdminController extends Controller {
	public function index(){
		// $pass = md5('123456');
		// $this->assign('pass',$pass);
		// print cookie('729921aac256374161db22f2d6a1f7e9');
		// echo '123';
		// die();
		$this->display();
	}

	public function messages(){
		$this->display();
	}

	private function cookYz($pass=''){

      cookie(md5('bai'),$pass,3600*24*30);//记住一个月 

    }

	// 登录你的账户
	public function dologin(){
		
    	//p($_POST);
    	//if(!isset($_POST['submit']))return false;//安全一点再判断一下
		if(empty($_POST)){
            $this->redirect('Admin/login');
        }

        // 判断用户名、密码是否正确
        if(empty($_POST['username']) || empty($_POST['password']))
        {
        	header("Content-Type:text/html; charset=utf-8");//必须添加，才能不乱码
        	redirect('index', 5, '用户名和密码不能为空，页面跳转中...');
        }

		$name=I('username');
		$pwd=md5(I('password'));
		$db=M('admin');
		$user = $db ->where(array('username'=>$name))->find();
		
		if(!$user || $user['password'] != $pwd){
			$this->error('账号或密码错误');
		}

		session('name',$name);
		// die($name);
		$this->assign('name', $name); 
         //设置记住密码功能
            if(!empty($_POST['remember'])){
               
                $admin=M('admin'); 
                // 用户
                $condition = array('username' => $_POST['username']);
                // 密码
                $pass = $admin -> where($condition) -> find()['password']; 
                $this->cookYz($pass);
                $this->redirect('Admin/index');

            }else{

                cookie(md5('bai'),null);
                $this->redirect('Admin/index');
            }
	}



	// 不使用phpexcel导表
	public function  exportDayInner(){
    $innerdata = Db::name('user')
        ->field('username,mobile,email,create_time')
        ->select();
    $table = '';
    $table .= "<table>
    <thead>
        <tr>
            <th class='name'>用户名称</th>
            <th class='name'>用户手机号</th>
            <th class='name'>用户邮箱</th>
            <th class='name'>注册时间</th>
        </tr>
    </thead>
    <tbody>";
    foreach ($innerdata as $v) {
        $table .= "<tr>
            <td class='name'>{$v['username']}</td>
            <td class='name'>{$v['mobile']}</td>
            <td class='name'>{$v['email']}</td>
            <td class='name'>{$v['create_time']}</td>
        </tr>";
    }
    $table .= "</tbody></table>";
    //通过header头控制输出excel表格
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
    header("Content-Type:application/force-download");
    header("Content-Type:application/vnd.ms-execl");
    header("Content-Type:application/octet-stream");
    header("Content-Type:application/download");;
    header('Content-Disposition:attachment;filename="测试.xls"');
    header("Content-Transfer-Encoding:binary");
    echo $table;
}
}