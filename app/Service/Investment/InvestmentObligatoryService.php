<?php
/**
 *
 * 模块
 *
 * 页面
 *
 */
class InvestmentObligatoryService extends Service
{
	
	/**
	 *
	 * 模块信息
	 *
	 * @param $field 模块字段
	 * @param $status 模块状态
	 *
	 * @reutrn array;
	 */
	public function getObligatoryList($where,$start,$perpage,$order = ''){
		
		$count = $this->model('InvestmentObligatory')->where($where)->count();
		if($count){
			$handle = $this->model('InvestmentObligatory')->where($where);
			if($start > 0 && $perpage > 0){
				$handle = $handle->orderby($order)->limit($start,$perpage,$count);
			}
			$listdata = $handle ->select();
		}
		return array('total'=>$count,'list'=>$listdata);
	}
	/**
	 *
	 * 检测岗位名称
	 *
	 * @param $subscriberName 账户名称
	 *
	 * @reutrn int;
	 */
	public function checkObligatoryTitle($title){
		if($title){
			$where = array(
				'title'=>$title
			);
			return $this->model('InvestmentObligatory')->where($where)->count();
		}
		return 0;
	}
	
	/**
	 *
	 * 模块信息
	 *
	 * @param $expensesId 模块ID
	 *
	 * @reutrn array;
	 */
	public function getObligatoryInfo($expensesId,$field = '*'){
		
		$where = array(
			'identity'=>$expensesId
		);
		
		$expensesData = $this->model('InvestmentObligatory')->field($field)->where($where)->find();
		
		return $expensesData;
	}
	
	/**
	 *
	 * 删除模块
	 *
	 * @param $expensesId 模块ID
	 *
	 * @reutrn int;
	 */
	public function removeObligatoryId($expensesId){
		
		$output = 0;
		
		$where = array(
			'identity'=>$expensesId
		);
		
		$expensesData = $this->model('InvestmentObligatory')->where($where)->find();
		if($expensesData){
			
			$output = $this->model('InvestmentObligatory')->where($where)->delete();
			
			$this->service('PaginationItem')->removeObligatoryIdAllItem($expensesId);
		}
		
		return $output;
	}
	
	/**
	 *
	 * 模块修改
	 *
	 * @param $expensesId 模块ID
	 * @param $expensesNewData 模块数据
	 *
	 * @reutrn int;
	 */
	public function update($expensesNewData,$expensesId){
		$where = array(
			'identity'=>$expensesId
		);
		
		$expensesData = $this->model('InvestmentObligatory')->where($where)->find();
		if($expensesData){
			
			$expensesNewData['lastupdate'] = $this->getTime();
			$this->model('InvestmentObligatory')->data($expensesNewData)->where($where)->save();
		}
	}
	
	/**
	 *
	 * 新模块
	 *
	 * @param $expensesNewData 模块数据
	 *
	 * @reutrn int;
	 */
	public function insert($expensesNewData){
		
		$expensesNewData['subscriber_identity'] =$this->session('uid');
		$expensesNewData['dateline'] = $this->getTime();
			
		$expensesNewData['lastupdate'] = $expensesNewData['dateline'];
		return $this->model('InvestmentObligatory')->data($expensesNewData)->add();
	}
}