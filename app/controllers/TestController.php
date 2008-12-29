<?php
	class TestController extends SiteController{

		function __construct($view_class = null){
			if ($view_class === null){
				$view_class = "TestView";
			}
			parent::__construct($view_class);
			
		}
		
		public function IndexAction(){
			$this->_view->assign('text',Project::getRequest()->text);
			$this->_view->Test();
			$this->_view->parse();
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
			echo 'Запись удалена. <a href="/Test/Index">Назад</a></pre>';
			
		}
		
		public function EditAction(){
			echo "TestController/EditAction<br/><br/>";
			echo '</pre>';
			if(isset($this->params['id']))
			{
				$data = $this->model->getById($this->params['id']);
				$form = new CFormData();
				$form->setTitle('Редактирование элемента');
				$router = getManager('CRouter');
				$form->setAction($router->createUrl('Test', 'Save'));
				$form->setSubmitText('Сохранить');
				$form->setCancelText('Назад');
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
			$form->setTitle('Добавление элемента');
			
			$router = getManager('CRouter');
			$form->setAction($router->createUrl('Test', 'Save'));
			$form->setSubmitText('Сохранить');
			$form->setCancelText('Назад');
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
					echo 'Запись обновлена. <a href="'.$router->createUrl('Test').'">На главную</a></pre>';
				}
				else
				{
					$this->model->insert();
					echo '</pre>';
					echo 'Запись вставлена. <a href="'.$router->createUrl('Test').'">На главную</a></pre>';
				}
			}
			else
			{
				if(isset($this->params['id']))
				{
					$form->setTitle('Редактирование элемента');
					$form->setHidden(array('id'=>$this->params['id']));
				}
				else
				{
					$form->setTitle('Добавление элемента');
				}
				$form->setAction($router->createUrl('Test', 'Save'));
				$form->setSubmitText('Сохранить');
				$form->setCancelText('Назад');
				$form->setCancelUrl($router->createUrl('Test'));
				$form->initForm();
				$this->view->content = $form->renderForm();
				$this->view->display();
			}
			echo '</pre>';
		}
	}
?>