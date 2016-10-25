<?php
namespace Common\Controller;
use Common\Controller\BaseController;
/**
 * 前台基类Controller
 */
class HomeBaseController extends BaseController{
    /**
     * 初始化方法
     */
    public function __construct(){
        // 判断博客是否关闭
        if(C('WEB_STATUS')!=1){
            $this->display('Public/web_close');
            exit();
        }
        // 组合置顶推荐where
        $recommend_map=array(
            'is_show'=>1,
            'is_delete'=>0,
            'is_top'=>1
            );
        // 获取置顶推荐文章
        $recommend=M('Article')
            ->field('aid,title')
            ->where($recommend_map)
            ->order('aid desc')
            ->select();
        // 获取最新评论
//      $new_comment=D('Comment')->getNewComment();
        // 分配常用数据
        $assign=array(
            'categorys'=>D('Category')->getAllData(),
            'tags'=>D('Tag')->getAllData(),
//          'links'=>D('Link')->getDataByState(0,1),	
            'recommend'=>$recommend,
            'new_comment'=>$new_comment
            );
        $this->assign($assign);
    }




}

