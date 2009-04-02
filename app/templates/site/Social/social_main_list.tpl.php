<!-- TEMPLATE: "Каталог социальных позиций(разделов)" - основная вкладка раздела соц.позиции -->
<?php include($this -> _include('../header.tpl.php')); ?>
<?php $request = Project::getRequest(); 
	$v_categoryID = $request->getKeyByNumber(0);
	if($v_categoryID) {
		$add = '/'.$v_categoryID.'';
	}
	else {
		$add = '';
	}
	$v_session = Project::getSession(); 
	$spp = $v_session->getKey('spp'); 
?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<div class="view-filter clearfix">
							<form class="search-filter" name="frm_find" method="post" action="<?php echo $this->createUrl('Social', 'SocialMainList');?>">
								<fieldset>
									<label for="sf1">Поиск по имени:</label>
									<input type="text" id="sf1" value="Введиите имя" size="45" name="inp_find" value="<?=$this->str_find; ?>" />
									<input type="submit" name="btn_find" value="Ok" />
								</fieldset>
								<input type="hidden" name="inp_hide" value="find">
							</form>
							<ul class="clearfix">
								<?php include($this -> _include('../tab_panel.tpl.php')); ?>
							</ul>
						</div>
						<!-- /view-filter -->
						<div class="display-filter clearfix">
							<div class="number-filter">
							<?php if(!$spp || $spp == 10){ ?>
									<strong>10</strong> | <a href="<?php echo $this->createUrl('Social', 'SocialMainList', null, false).$add; ?>/spp:20">20</a> | <a href="<?php echo $this->createUrl('Social', 'SocialMainList', null, false).$add; ?>/spp:30">30</a> сервисов
							<?php }elseif($spp == 20) { ?>
									<a href="<?php echo $this->createUrl('Social', 'SocialMainList', null, false).$add; ?>/spp:10">10</a> | <strong>20</strong> | <a href="<?php echo $this->createUrl('Social', 'SocialMainList', null, false).$add; ?>/spp:30">30</a> сервисов
							<?php } elseif($spp == 30) { ?>	
									<a href="<?php echo $this->createUrl('Social', 'SocialMainList', null, false).$add; ?>/spp:10">10</a> | <a href="<?php echo $this->createUrl('Social', 'SocialMainList', null, false).$add; ?>/spp:20">20</a> | <strong>30</strong> сервисов
							<? } ?>							
							</div>
						</div>
						<!-- /display-filter -->
						<table class="stat-table">
							<thead>
								<tr>
									<th class="main-row">Название</th>
									<th><a class="script-link" href="#"><span class="t">Автор</span></a></th>
									<th><span><a class="script-link" href="<?php echo $this->createUrl('Social', 'SocialMainList').(($request->inp_sort=='asc')?'&inp_sort=desc':'&inp_sort=asc');?>"><span class="t">Рейтинг</span></a></span></th>
									<th><span class="sort-by-this"><a class="script-link" href="#"><span class="t">Отзывы</span><i class="arrow-icon"></i></a></span></th>
									<th><a class="script-link" href="#"><span class="t">Дата создания</span></a></th>
								</tr>
							</thead>
							<tbody>
								<? foreach($this->social_pos_list as $key => $item) { ?>
								<?php 
									$user = Project::getUser()->getDbUser()->getUserByLogin($item['login']);
									$avatar = Project::getUser()->getDbUser()->getUserAvatar($user['id']);
									$avPath = $avatar['path'];
									if(!$avPath || $avPath == 'no.png') $avPath = 'no25.jpg';
								?>									
								<tr>
									<td class="qv"><a href="<?=$this->createUrl('Social', 'SocialView', array($item['id']))?>" title="<?=$item['name'];?>"><?=$item['name_cut'];?></a></td>
									<td class="av"><a href="<?=$request->createUrl('Index','Index', null, $item['login']);?>" class="avatar-link"><img src="<?=$this->image_url.'avatar/'.$avPath;?>" alt="" class="avatar" style="width:25px;height:25px;" /><span class="t"><?=$item['login']; ?></span></a></td>
									<td class="an alt-an"><?=number_format($item['avg_rating'], 2, '.',' '); ?></td>
									<td class="an"><?=$item['count_comments']; ?></td>
									<td class="date"><?=date_format(new DateTime($item['creation_date']),'d.m.y H:i'); ?></td>								
								</tr>
								<? } ?>							
							</tbody>
						</table>
  						<?php if (count($this->category_row) > 0) { ?>
          				<!-- <b>Закладки категории:</b> &nbsp;<?=$this->category_row[0]['name']; ?>	 -->
         					<?php if ($this->tag_name_selected !== null) { ?>
          						&nbsp;<b>(Тег:</b> <?=$this->tag_name_selected;?><b>)</b>
          					<? } ?>
						<?php } ?>						
					 	<ul class="pages-list clearfix">
							<?=$this->social_pos_list_pager; ?>
						</ul>
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<div class="navigation">
							<div class="title">
								<h2>Категории</h2>
								<i title="Показать фильтр" class="filter-link icon show-filter-icon"></i>
							</div>
							<?php include($this -> _include('panel_category.tpl.php')); ?>
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<?php include($this -> _include('../footer.tpl.php')); ?>