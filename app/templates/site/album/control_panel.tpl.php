<div class="user-action">
	<ul>
		<li><a href="<?php echo $this->createUrl('Album', 'CreateForm');?>"><i class="icon album-add-icon"></i>Создать альбом</a></li>
		<li><a href="<?php echo $this->createUrl('Album', 'UploadForm');?>"><i class="icon foto-upl-icon"></i>Загрузить фото</a></li>
		<li><i class="icon album-my-icon"></i><a href="<?php echo $this->createUrl('Album', 'List');?>">Мои фотоальбомы</a> <!-- <em>(4)</em> --></li>
	</ul>
</div>