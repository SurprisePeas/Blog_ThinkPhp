<?php namespace Admin\Controller;
use Think\Controller;
use Common\Model\AdminUser;//[后台用户表]


//-----------------[后台登录控制器]----------------
class LoginController extends Controller
{
	
	public function __auto(){
		
	}//__auto---
	
	//===[登录界面]===
	public function index(){
		if(IS_POST){
		    $data = I("post.");
			//自定义方法(检测验证码)
			if(check_verify($data['verify'])){
				//验证用户信息
				$AUerModel = D('AdminUser');
				$checkData = $AUerModel->checkPassword($data);
				if(!$checkData) $this->error('信息不正确',U('Admin/Login/index'));
				//验证成功,添加session,进行跳转
				$_SESSION['admin'] = $checkData;
				$this->redirect('Admin/Index/index');
			}else {
				$this->error('验证码错误',U('Admin/Login/index'));
			}
		}
	    $this->display();
	}//index---
	
	//===[生成验证码]===
	public function showVerify(){
		show_verify();
	}//showVerify---
	
	//===[退出登录]===
	public function adminOut(){
		session('admin',null);
		$this->success('退出成功',U('Admin/Login/index'));
	}//adminOut
	
}//CLASS
?>