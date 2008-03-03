<?php include($this -> _include('../header.tpl.php')); ?>

<script language="JavaScript" type="text/javascript">
	function TabOver(tab) {
		if (tab.className=='tab') tab.className='tab-over tab';
	}

	function TabOut(tab) {
		if (tab.className=='tab-over tab') tab.className='tab';
	}
</script>
		<div id="tabs">
			<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="<?=Project::getRequest()->createUrl('QuestionAnswer','List')?>">Последние вопросы</a></div>
			<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="/user_questions_add.html" title="Задать вопрос">Задать вопрос</a></div>
			<div class="tab tab-selected" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="#">Вопрос?</a></div>
			<div class="tab-page tab-page-selected">
				<div class="block_ee1">
					<div class="block_ee2">
						<div class="block_ee3">
							<div class="block_ee4">
								<div class="block_title"><h2><a href="#"><?=$this->question['login']?></a></h2></div>
								<?=$this->question['q_text']?>	
							</div>
						</div>
					</div>
				</div>								
				<?=$this->comment_list?>
			</div>
		</div>
		
<?php include($this -> _include('../footer.tpl.php')); ?>