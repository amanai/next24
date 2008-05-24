<?php

class TemplateManager extends ApplicationManager implements IManager{
	private $_templateDir;
	private $_css_path;
	private $_js_path;
	private $_image_path;
	private $_cj_cache_path;
	
			function initialize(IConfigParameter $configuration){
				$this -> _templateDir = Project::NS() -> path($configuration -> get('template_dir'));
				if (!file_exists($this -> _templateDir) || !is_dir($this -> _templateDir)){
					throw new TemplateException("Template manager: root template directory is not exists");
				}
				
				$this -> _js_path = $configuration -> get('js_path');
				$this -> _css_path = $configuration -> get('css_path');
				$this -> _image_path = $configuration -> get('image_path');
				$this -> _cj_cache_path = $configuration -> get('cj_cache_path');
				Project::setTemplateManager($this);
				$this -> _common_config($configuration);
			}
			
			
			/**
			 * Get template dir
			 */
			public function getTemplateDir(){
				return $this -> _templateDir;
			}
			
			/**
			 * Get template dir
			 */
			public function getCssPath(){
				return $this -> _css_path;
			}
			
			/**
			 * Get template dir
			 */
			public function getJsPath(){
				return $this -> _js_path;
			}
			
			public function getImagePath(){
				return $this -> _image_path;
			}
			
			public function getCJCachePath(){
				return $this -> _cj_cache_path;
			}
			
}
?>
