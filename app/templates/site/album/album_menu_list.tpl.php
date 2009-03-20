				<?php foreach($this -> album_menu_list as $key => $item){ ?>
					<li><i class="arrow-icon"></i>
						<?php if ($this -> album_id != $item['id']){ ?>
							<a href="<?php echo PhotoController::getAlbumUrl($item['id'], $item['login']);?>">
						<?php } ?>
						<?php echo $item['name'];?>
						<?php if ($this->album_id != $item['id']){ ?>
							</a>
						<?php } ?>
						<?php if ($this -> album_owner) {?>
							<br /><a style="font-size: 75%; color: gray;" href="<?php echo PhotoController::getAlbumEditUrl($item['id'], $item['login']);?>">[ редактировать ]</a>
						<?php }?>
					</li>
				<?php } ?>