<!-- TEMPLATE: Панель "Категории" - содержит дерево-каталог категорий закладок -->
<ul class="nav-list">
	<? if (count($this->bookmarks_category_list) > 0) { $v_count = 0; ?>
		<? foreach($this->bookmarks_category_list as $key => $item){ ?>
			<? if ($v_count==0) { ?>			
				<li>
					<?php if(($this->action=='BookmarksMostVisit') || ($this->action=='BookmarksView') || ($this->action=='BookmarksList')) { ?>
						<a href="<?=$this->createUrl('Bookmarks', 'BookmarksList', array($item['id']),false)?>"><?=$item['name']?></a>				
					<? } else { ?>
						<a href="<?=$this->createUrl('Bookmarks', 'BookmarksUser', array($item['id']),false)?>"><?=$item['name']?></a>
					<? } ?>							
					<ul class="nav-list">										
			<? } ?>
			<? if (($item['level_item']==0) && $v_count) { ?>
				</li></ul class="nav-list">
					<?php if(($this->action=='BookmarksMostVisit') || ($this->action=='BookmarksView') || ($this->action=='BookmarksList')) { ?>
						<a href="<?=$this->createUrl('Bookmarks', 'BookmarksList', array($item['id']),false)?>"><?=$item['name']?></a>				
					<? } else { ?>
						<a href="<?=$this->createUrl('Bookmarks', 'BookmarksUser', array($item['id']),false)?>"><?=$item['name']?></a>
					<? } ?>				
				<ul></li>	
			<? } else { ?>
				<? if (($this->bookmarks_category_selectedID == $item['id']) && $v_count) { ?>
					<li><?=$item['name']?></li>
				<? } else { ?>	
					<?if($v_count) {?>
						<?php if(($this->action=='BookmarksMostVisit') || ($this->action=='BookmarksView') || ($this->action=='BookmarksList')) { ?>
							<li><a href="<?=$this->createUrl('Bookmarks', 'BookmarksList', array($item['id']),false)?>"><?=$item['name']?></a></li>					
						<? } else { ?>
							<li><a href="<?=$this->createUrl('Bookmarks', 'BookmarksUser', array($item['id']),false)?>"><?=$item['name']?></a></li>
						<? } ?>
					<? } ?>	
				<? } ?>	
			<? } ?>	
			<? $v_count++; ?>
		<? } ?>
	<? } ?>		
</ul>
