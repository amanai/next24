<?php include($this -> _include('../header.tpl.php')); ?>

<script language="JavaScript" type="text/javascript" src="<?php echo $this -> js_url;?>tab.js"></script>

		<div id="tabs">
		<?php $request = Project::getRequest(); ?>
			<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="<?=$this->createUrl('Article', 'List')?>"><?=$this->tab_article_list?></a></div>
			<?php if($this->current_user && $this->current_user->id > 0) { ?>
				<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="#"><?=$this->tab_my_articles?></a></div> 
			<?php } ?>
			<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="<?=$this->createUrl('Article', 'LastList')?>"><?=$this->tab_last_list?></a></div>
			<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="<?=$this->createUrl('Article', 'TopList')?>"><?=$this->tab_top_list?></a></div>
			<div class="tab tab-selected" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="#"><?=$this->article['title']?></a></div>
			<div class="tab-page tab-page-selected">
			
			
			<table  width="100%" height="100%" cellpadding="0">
				<tr>
					<td>
					<div style="float: right">
					<?php 
					echo $this->vote_status;
						if($this->vote_status != 0 && $this->current_user->id > 0) {
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
			
			
			
		</div>
	</div>


<?php include($this -> _include('../footer.tpl.php')); ?>
