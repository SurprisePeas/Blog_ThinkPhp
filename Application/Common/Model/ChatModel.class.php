<?php namespace Common\Model;
use Common\Model\BaseModel;
/*
 * [文章表]model
 */
class ChatModel extends BaseModel
{
	//===[统计'碎言碎语'数量]===
	public function getCountData($map=[]){
		return $this->where($map)->count();
	}//getCountData
	 
}
?>