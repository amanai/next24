<!-- TEMPLATE: Панель "Категории" - содержит дерево-каталог категорий закладок -->
<ul class="nav-list">
	<? if (count($this->bookmarks_category_list) > 0) { $v_count = 0; ?>
		<? foreach($this->bookmarks_category_list as $key => $item){ ?>
			<? if ($v_count==0) { ?>			
				<li><a href="#"><?=$item['name']?></a><ul class="nav-list">										
			<? } ?>
			<? if (($item['level_item']==0) && $v_count) { ?>
				</li></ul class="nav-list">
					<a href="#"><?=$item['name']?></a>
				<ul></li>	
			<? } else { ?>
				<? if ($this->bookmarks_category_selectedID == $item['id']) { ?>
					<li><?=$item['name']?></li>
				<? } else { ?>	
					<?php if(($this->action=='BookmarksMostVisit') || ($this->action=='BookmarksView')) { ?>
						<li><a href="<?=$this->createUrl('Bookmarks', 'BookmarksList', array($item['id']),false)?>"><?=$item['name']?></a></li>					
					<? } else { ?>
						<li><a href="<?=$this->createUrl('Bookmarks', $this->action, array($item['id']),false)?>"><?=$item['name']?></a></li>
					<? } ?>
				<? } ?>	
			<? } ?>	
			<? $v_count++; ?>
		<? } ?>
	<? } ?>		
</ul>
<? if ($this->show_imported_bookmarks == true) { ?>
  <div class="block_title" style="margin-top: 5px;"><p style="text-indent: 12px;">
  <? if ($this->category_row[0]['id'] == -1) { ?>
    Импортированные
  <? } else { ?>
    <a href="<?php echo $this->createUrl('Bookmarks', $this->action, array('imported'));?>" >Импортированные</a>
  <? } ?>
  </p></div>
<? } ?>
