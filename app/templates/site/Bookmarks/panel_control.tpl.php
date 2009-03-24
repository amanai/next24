<!-- TEMPLATE: Панель "Управление закладками" -->
<div class="user-action"> 
	<ul> 
		<li><a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksManage');?>"><i class="icon rss-add-icon"></i>Добавить закладку</a></li> 
		<li><a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksCategoryEdit');?>"><i class="icon cat-add-icon"></i>Добавить категорию</a></li> 
		<li><a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksImportForm');?>"><i class="icon cat-set-icon"></i>Импортировать закладки</a></li> 
	</ul> 
</div>