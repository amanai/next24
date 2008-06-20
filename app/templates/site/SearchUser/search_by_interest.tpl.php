<!-- TEMPLATE: "Поиск по интересам" -->
<?php include($this -> _include('../header.tpl.php')); ?>

<script language="JavaScript" type="text/javascript" src="<?=$this -> js_url; ?>tab.js"></script>

<div id="tabs">
<?php $request = Project::getRequest(); ?>
  <div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
    <a href="<?=$request->createUrl('SearchUser','SearchUserMain'); ?>"><?=$this->tab_main_search; ?></a>
  </div>
  <div class="tab tab-selected" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
    <a href="<?=$request->createUrl('SearchUser','SearchByInterest'); ?>"><?=$this->tab_search_interest; ?></a>
  </div>
  
<div class="tab-page tab-page-selected">
<!-- Вопросы пользователей -->

<table  width="100%" height="100%" cellpadding="0">
 <tr>
  <td class="next24u_right">
  <!-- Панелька "Поиск" -->
   <div class="block_ee1" style="width: 450px;">
    <div class="block_ee2">
     <div class="block_ee3">
      <div class="block_ee4">
      <div  style="margin: 0px 10px;">
      <div class="block_title"><h3><?=$this->tab_main_search; ?></h3></div>
      <form name="frm_search" method="post" action="<?=$this->createUrl('SearchUser', 'SearchUserMain');?>">
      <table border="0" align="center">
        <tr style="height: 30px;"><td style="text-align: right;">
        Я ищу <select name="select_search_sex">
                 <option value="0" <? if ($this->p_search_sex == 0) echo 'selected="selected"';?>>девушку</option>
                 <option value="1" <? if ($this->p_search_sex == 1) echo 'selected="selected"';?>>парня</option>
                 <option value="2" <? if ($this->p_search_sex == 2) echo 'selected="selected"';?>>парня или девушку</option>
               </select>
        </td></tr>
        <tr style="height: 30px;"><td style="text-align: right;">
         В возрасте от <input type="text" name="inp_search_age_from" value="<?=$this->p_search_age_from;?>" size="5" maxlength="2"/>
                    до <input type="text" name="inp_search_age_to"   value="<?=$this->p_search_age_to;?>"   size="5" maxlength="2"/>
        </td></tr>
        <tr style="height: 30px;"><td style="text-align: right;">
         Из страны:
           <select name="select_search_counrty">
             <option value="0">не важно</option>
           <? 
           foreach($this->list_country as $key=>$val) {
             ?>
             <option value="<?=$val['id'];?>" <? if ($this->p_search_counrty == $val['id']) echo 'selected="selected"';?>><?=$val['name'];?></option>
           <? } ?>
           </select>
        </td></tr>
        <tr style="height: 30px;"><td style="text-align: right;">
        Имя на сайте (целиком или частично): 
          <input type="text" name="inp_search_login" value="<?=$this->p_search_login;?>" size="30"/ maxlength="30">
        </td></tr>
        <tr style="height: 30px;"><td style="text-align: right;">
          <input type="checkbox" name="chk_search_with_photo" <? if ($this->p_search_with_photo == true) echo 'checked';?>> С фотографией
        </td></tr>
        <tr style="height: 30px;"><td style="text-align: right;">
        <input type="submit" name="btn_search" value="Искать">
        </td></tr>
        </table>
        <input type="hidden" name="inp_hide" value="find">
      </form>
      </div>
     </div>
    </div>
    </div>
   </div>
  <!-- /Панелька "Поиск" -->
  
  <!-- Выдача результата поиска -->
   <div class="block_ee1">
    <div class="block_ee2">
     <div class="block_ee3">
      <div class="block_ee4">
    <div class="cmod_tab11">
      <table class="cmod_x" width="100%" border="0">
      <? foreach($this->list_search_user as $key => $item) { ?>
      <?   ($key%2==0) ? $v_id = "cmod_tab1" : $v_id = "cmod_tab2"; ?>
      <tr class="<?=$v_id; ?>" valign="top">                 <!-- id="" -->
      
        <td class="cmod_x1" width="120" align="center">
          <h2><a href="<?=$request->createUrl('Index','Index', null, $item['login']); ;?>"><?=$item['login']; ?></a></h2>
                      <img src="#"  width="100" height="100" border="2"/>
                  </td>
        <td class="cmod_x2">
          <? if ($item['country_name'] != '') { echo $item['country_name'].','; } ?>
          <?=$item['city_name'];?><br />
          Фото: <?=$item['count_photos'];?><br />
          <? if ($item['user_age'] != '') { ?>
            <?=$item['user_age'];?> лет<br />
          <? } ?>
          <? if ($item['registration_date'] != '') { ?>
            Зарегистрирован : <?=date_format(new DateTime($item['registration_date']),'d.m.Y');?><br />
          <? } ?>
          
                  </td>
        <td class="cmod_x3" width="130" valign="bottom">
          <a href="<?=$request->createUrl('Index','Index', null, $item['login']); ;?>">Профиль</a><br />
          <a href="#"><b>Написать сообщение</b></a>
        </td>
      </tr>
      <? } ?> 
      </table>
    </div>  
     </div>
    </div>
    </div>
   </div>
  <!-- /Выдача результата поиска -->

  <!-- Pager - страничная листалка -->  
    <?=$this->search_user_list_pager; ?>
  <!-- /Pager - страничная листалка -->  

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