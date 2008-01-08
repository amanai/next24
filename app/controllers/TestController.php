<?php
	require_once MODELS_PATH . "Test.php";
	require_once CORE_PATH . 'CFormData.php';
	
	class TestController extends CBaseController{
		
		var $formFields = array(
			'name' => array(
				'name' => 'name',
				'title' => '��������',
				'desc' => '���� ������������',
				'type' => FORM_FIELD_TEXT,
				'required' => true,
            ),
			'value' => array(
				'name' => 'value',
				'title' => '��������',
				'desc' => '���� ���������� ��������',
				'type' => FORM_FIELD_TEXTAREA,
				'required' => true,
            ),
			'check' => array(
				'name' => 'check',
				'title' => '��� ����',
				'desc' => '���� � ���������',
				'type' => FORM_FIELD_CHECKBOX,
				'required' => true,
            ),
		);

		function __construct($View=null, $params = array(), $vars = array()){
			$view = new CBaseView(VIEWS_PATH . "testview.tpl.php");
			$this->setModel("Test");
			parent::__construct($view, $params, $vars);	
		}
		
		public function IndexAction(){
			echo "TestController/IndexAction<br/><br/>";
			$data = $this->model->getAll();
			$content = '<table>';
			$content .= '<tr><th>name</th><th>value</th><th>check</th><th>options</th></tr>';
			foreach($data as $item)
			{
				$content .= '<tr><td>'.$item['name'].'</td><td>'.$item['value'].'</td><td>'.$item['check'].'</td><td><a href="/Test/Delete/id:'.$item['id'].'">�������</a>&nbsp;<a href="/Test/Edit/id:'.$item['id'].'">�������������</a></td></tr>';
			}
			
			$router = getManager('CRouter');
			$url = $router->createUrl('Test', 'Add');
			$content .= '<tr><th></th><th></th><th></th><th><a href="'.$url.'">��������</a></th></tr>';
			$content .= '</table>';
			$this->view->content = $content;
			$this->view->display();
		}
		
		public function DeleteAction(){
			echo "TestController/DeleteAction<br/><br/>";
			echo '</pre>';
			if(isset($this->params['id']))
			{
				$this->model->id = $this->params['id'];
				$this->model->Delete();
			}
			echo '</pre>';
			echo '������ �������. <a href="/Test/Index">�����</a></pre>';
			
		}
		
		public function EditAction(){
			echo "TestController/EditAction<br/><br/>";
			echo '</pre>';
			if(isset($this->params['id']))
			{
				$data = $this->model->getById($this->params['id']);
				$form = new CFormData();
				$form->setTitle('�������������� ��������');
				$router = getManager('CRouter');
				$form->setAction($router->createUrl('Test', 'Save'));
				$form->setSubmitText('���������');
				$form->setCancelText('�����');
				$form->setCancelUrl($router->createUrl('Test'));
				$form->setFields($this->formFields);
				$form->setData($data);
				$form->setHidden(array('id'=>$this->params['id']));
				$form->initForm();
				$this->view->content = $form->renderForm();
				$this->view->display();
			}
		}

		public function AddAction(){
			echo "TestController/AddAction<br/><br/>";
			echo '</pre>';
			$form = new CFormData();
			$form->setTitle('���������� ��������');
			
			$router = getManager('CRouter');
			$form->setAction($router->createUrl('Test', 'Save'));
			$form->setSubmitText('���������');
			$form->setCancelText('�����');
			$form->setCancelUrl($router->createUrl('Test'));
			$form->setFields($this->formFields);
			$form->initForm();
			$this->view->content = $form->renderForm();
			$this->view->display();
		}

		public function SaveAction(){
			echo "TestController/SaveAction<br/><br/>";

			$data = $this->params;
			$form = new CFormData();
			$form->setFields($this->formFields);
			$form->setData($data);			

			$router = getManager('CRouter');
			if($form->validate())
			{
				$this->model->setData($data);
				if(isset($this->params['id']))
				{
					$this->model->id = $this->params['id'];
					$this->model->update();
					echo '</pre>';
					echo '������ ���������. <a href="'.$router->createUrl('Test').'">�� �������</a></pre>';
				}
				else
				{
					$this->model->insert();
					echo '</pre>';
					echo '������ ���������. <a href="'.$router->createUrl('Test').'">�� �������</a></pre>';
				}
			}
			else
			{
				if(isset($this->params['id']))
				{
					$form->setTitle('�������������� ��������');
					$form->setHidden(array('id'=>$this->params['id']));
				}
				else
				{
					$form->setTitle('���������� ��������');
				}
				$form->setAction($router->createUrl('Test', 'Save'));
				$form->setSubmitText('���������');
				$form->setCancelText('�����');
				$form->setCancelUrl($router->createUrl('Test'));
				$form->initForm();
				$this->view->content = $form->renderForm();
				$this->view->display();
			}
			echo '</pre>';
		}
	}
?>