<?php
/**
 *
 * 科目编辑
 *
 * 20180301
 *
 */
class SubjectSaveController extends Controller {
	
	protected $permission = 'user';
	protected $method = 'post';
	
	/***
	 * 输入参数
	 */
	protected function setting(){
		return array(
			'subjectId'=>array('type'=>'digital','tooltip'=>'科目ID','default'=>0),
			'title'=>array('type'=>'string','tooltip'=>'标题','length'=>80),
			'content'=>array('type'=>'doc','tooltip'=>'情况说明'),
			'remark'=>array('type'=>'doc','tooltip'=>'备注','default'=>0)
		);
	}
	/**
	 * 业务
	 */
	public function fire(){
		
		$subjectId = $this->argument('subjectId');
		
		$setarr = array(
			'title' => $this->argument('title'),
			'content' => $this->argument('content'),
			'remark' => $this->argument('remark')
		);
		
		if($subjectId){
			$this->service('BudgetSubject')->update($setarr,$subjectId);
		}else{
			
			if($this->service('BudgetSubject')->checkSubjectTitle($setarr['title'])){
				
				$this->info('科目已存在',4001);
			}
			
			$this->service('BudgetSubject')->insert($setarr);
		}
	}
}
?>