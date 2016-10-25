<?php namespace Common\Model;
use Common\Model\BaseModel;
/*
 * [分类表]model
 */
class CategoryModel extends BaseModel
{
	protected $_validate=[
		['cname','require','空名称'],
		['csort','number','排序为数字']
	];
	
	//===["添加"分类]===
	public function addData(){
		$data = I('post.');
		if($this->create($data)){
			return $this->add();
		}
	}//addData---
	
	//===[修改分类]===
	public function editData(){
		$data = I('post.');
		if($this->create()){
			return $this->where(['cid'=>$data['cid']])->save($data);
		}
	}//#editData---
	
	//===["删除"分类]===
	public function delData($cid=null){
		$cid = is_null($cid) ? I('get.cid') : $cid;		//如果是null的话,获取get参数,传参了的话就删除指定数据
		$child = $this->getChildData($cid);	//查询是否有子分类
		if(!empty($child)){
			$this->error = '请先删除子分类';
			return false;
		}
		$articleData = D('Article')->getDataByCid($cid);
		if(!empty($articleData)){
			$this->error='此分类下还有文章!';
			return false;
		}
		if($this->where(['cid'=>$cid])->delete()){
			return true;
		}else {
			return false;
		}
	}//delData
	
	//===[获得分类 默认:'所有',开启'树状结构' ]===
	public function getAllData($filed='all',$tree=TRUE){
		if($filed='all'){
			$data = $this->order('csort')->select();
			if($tree){//是否 树状 数据显示
				return \Org\Other\Data::tree($data,'cname','cid','pid');
			}else{
				return $data;
			}
		}else {
			$this->getField('cid',$filed);
		}
	}//#getAllData
	
	//===[获得"指定"分类]===
	public function getDataByCid($cid,$field='all'){
		return $this->where(['cid'=>$cid])->find(); 
	}//#getDataById
	
	//===[获得cid下的所有子集]===
	public function getChildData($cid){
		$data = $this->getAllData('all',FALSE);
		$child = \Org\Other\Data::channelList($data,$cid);
		foreach ($child as $k => $v) {
			$childs[] = $v['cid'];
		}
		return $childs; 
	}//getChildData
	
	//===[统计分类数量]===
	public function getCountData($map=[]){
		return $this->where($map)->count();
	}//#getCountData
	 
}//CLASS
?>