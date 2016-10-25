<?php namespace Common\Model;

use Common\Model\BaseModel;

/*
 * [文章表]model
 */

class ArticleModel extends BaseModel {
	//验证
	protected $_validate = [
		[ 'title', 'require', '文章标题必填' ],
		[ 'author', 'require', '作者必填' ],
		[ 'category_cid', 'require', '文章分类必填' ],
		[ 'content', 'require', '文章内容必填' ],
		[ 'keywords', 'require', '关键词必填' ]
	];

	//自动完成
	protected $_auto = array(
		array( 'click', '1' ),
		array( 'addtime', 'time', 1, 'callback' ),
		array( 'updatetime', 'time', 2, 'callback' ),
		array( 'description', 'getDescription', 3, 'callback' ),
		array( 'keywords', 'comma2coa', 3, 'callback' ),
	);

	//描述--:自动完成
	public function getDescription( $description ) {
		if ( ! empty( $description ) ) {
			return $description;
		} else {//如果描述为空,截取文章前两百行作为描述
			$data = I( 'post.content' );
			$des  = htmlspecialchars_decode( $data );
			$des  = re_substr( strip_tags( $des ), 0, 200, false ); //strip_tags 去字符串中的 HTML 标签
			return $des;
		}
	}//#

	//多个关键词进行处理--:自动完成
	public function comma2coa( $keywords ) {
		return str_replace( '、', ',', $keywords );
	}//#

	//===添加文章===
	public function addData() {
		$data = I( 'post.' );
		if ( $this->create( $data ) ) {
			$aid = $this->add( $data );
			//文章内容中间表
			$arcDataModel = new \Common\Model\ArticleDataModel;
			$arcDataModel->create();
			$arcDataModel->data['article_aid'] = $aid;
			$arcDataModel->add( $data );
			//文章标签中间表
			$arcTagModel = new \Common\Model\ArticleTagModel;
			if ( empty( $data['tids'] ) ) {
				$this->error = '至少选择一个标签';

				return false;
			} else {
				$arcTagModel->addData( $data['tids'], $aid );
			}

			return true;
		} else {
			return false;
		}

	}//#

	public function editData() {

	}


	//===[获取所有文章数据]===
	public function getAllData( $field = 'all' ) {
		if ( $field == 'all' ) {
			//文章与分类表连表
			$data    = $this
				->join( 'think_blog_category ON category_cid=cid ' )
				->order( 'addtime asc' )
				->select();
			$tagData = M( 'tag' )
				->join( 'think_blog_article_tag at ON tid=tag_tid' )
				->select();
			//将多个标签循环添加进$data数组里							
			foreach ( $data as $key => $value ) {
				foreach ( $tagData as $k => $v ) {
					if ( $v['article_aid'] == $value['aid'] ) {
						$data[ $key ]['tags'][] = $v['tname'];
					}
				}
			}

			return $data;
		} elseif ( $field == 'article' ) {
			return $this->select();
		} else {
			return $this->getField( "cid,$field" );
		}
	}//#

	/**
	 * @param $aid传递aid查找此id文章 ,内容,文章标签表
	 *
	 * @return mixed
	 */
	public function getDataByAid( $aid ) {
		$data         = $this->where( [ 'aid' => $aid ] )->find();
		$data['tids'] = D( 'ArticleTag' )->getDataByAid( $aid );

		return $data;
	}

	/**
	 * 传递cid,获取此分类下的文章数据
	 * is_all为false时,不会获取(show:0,delete:1)的文章
	 */
	public function getDataByCid( $cid, $is_all = false ) {
		if ( $is_all ) {
			return $this->order( 'addtime desc' )->select();
		} else {
			$where = [
				'cid'       => $cid,
				'is_show'   => 1,
				'is_delete' => 0
			];

			return $this->where( $where )->order( 'addtime desc' )->select();
		}
	}//#

	//===[统计文章数量]===
	public function getCountData( $map = [] ) {
		return $this->where( $map )->count();
	}//#

}//CLASS
?>