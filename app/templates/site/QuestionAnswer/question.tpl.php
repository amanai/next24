<?php include($this -> _include('../header.tpl.php')); ?>

<script language="JavaScript" type="text/javascript" src="<?php echo $this -> js_url;?>tab.js"></script>

		<div id="tabs">
			<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="<?=Project::getRequest()->createUrl('QuestionAnswer','List')?>"><?=$this->tab_list_name?></a></div>
			<?php if($this->current_user && $this->current_user->id > 0) { ?>
				<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="<?=$this->createUrl('QuestionAnswer', 'UserQuestions')?>" ><?=$this->tab_my_list_name?></a></div> 
			<?php } ?>
			<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="<?=$this->createUrl('QuestionAnswer','ManagedQuestion')?>" ><?=$this->tab_manage_question_name?></a></div>
			<div class="tab tab-selected" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="#"><?=$this->question_tab?></a></div>
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