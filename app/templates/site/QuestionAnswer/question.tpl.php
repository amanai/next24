<?php include($this -> _include('../header.tpl.php')); ?>
<?php include($this -> _include('../profile_line.tpl.php')); ?>

				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<h2><a href="#"><?=$this->question['login']?></a></h2>
						<?=$this->question['q_text']?>
						<?=$this->comment_list?>
					</div></div>
					<?php include($this -> _include('tag_list.tpl.php')); ?>
					<?=$this->question_list_pager?>
					<!-- /main -->
					<div class="sidebar">
						<div class="user-action">
							<ul>
								<li><a href="<?=$this->createUrl('QuestionAnswer', 'ManagedQuestion', null, $this->current_user->login)?>"><i class="icon macomm-icon"></i> Задать вопрос</a></li>
								<li><a href="<?php echo $this->createUrl('QuestionAnswer', 'UserQuestions', null, $this->current_user->login); ?>"><i class="icon faq-icon"></i>Мои вопросы</a></li>
								<li><a href="<?=$this->createUrl('QuestionAnswer', 'UserQuestionsAnswers',null, $this->current_user->login)?>"><i class="icon mcomm-icon"></i>Мои ответы</a></li>
							</ul>
						</div>
						<?php $par['u_id']= $this->current_user->id ?>
						<?php include($this -> _include('left_panel.tpl.php')); ?>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<?php include($this -> _include('../footer.tpl.php')); ?>