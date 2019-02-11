<?php
class DealingsExpensesBlock extends Block {
	public function getdata($param){
		
		$expensesId = isset($param['expensesId'])?$param['expensesId']:0;
		$start = isset($param['start'])?$param['start']:-1;
		$perpage = isset($param['perpage'])?$param['perpage']:-1;
		
		$status = isset($param['status'])?$param['status']:0;
		$order = 'identity desc';
		$where = array();
		if($status != -1){
			$where['status'] = $status;
		}
		
		if($expensesId){
			$where['identity'] = $expensesId;
		}
		$listdata = $this->service('DealingsExpenses')->getExpensesList($where,$start,$perpage,$order);
		
		if($listdata['total'] > 0 && $perpage == 1){
			$listdata['list'] = current($listdata['list']);
		}
		
		return array(
			'data'=>$listdata['list'],
			'total'=>$listdata['total'],
			'start'=>$start,
			'perpage'=>$perpage
		);
	}
}