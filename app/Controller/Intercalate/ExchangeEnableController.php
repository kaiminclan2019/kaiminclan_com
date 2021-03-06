<?php
/**
 *
 * 交易所启用
 *
 * 20180301
 *
 */
class ExchangeEnableController extends Controller {
	
	protected $permission = 'user';
	protected $method = 'post';
	
	/***
	 * 输入参数
	 */
	protected function setting(){
		return array(
			'exchangeId'=>array('type'=>'digital','tooltip'=>'交易所ID'),
		);
	}
	/**
	 * 业务
	 */
	public function fire(){
		
		$exchangeId = $this->argument('exchangeId');
		
		$groupInfo = $this->service('IntercalateExchange')->getCatalogInfo($exchangeId);
		if(!$groupInfo){
			$this->info('交易所不存在',4101);
		}
		
		if($groupInfo['status'] == IntercalateExchangeModel::PAGINATION_BLOCK_STATUS_DISABLED){
			$this->service('IntercalateExchange')->update(array('status'=>IntercalateExchangeModel::PAGINATION_BLOCK_STATUS_ENABLE),$exchangeId);
		}
		
		
	}
}
?>