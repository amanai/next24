<!-- TEMPLATE: Панель "Управление закладками" -->
<div class="user-action"> 
	<ul> 
		<li><a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksManage',null,$this->current_user->login);?>"><i class="icon rss-add-icon"></i>Добавить закладку</a></li> 
		<li><a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksCategoryEdit',null,$this->current_user->login);?>"><i class="icon cat-add-icon"></i>Добавить категорию</a></li> 
		<li><a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksImportForm',null,$this->current_user->login);?>"><i class="icon cat-set-icon"></i>Импортировать закладки</a></li>
		<?// if ($this->show_imported_bookmarks == true) { ?>
  			<? //if ($this->category_row[0]['id'] == -1) { ?>
    		<?php //	<li><i class="icon settings-b-icon"></i>Импортированные</li> ?>
  			<? //} else { ?>
    			<li><i class="icon settings-b-icon"></i> <a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksUser', array('imported'),$this->current_user->login);?>" >Импортированные</a></li>
  			<? //} ?>
		<?// } ?>		
	</ul> 
</div>