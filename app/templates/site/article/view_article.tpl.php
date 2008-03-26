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
					echo $this->vote_status;
						if($this->vote_status != 0 && Project::getUser()->getDbUser()->id > 0) {
							include($this -> _include('vote.tpl.php'));
						} else {
							include($this -> _include('vote_result.tpl.php'));
						}
					?>
					</div>	
					<b><?=$this->page_content['title']?></b>
						<p><?=htmlspecialchars($this->page_content['p_text'])?></p>
						
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
