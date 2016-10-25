<?php namespace Common\Model;

use Common\Model\BaseModel;

/*
 * 文章标签关联表model
 */

class ArticleTagModel extends BaseModel {
	protected $_validate = 'article_tag';

	public function addData( $tid, $aid ) {
		foreach ( $tid as $t ) {
			$data = [
				'article_aid' => $aid,
				'tag_tid'     => $t
			];
			$this->add( $data );
		}

		return true;
	}//#

	public function getDataByAid( $aid, $field = 'true' ) {
		if ( $field == 'all' ) {
			return M( 'ArticleTag' )
				->join( '__TAG__ ON __ARTICLE_TAG__.tag_tid=__TAG__tid' )
				->where( [ 'aid' => $aid ] )
				->select();
		} else {
			return $this->where( [ 'aid' => $aid ] )->getField( 'tag_tid', true );
		}
	}


}//CLASS
