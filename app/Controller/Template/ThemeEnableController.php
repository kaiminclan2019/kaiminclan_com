<?php
/**
 *
 * 模块启用
 *
 * 20180301
 *
 */
class ThemeEnableController extends Controller {
	
	protected $permission = 'admin';
	protected $method = 'post';
	
	/***
	 * 输入参数
	 */
	protected function setting(){
		return array(
			'themeId'=>array('type'=>'digital','tooltip'=>'模块ID'),
		);
	}
	/**
	 * 业务
	 */
	public function fire(){
		
		$themeId = $this->argument('themeId');
		
		$groupInfo = $this->service('TemplateTheme')->getThemeInfo($themeId);
		if(!$groupInfo){
			$this->info('模块不存在',4101);
		}
		
		if($groupInfo['status'] == TemplateThemeModel::PAGINATION_BLOCK_STATUS_DISABLED){
			$this->service('TemplateTheme')->update(array('status'=>TemplateThemeModel::PAGINATION_BLOCK_STATUS_ENABLE),$themeId);
		}
		
		
	}
}
?>