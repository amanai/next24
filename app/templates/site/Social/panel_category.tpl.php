<!-- TEMPLATE: Панель "Категории" - содержит дерево-каталог категорий Соц.позиций -->					
<ul class="nav-list">
	<? if (count($this->social_category_list) > 0) { $v_count = 0; ?>
		<? foreach($this->social_category_list as $key => $item) { ?>
			<? if ($v_count==0) { ?>			
				<li><a href="#"><?=$item['name']?></a><ul class="nav-list">										
			<? } ?>
			<? if (($item['level_item']==0) && $v_count) { ?>
				</li></ul class="nav-list">
					<a href="#"><?=$item['name']?></a>
				<ul></li>	
			<? } else { ?>
				<? if ($this->social_category_selectedID == $item['id']) { ?>
					<li><?=$item['name']?></li>
				<? } else { ?>	
					<li><a href="<?=$this->createUrl('Social', $this->action, array($item['id']))?>"><?=$item['name']?></a></li>
				<? } ?>	
			<? } ?>	
			<? $v_count++; ?>
		<? } ?>
	<? } ?>		
</ul>