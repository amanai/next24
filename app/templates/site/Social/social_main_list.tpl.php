<!-- TEMPLATE: "Каталог социальных позиций(разделов)" - основная вкладка раздела соц.позиции -->
<?php include($this -> _include('../header.tpl.php')); ?>

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