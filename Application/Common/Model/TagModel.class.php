<?php namespace Common\Model;
use Common\Model\BaseModel;
/*
 * [标签表]model
 */
class TagModel extends BaseModel
{
	//===["添加"标签]===
	public function addData(){
		$tnames = I('post.tnames');
		if(empty($tnames)){
			$this->error('空标签名');
			return false;
		}else {
			$tnames = nl2br(trim($tnames));//处理
			$tnames = explode("<br />", $tnames);
			foreach ($tnames as $k => $v) {
				$v = trim($v);
				if(!empty($v	)){
					$data['tname'] = $v;
					$this->add($data	);
				}
			}
			return true;
		}//ELSE
	}//addData---
	
	//===["删除"标签]===
	public function delData(){
		$tid = I('get.tid',0,'intval');
		if($this->where(['tid'=>$tid])->delete()){
			return true;
		}else {
			return false;
		}
	}//delData
	
	//===[修改标签]===
	public function editData(){
		$tid = I('post.tid',0,'intval');
		$subData['tname'] = I('post.tname');
		if(empty($subData)){
			$this->error = '不能为空';
			return false;
		}else {
			return $this->where(['tid'=>$tid])->save($subData);
		}
	}//editData---
	
	//===[获得所有标签]===
	public function getAllData(){
		$data = $this->select();
		//统计标签对应的文章数量
		foreach ($data as $k => $v) {
			$data[$k]['count'] = M('article_tag')->where(['tag_tid'=>$v['tid']])->count();
		}
		return $data;
	}//getAllData
	
	//===[获得"指定"标签]===
	public function getDataByTid($tid){
		return $this->where(['tid'=>$tid])->find(); 
	}//getDataById
	
	//===[统计标签数量]===
	public function getCountData($map=[]){
		return $this->where($map)->count();
	}//getCountData
	 
}
?>