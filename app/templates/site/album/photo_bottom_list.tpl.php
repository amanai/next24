<div class="block_ee1">
	<div class="block_ee2">
		<div class="block_ee3">
			<div class="block_ee4">
				<table class="neighbours">
					<?php foreach($this->photo_list as $key => $item){ ?>
						<?php if ($key%5 == 0){ ?><tr><?php } ?>
							<td class="neigh5">
								<a href="<?php echo BASE_URL;?>Photo/View/id:<?php echo $item['id'];?>">
									<?php if ($item['thumbnail'] !== false){ ?>
										<img src="<?php echo BASE_URL.$item['thumbnail']; ?>" id="iborder"/>
									<?php } else { ?>
										<img src="<?php echo $this -> image_url; ?>noimage.gif" id="iborder"/>
									<?php } ?>
								</a>
								<br>
									<a href="<?php echo BASE_URL;?>Photo/View/id:<?php echo $item['id'];?>"><?php echo $item['name']; ?></a>
													<br />
			
								<div class="ndate"><?php echo date("j F Y", strtotime($item['creation_date']));?></div>
							</td>
					<?php }?>
				</table>
			</div>
		</div>
	</div>
</div>