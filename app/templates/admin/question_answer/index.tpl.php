
<?php include($this -> _include('../header.tpl.php')); ?>
		<div class="desktop">
			<div class="item">
				<h3><a href="<?=$this->createUrl('AdminQuestionAnswer','CatList')?>">Категории вопросов</a></h3>
				В этом разделе вы сможете управлять категориями вопросов
			</div>
			<div class="item">
				<h3><a href="<?=$this->createUrl('AdminQuestionAnswer','QuestionList')?>">Вопросы</a></h3>
				В этом разделе вы сможете управлять вопросами
			</div>
		</div> 
<?php include($this -> _include('../footer.tpl.php')); ?>