<?php include($this -> _include('../header.tpl.php')); ?>

<script language="JavaScript" type="text/javascript" src="<?php echo $this -> js_url;?>tab.js"></script>

		<div class="tab-page" id="modules-cpanel">
				<?php include($this -> _include('../tab_panel.tpl.php')); ?>
				<div class="tab-page tab-page-selected">
			
			
			<table  width="100%" height="100%" cellpadding="0">
				<tr>
					<td>
					<div style="float: right">
					<?php 
					if($this->article['rate_status'] == ARTICLE_RATE_STATUS::IN_RATE || $this->article['rate_status'] == ARTICLE_RATE_STATUS::WINNER ) {
						if($this->vote_status <= 0) {
							include($this -> _include('vote.tpl.php'));
						} else {
							include($this -> _include('vote_result.tpl.php'));
						}
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
					if ($this -> is_logged){
						include($this -> _include('../form_add_comment.tpl.php'));
					}
			}				  
			?>
		</div>
	</div>


<?php include($this -> _include('../footer.tpl.php')); ?>
