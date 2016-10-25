<?php namespace Common\Controller;
use Common\Controller\BaseController;
/*
 * [后台基础] 控制器
 */
class AdminController extends BaseController
{
	public function _initialize(){
		//验证是否登录
		if(!$_SESSION['admin']){
			redirect(U('Admin/Login/index'));
		}
	}//_initialize---
	
	
	
}//CLASS
