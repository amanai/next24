<!-- TEMPLATE: Панель "Управление закладками" -->
<div class="user-action"> 
	<ul> 
		<li><a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksManage');?>"><i class="icon rss-add-icon"></i>Добавить закладку</a></li> 
		<li><a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksCategoryEdit');?>"><i class="icon cat-add-icon"></i>Добавить категорию</a></li> 
		<li><a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksImportForm');?>"><i class="icon cat-set-icon"></i>Импортировать закладки</a></li>
		<? if ($this->show_imported_bookmarks == true) { ?>
  			<? if ($this->category_row[0]['id'] == -1) { ?>
    			<li><i class="icon settings-b-icon"></i>Импортированные</li>
  			<? } else { ?>
    			<li><i class="icon settings-b-icon"></i> <a href="<?php echo $this->createUrl('Bookmarks', $this->action, array('imported'));?>" >Импортированные</a></li>
  			<? } ?>
		<? } ?>		
	</ul> 
</div>