<?php foreach($this->comment_list as $key => $item){ ?>
	<div class="block_ee1">
		<div class="block_ee2">
			<div class="block_ee3">
				<div class="block_ee4">
					<div class="block_title" id="comment[21]">
						<div class="block_title_left">
							<h2><a href="<?php echo UserController::getProfileUrl($item['login']);?>"><?php echo $item['login'];?></a></h2>
						</div>
						<div class="block_title_right">
							<span class="dellink"> (<a href="<?php echo $this->createUrl('Photo', 'CommentDelete', array('photo_id'=>$item['photo_id'],'id'=>$item['id']));?>" >Удалить комментарий</a>)</span><?php echo date("j F Y H:i", strtotime($item['creation_date']));?>
						</div>
					</div>
				</div>
					
				<div>
					<?php echo $item['text'];?>					
				</div>
				<div class="rmb14">
				</div>
			</div>
		</div>
	</div>
<?php }?>
