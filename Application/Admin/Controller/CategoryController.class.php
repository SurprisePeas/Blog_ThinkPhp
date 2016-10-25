<?php namespace Admin\Controller;
use Common\Controller\AdminController;
//-----------------[分类控制器]----------------
class CategoryController extends AdminController
{
	private $db;//分类'model'
	private $categoryData;//分类'数据'
	
	public function _initialize(){
		parent::_initialize();
		$this->db=D('Category');//分类model
		$this->categoryData = $this->db->getAllData();//分类'数据'
	}//_initialize---
	
	//===['分类'首页]===
	public function index(){
		$this->assign('data',$this->categoryData);
	    $this->display();
	}//index---
	
	//===['分类'添加]===
	public function add(){
		if(IS_POST){
			if(!$this->db->addData()){
				$this->error($this->db->getError());
			}else {
			    $this->success('添加成功');
			}
		}else {
			//判断如果有get.cid,说明是添加子类,给一个默认的选中效果~
			$cid = I('get.cid',0,'intval');
			if($cid){
				$this->assign('cid',$cid);
			}
			//正常添加 显示页面
			$this->assign('data',$this->categoryData);
		    $this->display();
		}
	}//add---
	
	//===['分类'删除]===
	public function del(){
		if($this->db->delData()){
			$this->success('删除成功','',1);
		}else {
			$this->error($this->db->getError());
		}
	}//del---
	
	//===['分类'修改]===
	public function edit(){
		if(IS_POST){
			if($this->db->editData()){
			    $this->success('修改成功');
			}else {
				$this->error($this->db->getError());
			}
		}else {
			$cid = I('get.cid',0,'intval');
			$oneData = $this->db->getDataByCid($cid);
			$data = $this->categoryData;
			$childs = $this->db->getChildData($cid);	//查询当前cid下的子分类
			foreach ($variable as $k => $k) {
				if(in_array($v['cid'], $childs)){
					$data[$k]['_html'] = " disabled='disabled' style='background:#F0F0F0' ";
				}else {
					$data[$k]['_html'] ="";
				}
			}
			$this->assign('data',$data);
			$this->assign('oneData',$oneData); //原数据
			$this->display();
		}
	}//edit---
	
	//===['分类'排序]===
	public function sort(){
		$data = I('post.');
		if(!empty($data)){
			foreach ($data as $k => $v) {
				$this->db->where(['cid'=>$k])->save(['csort'=>$v]);
			}
		}
		$this->success('已成功修改',U('Admin/Category/index'));
	}//sort---
	
}//CLASS
?>