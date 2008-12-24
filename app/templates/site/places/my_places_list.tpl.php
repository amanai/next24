	<h1>Места учебы, работы, отдыха, службы</h1>

	
	<br />
	<div id="greyarea">
		<h2>Ваши места</h2><br>
		
		<? foreach ($this->my_places as $place) { ?>
			<div class="poll_line"><?=$place['city'];?>/<?=$place['name'];?> <?=$place['date_start'];?>&mdash;<?=$place['date_end'];?>
				<div class="descr">
					<a href="<?php echo $this->createUrl('Places', 'ShowUsers', array('id'=>$place['geo_place_id']), $this->current_user->login)?>">Посмотреть пользователей</a>&nbsp;&nbsp;
					<a href="<?php echo $this->createUrl('Places', 'EditPlace', array('id'=>$place['id']), $this->current_user->login)?>">Редактировать</a>&nbsp;&nbsp;
					<a href="<?php echo $this->createUrl('Places', 'DeletePlace', array('id'=>$place['id']), $this->current_user->login)?>">Удалить свою запись</a>
				</div>
			</div><br>			
		<? } ?>
	</div>
	<br />