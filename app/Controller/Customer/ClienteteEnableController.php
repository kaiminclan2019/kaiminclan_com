<?php
/**
 *
 * 客户启用
 *
 * 20180301
 *
 */
class ClienteteEnableController extends Controller {
	
	protected $permission = 'user';
	protected $method = 'post';
	
	/***
	 * 输入参数
	 */
	protected function setting(){
		return array(
			'clienteteId'=>array('type'=>'digital','tooltip'=>'客户ID'),
		);
	}
	/**
	 * 业务
	 */
	public function fire(){
		
		$clienteteId = $this->argument('clienteteId');
		
		$clienteteInfo = $this->service('CustomerClientete')->getClienteteInfo($clienteteId);
		if(!$clienteteInfo){
			$this->info('客户不存在',4101);
		}
		
		if($clienteteInfo['status'] == CustomerClienteteModel::BILLBOARD_CATALOGUE_STATUS_DISABLED){
			$this->service('CustomerClientete')->update(array('status'=>CustomerClienteteModel::BILLBOARD_CATALOGUE_STATUS_ENABLE),$clienteteId);
		}
		
		
	}
}
?>