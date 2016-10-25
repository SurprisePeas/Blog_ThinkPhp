<?php namespace Admin\Controller;

use Common\Controller\AdminController;

//-----------------[文章控制器]----------------
class ArticleController extends AdminController {
	private $db;

	public function _initialize() {
		parent::_initialize();
		$this->db = D( 'Article' );
	}//#

	//===['文章列表'首页]===
	public function index() {
		$data = $this->db->getAllData();
		$this->assign( 'data', $data );
		$this->display();
	}//#

	//===['文章'添加]===
	public function add() {
		if ( IS_POST ) {
			if ( $this->db->addData() ) {
				$this->success( '成功添加' );
			} else {
				$this->error( $this->db->getError(), '', 1 );
			}
		} else {
			$cateData = D( 'Category' )->getAllData();
			if ( empty( $cateData ) ) {
				$this->error( '请先添加分类', U( 'Category/add' ), 1 );
			}
			$allTag = D( 'Tag' )->getAllData();
			$this->assign( 'allTag', $allTag );
			$this->assign( 'cateData', $cateData );
			$this->display();
		}
	}//#

	//===['文章'删除]===
	public function delete() {
		if ( $this->db->deleteData() ) {
			$this->success( '彻底删除成功' );
		} else {
			$this->error( '失败了!' );
		}
	}//#

	//===['文章'修改]===
	public function edit() {
		if ( IS_POST ) {
			if ( $this->db->editData() ) {
				$this->success( '修改成功' );
			} else {
				$this->error( '修改失败' );
			}
		} else {
			$aid = I( 'aid' );
			$data = $this->db->getDataByAid($aid);
			$allCategory = D('Category')->getAllData();
		p($data);
			$this->assign('allCategory',$allCategory);
			$this->assign('data',$data);
			$this->display();
		}
	}//#

}//CLASS
?>