<?php
/**
 * ��������� ��� ���������� �������������
 */
	class PhotoController extends CBaseController{
		
		function __construct($View=null, $params = array(), $vars = array()){
			$this->setModel("Photos");
			parent::__construct($View, $params, $vars);
		}				
		
		
		/**
		 * ����� ������� ����������
		 */
		public function TopListAction(){
			
		}
		
		
	}
?>