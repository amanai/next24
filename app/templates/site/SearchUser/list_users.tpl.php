<!-- TEMPLATE: Список пользоватетелей -->
<? if (count($this->list_search_user) > 0) { ?>
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
<? } ?> 
