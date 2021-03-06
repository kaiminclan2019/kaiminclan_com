<?php
/**
 *
 * 禁用职位
 *
 * 20180301
 *
 */
class PositionDisableController extends Controller {
	
	protected $permission = 'user';
	protected $method = 'post';
	/***
	 * 输入参数
	 */
	protected function setting(){
		return array(
			'positionId'=>array('type'=>'digital','tooltip'=>'职位ID'),
		);
	}
	/**
	 * 业务
	 */
	public function fire(){
		
		$positionId = $this->argument('positionId');
		
		$groupInfo = $this->service('OrganizationPosition')->getPositionInfo($positionId);
		if(!$groupInfo){
			$this->info('职位不存在',4101);
		}
		
		if($groupInfo['status'] == OrganizationPositionModel::PAGINATION_BLOCK_STATUS_ENABLE){
			$this->service('OrganizationPosition')->update(array('status'=>OrganizationPositionModel::PAGINATION_BLOCK_STATUS_DISABLED),$positionId);
		}
	}
}
?>