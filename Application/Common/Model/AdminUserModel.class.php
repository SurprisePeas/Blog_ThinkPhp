<?php namespace Common\Model;
use Common\Model\BaseModel;
/*
 * [后台管理员表]model
 */
class AdminUserModel extends BaseModel
{
	protected $tableName = 'admin_user';
	 
	//===[验证密码]===
	public function checkPassword($data){
		$condition['username'] = $data['username'];
		$condition['password'] = md5($data['password']);
		//查询,判断登录信息是否正确
		$rfData = $this->where($condition)->find();
		if(!$rfData) return false;
		return $rfData;
	}//checkPassword
	 
}
?>