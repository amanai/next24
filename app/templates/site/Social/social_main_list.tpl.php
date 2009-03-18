<!-- TEMPLATE: "Каталог социальных позиций(разделов)" - основная вкладка раздела соц.позиции -->
<?php include($this -> _include('../header.tpl.php')); ?>

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
								<li><strong>Каталог позиций<span></span></strong></li>
								<li><a href="#">Популярные</a></li>
							</ul>
						</div>
						<!-- /view-filter -->
						<div class="display-filter clearfix">
							<div class="number-filter">
								показывать по: <strong>10</strong> | <a href="#">20</a> | <a href="#">30</a> ответов
							</div>
						</div>
						<!-- /display-filter -->
						<table class="stat-table">
							<thead>
								<tr>
									<th class="main-row">Название</th>
									<th><a class="script-link" href="#"><span class="t">Автор</span></a></th>
									<th><span><a class="script-link" href="#"><span class="t">Рейтинг</span></a></span></th>
									<th><span class="sort-by-this"><a class="script-link" href="#"><span class="t">Отзывы</span><i class="arrow-icon"></i></a></span></th>
									<th><a class="script-link" href="#"><span class="t">Дата создания</span></a></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="qv"><a href="#">Крутая тачка AUDI R8.</a></td>
									<td class="av"><a href="#" class="avatar-link"><img src="assets/i/temp/avatar.s.jpg" alt="" class="avatar" /><span class="t">Викторчик</span></a></td>
									<td class="an alt-an">75.96</td>
									<td class="an">12</td>
									<td class="date">20 января 2009, 18:53</td>
								</tr>
								<tr>
									<td class="qv"><a href="#">Крутая тачка AUDI R8. Крутая тачка AUDI R8. Крутая тачка AUDI R8. Крутая тачка AUDI R8.</a></td>
									<td class="av"><a href="#" class="avatar-link"><img src="assets/i/temp/avatar.s.jpg" alt="" class="avatar" /><span class="t">Викторчик</span></a></td>
									<td class="an alt-an">75.96</td>
									<td class="an">12</td>
									<td class="date">20 января 2009, 18:53</td>
								</tr>
								<tr>
									<td class="qv"><a href="#">Крутая тачка AUDI R8.</a></td>
									<td class="av"><a href="#" class="avatar-link"><img src="assets/i/temp/avatar.s.jpg" alt="" class="avatar" /><span class="t">Викторчик</span></a></td>
									<td class="an alt-an">75.96</td>
									<td class="an">12</td>
									<td class="date">20 января 2009, 18:53</td>
								</tr>
								<tr>
									<td class="qv"><a href="#">Крутая тачка AUDI R8.</a></td>
									<td class="av"><a href="#" class="avatar-link"><img src="assets/i/temp/avatar.s.jpg" alt="" class="avatar" /><span class="t">Викторчик</span></a></td>
									<td class="an alt-an">75.96</td>
									<td class="an">12</td>
									<td class="date">20 января 2009, 18:53</td>
								</tr>
								<tr>
									<td class="qv"><a href="#">Крутая тачка AUDI R8.</a></td>
									<td class="av"><a href="#" class="avatar-link"><img src="assets/i/temp/avatar.s.jpg" alt="" class="avatar" /><span class="t">Викторчик</span></a></td>
									<td class="an alt-an">75.96</td>
									<td class="an">12</td>
									<td class="date">20 января 2009, 18:53</td>
								</tr>
								<tr>
									<td class="qv"><a href="#">Крутая тачка AUDI R8.</a></td>
									<td class="av"><a href="#" class="avatar-link"><img src="assets/i/temp/avatar.s.jpg" alt="" class="avatar" /><span class="t">Викторчик</span></a></td>
									<td class="an alt-an">75.96</td>
									<td class="an">12</td>
									<td class="date">20 января 2009, 18:53</td>
								</tr>
								<tr>
									<td class="qv"><a href="#">Крутая тачка AUDI R8.</a></td>
									<td class="av"><a href="#" class="avatar-link"><img src="assets/i/temp/avatar.s.jpg" alt="" class="avatar" /><span class="t">Викторчик</span></a></td>
									<td class="an alt-an">75.96</td>
									<td class="an">12</td>
									<td class="date">20 января 2009, 18:53</td>
								</tr>
								<tr>
									<td class="qv"><a href="#">Крутая тачка AUDI R8.</a></td>
									<td class="av"><a href="#" class="avatar-link"><img src="assets/i/temp/avatar.s.jpg" alt="" class="avatar" /><span class="t">Викторчик</span></a></td>
									<td class="an alt-an">75.96</td>
									<td class="an">12</td>
									<td class="date">20 января 2009, 18:53</td>
								</tr>
								<tr>
									<td class="qv"><a href="#">Крутая тачка AUDI R8.</a></td>
									<td class="av"><a href="#" class="avatar-link"><img src="assets/i/temp/avatar.s.jpg" alt="" class="avatar" /><span class="t">Викторчик</span></a></td>
									<td class="an alt-an">75.96</td>
									<td class="an">12</td>
									<td class="date">20 января 2009, 18:53</td>
								</tr>
								<tr>
									<td class="qv"><a href="#">Крутая тачка AUDI R8.</a></td>
									<td class="av"><a href="#" class="avatar-link"><img src="assets/i/temp/avatar.s.jpg" alt="" class="avatar" /><span class="t">Викторчик</span></a></td>
									<td class="an alt-an">75.96</td>
									<td class="an">12</td>
									<td class="date">20 января 2009, 18:53</td>
								</tr>
							</tbody>
						</table>
						<ul class="pages-list clearfix">
							<li class="control"><a href="#">« Назад</a> <a href="#">Вперед »</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><strong>3</strong></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">6</a></li>
							<li><a href="#">7</a></li>
							<li>...</li>
							<li><a href="#">34</a></li>
						</ul>
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<div class="navigation">
							<div class="title">
								<h2>Категории</h2>
								<i title="Показать фильтр" class="filter-link icon show-filter-icon"></i>
							</div>
							<ul class="nav-list">
								<li><a href="#">Авио</a></li>
								<li><a href="#">Internet</a></li>
								<li><a href="#">Linux для всех</a></li>
								<li><a href="#">Стартапы</a></li>
								<li><a href="#">Типографика</a></li>
								<li><a href="#">Apple</a></li>
								<li><a href="#">Дизайн</a></li>
								<li><a href="#">Программирование</a></li>
								<li><a href="#">Юмор</a></li>
								<li><a href="#">Internet</a></li>
								<li><a href="#">Linux для всех</a></li>
								<li><a href="#">Стартапы</a></li>
								<li><a href="#">Типографика</a></li>
							</ul>
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
				
				
				
				
				
				
				
				
<script language="JavaScript" type="text/javascript" src="<?=$this -> js_url; ?>tab.js"></script>
<script language="JavaScript" type="text/javascript" src="<?=$this -> js_url; ?>category_panel.js"></script>

<div id="tabs">
<?php $request = Project::getRequest(); ?>
<?php include($this -> _include('../tab_panel.tpl.php')); ?>
  
<div class="tab-page tab-page-selected">
<!-- Вопросы пользователей -->

<table  width="100%" height="100%" cellpadding="0">
 <tr>
  <td class="next24u_left">
   <!-- панель слева -->
   <?php include($this -> _include('panel_category.tpl.php')); ?>
   <!-- /панель слева -->
  </td>
  <td class="next24u_right">
  <!-- Панелька "Поиск" -->
   <div class="block_ee1">
    <div class="block_ee2">
     <div class="block_ee3">
      <div class="block_ee4">
      <div  style="margin: 0px 10px;">
      <form name="frm_find" method="post" action="<?php echo $this->createUrl('Social', 'SocialMainList');?>">
        <input type="hidden" name="inp_hide" value="find">
        Поиск по имени: <input type="text" name="inp_find" value="<?=$this->str_find; ?>"> <input type="submit" name="btn_find" value="искать">
      </form>
      </div>
     </div>
    </div>
    </div>
   </div>
  <!-- /Панелька "Поиск" -->
  <!-- панель-строка открытой категории -->
  <?php if (count($this->category_row) > 0) { ?>
  <div class="block_ee1">
    <div class="block_ee2">
      <div class="block_ee3">
        <div class="block_ee4">
          <div style="margin: 0px 10px;">
          <b>Закладки категории:</b> &nbsp;<?=$this->category_row[0]['name']; ?>
          <?php if ($this->tag_name_selected !== null) { ?>
          &nbsp;<b>(Тег:</b> <?=$this->tag_name_selected;?><b>)</b>
          <? } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
  <!-- /панель-строка открытой категории -->
   <div class="block_ee1">
    <div class="block_ee2">
     <div class="block_ee3">
      <div class="block_ee4">
       <div style="margin: 0px -10px;">
        <table class="questions">
         <tr>
          <td style="text-align: left;"><b>Название</b></td>
          <td><b>Автор</b></td>
          <!--<td><b>Категория</b></td>  onsubmit="alert(inp_sort.value);"-->
          <td>                                                                                                          
          <form name="inp_sort_rating" method="post" action="<?php echo $this->createUrl('Social', 'SocialMainList');?>">
            <b>Общий рейтинг</b>
            <input type="image" src="<?=$this->image_url; ?>sort_up.png"   onclick="inp_sort.value='asc';">
            <input type="image" src="<?=$this->image_url; ?>sort_down.png" onclick="inp_sort.value='desc'">
            <input type="hidden" name="inp_sort" value="1">
          </form>
          </td>
          <td><b>Отзывов</b></td>
          <td><b>Дата создания</b></td>
         </tr>
         <? foreach($this->social_pos_list as $key => $item) { ?>
         <?   ($key%2==0) ? $v_id = "cmod_tab2" : $v_id = "cmod_tab1"; ?>
         <tr id="<?=$v_id; ?>">
          <td style="text-align: left; white-space: normal;">
           <img src="<?=$this->image_url; ?>d_ld_ico3.png" id="ico2" />
             <a href="<?=$this->createUrl('Social', 'SocialView', array($item['id']))?>" title="<?=$item['name'];?>"><?=$item['name_cut'];?></a>
               <!-- $this- >createUrl('Bookmarks', 'BookmarksView', array($item['id'])) -->
               <!-- $item['description'] -->
          </td>
          <td style="text-align: center;"><a href="<?=$request->createUrl('Index','Index', null, $item['login']); ;?>"><?=$item['login']; ?></a></td><!-- TODO: User profile -->
          <td style="text-align: center;"><?=number_format($item['avg_rating'], 2, '.',' '); ?></td>
          <td style="text-align: center;"><?=$item['count_comments']; ?></td>
          <td><?=date_format(new DateTime($item['creation_date']),'d.m.y H:i'); ?></td>
         </tr>
         <? } ?>
        </table>
       </div>
   <!-- листинг -->

    <?=$this->social_pos_list_pager; ?>
   <!-- /листинг -->
      </div>
     </div>
    </div>
   </div>
  </td>
 </tr>
</table>
  <!-- /Вопросы пользователей -->
</div>
</div>

<?php include($this -> _include('../footer.tpl.php')); ?>