<?php include($this -> _include('../header.tpl.php')); ?>

<script language="JavaScript" type="text/javascript" src="<?php echo $this -> js_url;?>tab.js"></script>

		<div id="tabs">
			<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="<?=Project::getRequest()->createUrl('QuestionAnswer','List')?>">Последние вопросы</a></div>
			<?php if($this->current_user && $this->current_user->id > 0) { ?>
				<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="<?=$this->createUrl('QuestionAnswer', 'List', array('u_id' => $this->current_user->id))?>" >Мои вопросы</a></div> 
			<?php } ?>
			<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="<?=$this->createUrl('QuestionAnswer','ManagedQuestion')?>" title="Задать вопрос">Задать вопрос</a></div>
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
			
				<?php 
					if ($this -> is_logged){
						include($this -> _include('../form_add_comment.tpl.php'));
					}				  
				?>
			</div>
		</div>
		
<?php include($this -> _include('../footer.tpl.php')); ?>