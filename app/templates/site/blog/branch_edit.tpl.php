<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../profile_line.tpl.php')); ?>	


				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
					<?php echo $this -> flash_messages; ?>
					<?php  if ($this->request_user_id == $this->user_id){ 
					    require('form_branch.tpl.php');
					} ?>					
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<?php echo $this -> control_panel; ?>
						<div class="navigation">
							<div class="title">
								<h2>Блоги <? echo $this->blog_info['title'];  ?></h2>
								<i title="Показать фильтр" class="filter-link icon show-filter-icon"></i>
							</div>
							<ul class="nav-list">
								<?php require('blog_left_tree.tpl.php'); ?>
							</ul>
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>