<?php
/**
 *
 * 禁用流程
 *
 * 20180301
 *
 */
class ProcessDisableController extends Controller {
	
	protected $permission = 'admin';
	protected $method = 'post';
	/***
	 * 输入参数
	 */
	protected function setting(){
		return array(
			'processId'=>array('type'=>'digital','tooltip'=>'流程ID'),
		);
	}
	/**
	 * 业务
	 */
	public function fire(){
		
		$processId = $this->argument('processId');
		
		$groupInfo = $this->service('WorkflowProcess')->getProcessInfo($processId);
		if(!$groupInfo){
			$this->info('流程不存在',4101);
		}
		
		if($groupInfo['status'] == WorkflowProcessModel::PAGINATION_TEMPLATE_STATUS_ENABLE){
			$this->service('WorkflowProcess')->update(array('status'=>WorkflowProcessModel::PAGINATION_TEMPLATE_STATUS_DISABLED),$processId);
		}
	}
}
?>