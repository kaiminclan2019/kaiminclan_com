<?php
/**
 *
 * 监管启用
 *
 * 20180301
 *
 */
class SuperviseEnableController extends Controller {
	
	protected $permission = 'user';
	protected $method = 'post';
	
	/***
	 * 输入参数
	 */
	protected function setting(){
		return array(
			'superviseId'=>array('type'=>'digital','tooltip'=>'监管ID'),
		);
	}
	/**
	 * 业务
	 */
	public function fire(){
		
		$superviseId = $this->argument('superviseId');
		
		$groupInfo = $this->service('IntercalateSupervise')->getCatalogInfo($superviseId);
		if(!$groupInfo){
			$this->info('监管不存在',4101);
		}
		
		if($groupInfo['status'] == IntercalateSuperviseModel::INTERCALATE_SUPERVISE_STATUS_DISABLED){
			$this->service('IntercalateSupervise')->update(array('status'=>IntercalateSuperviseModel::INTERCALATE_SUPERVISE_STATUS_ENABLE),$superviseId);
		}
		
		
	}
}
?>