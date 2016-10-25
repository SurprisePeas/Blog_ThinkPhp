<?php namespace Common\Model;
use Common\Model\BaseModel;
/*
 * 文章图片关联表model
 */
 class ArticlePicModel extends BaseModel
 {
 	protected $_validate = 'article_tag';
 	/*
	 * 添加数据
	 * @param string $aid 文章id
	 * @param string $tids 图片路径
	 */
	public function addData(){
		
	}//#
	
	//1.只传递aid:获得tid数组  2.传递aid&&tname时获得键名为aid/键值tname的数组
	public function getDataByAid($aid){
		$data = $this
				  ->field('path')
				  ->where(['aid'=>$aid])
				  ->order('ap_id asc')
				  ->limit(1)
				  ->select();
		$root_path = rtrim($_SERVER['SCRIPT_NAME'],'/index.php');
		$data[0]['path'] = $root_path.$data[0]['path'];
		return $data[0]['path'];		  
	}//#
	
 }//CLASS
