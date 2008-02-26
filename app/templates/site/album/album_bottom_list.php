<div class="block_ee1">
	<div class="block_ee2">
		<div class="block_ee3">
			<div class="block_ee4">
				<table class="neighbours">
					<?php foreach($this->album_list as $key => $item){ ?>
						<?php if ($key%5 == 0){ ?><tr><?php } ?>
							<td class="neigh1">
								<?php if ($this->album_id != $item['id']){ ?>
									<a href="<?php echo BASE_URL;?>Photo/Album/id:<?php echo $item['id'];?>"><?php echo $item['name'];?></a>
								<?php } else { ?>
									<b><?php echo $item['name'];?></b>
								<?php } ?>
								<br/>
								<div class="ndate"><?php echo date("j F Y", strtotime($item['creation_date']));?></div>
							</td>
					<?php }?>
				</table>
			</div>
		</div>
	</div>
</div>