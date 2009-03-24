<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<ul class="view-filter clearfix">
							<?php include($this -> _include('../tab_panel.tpl.php')); ?>
						</ul>
			<table  width="100%" height="100%" cellpadding="0">
				<tr>
					<td>
					<div style="float: right">
					<?php 
						if($this->vote_status <= 0) {
							include($this -> _include('vote.tpl.php'));
						} else {
							include($this -> _include('vote_result.tpl.php'));
						}
					?>
					</div>	

					<h1><?=$this->article['title']?></h1>
					<b><?=$this->page_content['title']?></b>
						<p><?=$this->page_content['p_text']?></p>
						<div id="micro">
							<img src="<?=$this -> image_url; ?>folder.png" width="15" height="12" id="ico1"/> Категория: <a href="<?=$this->createUrl('Article', 'List', array($this->category['id']))?>"><?=$this->category['name']?></a>
							<img src="<?=$this -> image_url; ?>time.png" width="16" height="16" /> <?=$this->article['creation_date']?>
						</div>
						
						<?=$this->pager_view?>
					
					</td>
				</tr>
			</table>
			
			<?php if($this->article['allowcomments'] > 0){ ?>
				<?=$this->comment_list?>
				<?php 
				/*
					if ($this -> is_logged){
						include($this -> _include('../form_add_comment.tpl.php'));
					}
			     */
			}
			?>	
						<ul class="pages-list clearfix">
							<li class="control"><span>« Назад</span> <a href="#">Вперед »</a></li>
							<li><strong>1</strong></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">6</a></li>
							<li><a href="#">7</a></li>
							<li>...</li>
							<li><a href="#">34</a></li>
						</ul>
						<!-- /pages-list -->
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<div class="navigation">
							<div class="title">
								<h2>Блоги</h2>
								<i title="Показать фильтр" class="filter-link icon hide-filter-icon"></i>
							</div>
							<form class="filter" action="#" method="get">
								<ul>
									<li><select><option>Авто</option></select></li>
									<li><select><option>AUDI</option></select></li>
									<li><select><option>Выберете раздел</option></select></li>
									<li><select disabled="disabled"><option>Выберете раздел выше</option></select></li>
								</ul>
							</form>
							<?php include($this -> _include('catalog.tpl.php')); ?>	
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->	
<?php include($this -> _include('../footer.tpl.php')); ?>
