<!-- TEMPLATE: "Мои соц.позиции" - соц.позиции пользователя -->
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
							показывать по:
							<?php if(!$spp || $spp == 10){ ?>
									<strong>10</strong> | <a href="<?php echo $this->createUrl('Social', 'SocialUserList', null, false).$add; ?>/spp:20">20</a> | <a href="<?php echo $this->createUrl('Social', 'SocialUserList', null, false).$add; ?>/spp:30">30</a> сервисов
							<?php }elseif($spp == 20) { ?>
									<a href="<?php echo $this->createUrl('Social', 'SocialUserList', null, false).$add; ?>/spp:10">10</a> | <strong>20</strong> | <a href="<?php echo $this->createUrl('Social', 'SocialUserList', null, false).$add; ?>/spp:30">30</a> сервисов
							<?php } elseif($spp == 30) { ?>	
									<a href="<?php echo $this->createUrl('Social', 'SocialUserList', null, false).$add; ?>/spp:10">10</a> | <a href="<?php echo $this->createUrl('Social', 'SocialUserList', null, false).$add; ?>/spp:20">20</a> | <strong>30</strong> сервисов
							<? } ?>	
							</div>
						</div>
						<!-- /display-filter -->
						<table class="stat-table">
							<thead>
								<tr>
									<th class="main-row">Название</th>
									<th><a class="script-link" href="<?php echo $this->createUrl('Social', 'SocialUserList', null, false).((($request->inp_sort=='asc')&&($request->type=='author'))?'/inp_sort:desc/type:author':'/inp_sort:asc/type:author'); ?>"><span class="t">Автор</span></a></th>
									<th><span><a class="script-link" href="<?php echo $this->createUrl('Social', 'SocialUserList').((($request->inp_sort=='asc')&&($request->type=='reit'))?'/inp_sort:desc/type:reit':'/inp_sort:asc/type:reit');?>"><span class="t">Рейтинг</span></a></span></th>
									<th><span class="sort-by-this"><a class="script-link" href="<?php echo $this->createUrl('Social', 'SocialUserList', null, false).((($request->inp_sort=='asc')&&($request->type=='reply'))?'/inp_sort:desc/type:reply':'/inp_sort:asc/type:reply'); ?>"><span class="t">Отзывы</span><i class="arrow-icon"></i></a></span></th>
									<th><a class="script-link" href="<?php echo $this->createUrl('Social', 'SocialUserList', null, false).((($request->inp_sort=='asc')&&($request->type=='create'))?'/inp_sort:desc/type:create':'/inp_sort:asc/type:create'); ?>"><span class="t">Дата создания</span></a></th>
              						<th>Действие</th>							
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
									<td class="qv"><a href="<?=$this->createUrl('Social', 'SocialView', array($item['id']))?>" title="<?=$item['name'];?>"><?=$item['name_cut'];?></a>
               							<?php if($item['id_product']) {?>
               								<?php echo '('.$item['full_name'].')'; ?>
               								<span style="cursor:pointer;cursor:hand;" onclick="Ycoord = <?=$item['Ycoord'];?>; Xcoord = <?=$item['Xcoord'];?>; window.open('http://next24.home/popup.html','map','toolbar=0,width=520,height=350,location=0,menubar=0,resizable=0,status=map'); return false;">посмотреть на карте</span>
               							<?php }?>																		
									</td>
									<td class="av"><a href="<?=$request->createUrl('Index','Index', null, $item['login']);?>" class="avatar-link"><img src="<?=$this->image_url.'avatar/'.$avPath;?>" alt="" style="width:25px;height:25px;" class="avatar" /><span class="t"><?=$item['login']; ?></span></a></td>
									<td class="an alt-an"><?=number_format($item['avg_rating'], 2, '.',' '); ?></td>
									<td class="an"><?=$item['count_comments']; ?></td>
									<td class="date"><?=date_format(new DateTime($item['creation_date']),'d.m.y H:i'); ?></td>
									<?php if($item['user_id'] == Project::getUser()->getDbUser()->id) { ?>
										<td>
              								<a href=<?=$this->createUrl('Social','SocialDelete',array($item['id']))?>>[Удалить]</a> 
              							</td>	
            						<?php } else { ?>
            							<td>
            								-
            							</td>
            						<? } ?>								
								</tr>
								<? } ?>							
							</tbody>
						</table>
  						<?php if (count($this->category_row) > 0) { ?>
          			<!--  	<b>Позиции категории:</b> &nbsp;<?=$this->category_row[0]['name']; ?>	-->
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
						<?php include($this -> _include('panel_control.tpl.php')); ?>				
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
        				<!-- <img src="http://maps.google.com/staticmap?center=40.714728,-73.998672&zoom=14&size=512x512&maptype=mobile\&markers=40.702147,-74.015794,blues%7C40.711614,-74.012318,greeng%7C40.718217,-73.998284,redc\&key=ABQIAAAAIMN2iaCMFuGQ7iw1w3khQhR-v9yHoD50evrZ-pbO1wgn-sHpRBTCwGDBW1h8fK3f31phKFZTanuxDA" style="width: 500px; height: 300px" /> -->
		<!-- 		 <form action="#" onsubmit="showAddress(this.address.value); return false"> 
				    <input type="text" size="60" name="address" value="1600 Amphitheatre Pky, Mountain View, CA" /> 
        			<input type="submit" value="Go!" /> 
    			  	<div id="map_canvas" style="width: 500px; height: 300px"></div>	    
    			  </form>	-->		  
<?php include($this -> _include('../footer.tpl.php')); ?>