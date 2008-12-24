			<h2 class="tmarg"><?=$this->place_name;?>. Все пользователи</h2><br>
			<? if ($this->users_list) { ?>
				<? foreach ($this->users_list as $user) { ?>
				<table class="tresults">
					<tr>
						<td class="avatar">
							<?php $avator_path = ($user['avatar']['sys_av_id'])?$user['avatar']['sys_path']:$user['avatar']['path']; ?>
							<img style="margin: 5px;" alt="<?php echo $user['avatar']['av_name'];?>" src="<?php echo $this->image_url."avatar/".$avator_path;?>"/>
						</td>
						<td class="uinfo">
							<a href="<?php echo $this->createUrl('User', 'Profile', null, $user['login'])?>"><?=$user['login'];?></a>
	
							<p><?=$user['first_name'];?>&nbsp;<?=$user['last_name'];?>&nbsp;(<?=$user['surname'];?>)</p>
						</td>
						<td class="years"><?=$user['date_start'];?>&ndash;<?=$user['date_end'];?></td>
					</tr>
					<tr>
						<td class="udiv" colspan="3">&nbsp;</td>	
					</tr>
				</table>
				<? } ?>
			<? } else { ?>
				нет пользователей
			<? } ?>

