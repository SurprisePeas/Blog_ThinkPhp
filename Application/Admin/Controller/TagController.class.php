<?php namespace Admin\Controller;
use Common\Controller\AdminController;
//-----------------[标签控制器]----------------
class TagController extends AdminController
{
	private $db;
	
	public function _initialize(){
		parent::_initialize();
		$this->db=D('Tag');
	}//_initialize---
	
	//===['标签'首页]===
	public function index(){
		$data = $this->db->getAllData();
		$this->assign('data',$data);
	    $this->display();
	}//index---
	
	//===['标签'添加]===
	public function add(){
		if(IS_POST){
			if(!$this->db->addData()){
				$this->error($this->db->getError());
			}else {
			    $this->success('添加成功');
			}
		}
	    $this->display();
	}//add---
	
	//===['标签'删除]===
	public function del(){
		if($this->db->delData()){
			$this->success('删除成功');
		}else {
			$this->error('失败了!');
		}
	}//del---
	
	//===['标签'修改]===
	public function edit(){
		if(IS_POST){
			if($this->db->editData()){
				$this->success('修改成功');
			}else {
				$this->error($this->db->getError());
			}
		}else {
			$tid = I('get.tid',0,'intval');
			$data = $this->db->getDataByTid($tid);
			$this->assign('data',$data);
			$this->display();
		}
	}//edit---
	
}//CLASS
?>