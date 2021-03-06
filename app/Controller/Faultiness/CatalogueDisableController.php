<?php
/**
 *
 * 禁用用例类型
 *
 * 20180301
 *
 */
class CatalogueDisableController extends Controller {
	
	protected $permission = 'admin';
	protected $method = 'post';
	/***
	 * 输入参数
	 */
	protected function setting(){
		return array(
			'catalogueId'=>array('type'=>'digital','tooltip'=>'用例类型ID'),
		);
	}
	/**
	 * 业务
	 */
	public function fire(){
		
		$catalogueId = $this->argument('catalogueId');
		
		$groupInfo = $this->service('FaultinessCatalogue')->getCatalogueInfo($catalogueId);
		if(!$groupInfo){
			$this->info('用例类型不存在',4101);
		}
		
		if($groupInfo['status'] == FaultinessCatalogueModel::PAGINATION_BLOCK_STATUS_ENABLE){
			$this->service('FaultinessCatalogue')->update(array('status'=>FaultinessCatalogueModel::PAGINATION_BLOCK_STATUS_DISABLED),$catalogueId);
		}
	}
}
?>