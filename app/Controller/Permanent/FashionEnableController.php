<?php
/**
 *
 * 分类启用
 *
 * 20180301
 *
 */
class FashionEnableController extends Controller {
	
	protected $permission = 'user';
	protected $method = 'post';
	
	/***
	 * 输入参数
	 */
	protected function setting(){
		return array(
			'fashionId'=>array('type'=>'digital','tooltip'=>'分类ID'),
		);
	}
	/**
	 * 业务
	 */
	public function fire(){
		
		$fashionId = $this->argument('fashionId');
		
		$groupInfo = $this->service('PermanentFashion')->getFashionInfo($fashionId);
		if(!$groupInfo){
			$this->info('分类不存在',4101);
		}
		
		if($groupInfo['status'] == PermanentFashionModel::PAGINATION_BLOCK_STATUS_DISABLED){
			$this->service('PermanentFashion')->update(array('status'=>PermanentFashionModel::PAGINATION_BLOCK_STATUS_ENABLE),$fashionId);
		}
		
		
	}
}
?>