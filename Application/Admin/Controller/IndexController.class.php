<?php namespace Admin\Controller;
use Common\Controller\AdminController;
//-----------------[默认控制器]----------------
class IndexController extends AdminController
{
	//===[默认首页]===
	public function index(){
	    $this->display();
	}//index---
	
	//===[欢迎界面]===
	public function welcome(){
		//[分配数据]
		$assign = [
			'all_article'=>D('Article')->getCountData(), //文章数统计
			'delete_article'=>D('Article')->getCountData(['is_delete'=>1]), //文章删除(回收站)数量 1:删除
			'hide_article'=>D('Article')->getCountData(['is_show'=>0]), //文章不显示数量 1:不显示
			'all_chat'=>D('Chat')->getCountData(), //碎言数统计
			'delete_chat'=>D('Chat')->getCountData(['is_delete'=>1]), //碎言删除(回收站)数量 1:删除
            'hide_chat'=>D('Chat')->getCountData(['is_show'=>0]), //碎言不显示数量 1:不显示
			'all_comment'=>M('Comment')->count(), //评论数统计
		];
		$this->assign($assign);
	    $this->display();
	}//welcome---
	
}//CLASS
?>