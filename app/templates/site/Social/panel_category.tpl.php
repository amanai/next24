<!-- TEMPLATE: Панель "Категории" - содержит дерево-каталог категорий Соц.позиций -->					
<ul class="nav-list">
	<? if (count($this->social_category_list) > 0) { $v_count = 0; ?>
		<? foreach($this->social_category_list as $key => $item) { ?>
			<? if ($v_count==0) { ?>			
				<li>
					<?php if(($this->action=='SocialLastAddPos') || ($this->action=='SocialView')) { ?>
						<a href="<?=$this->createUrl('Social', 'SocialMainList', array($item['id']))?>"><?=$item['name']?></a>
					<? } else { ?>
						<a href="<?=$this->createUrl('Social', $this->action, array($item['id']))?>"><?=$item['name']?></a>
					<? } ?>						
					<ul class="nav-list">										
			<? } ?>
			<? if (($item['level_item']==0) && $v_count) { ?>
				</li></ul class="nav-list">
					<?php if(($this->action=='SocialLastAddPos') || ($this->action=='SocialView')) { ?>
						<a href="<?=$this->createUrl('Social', 'SocialMainList', array($item['id']))?>"><?=$item['name']?></a>
					<? } else { ?>
						<a href="<?=$this->createUrl('Social', $this->action, array($item['id']))?>"><?=$item['name']?></a>
					<? } ?>						
				<ul></li>	
			<? } else { ?>
				<? if ($this->social_category_selectedID == $item['id'] && $v_count) { ?>
					<li><?=$item['name']?></li>
				<? } else { ?>	
					<?php if($v_count) { ?>
					<?php if(($this->action=='SocialLastAddPos') || ($this->action=='SocialView')) { ?>
						<li><a href="<?=$this->createUrl('Social', 'SocialMainList', array($item['id']))?>"><?=$item['name']?></a></li>
					<? } else { ?>
						<li><a href="<?=$this->createUrl('Social', $this->action, array($item['id']))?>"><?=$item['name']?></a></li>
					<? } ?>	
					<? } ?>
				<? } ?>	
			<? } ?>	
			<? $v_count++; ?>
		<? } ?>
	<? } ?>		
</ul>