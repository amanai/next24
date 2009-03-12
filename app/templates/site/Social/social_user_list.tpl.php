<!-- TEMPLATE: "Мои соц.позиции" - соц.позиции пользователя -->
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
   <?php include($this -> _include('panel_control.tpl.php')); ?>
   <!-- /панель слева -->
  </td>
  <td class="next24u_right">
  <!-- панель-строка открытой категории -->
  <?php if (count($this->category_row) > 0) { ?>
  <div class="block_ee1">
    <div class="block_ee2">
      <div class="block_ee3">
        <div class="block_ee4">
          <div style="margin: 0px 10px;">
          <b>Позиции категории:</b> &nbsp;<?=$this->category_row[0]['name']; ?>
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
          <td style="width: 100%; text-align: left;"><b>Название</b></td>
          <td><b>Автор</b></td>
          <td><b>Общий рейтинг</b></td>
          <td><b>Отзывов</b></td>
          <td><b>Дата создания</b></td>
          <td style="text-align: center;"><b>Действие</b></td>
         </tr>
         <? foreach($this->social_pos_list as $key => $item) { ?>
         <?   ($key%2==0) ? $v_id = "cmod_tab2" : $v_id = "cmod_tab1"; ?>
         <tr id="<?=$v_id; ?>">
          <td style="text-align: left; white-space: normal;">
           <img src="<?=$this->image_url; ?>d_ld_ico3.png" id="ico2" />
             <a href="<?=$this->createUrl('Social', 'SocialView', array($item['id']))?>"><?=$item['name_cut'];?></a>
               <!-- $this- >createUrl('Bookmarks', 'BookmarksView', array($item['id'])) -->
               <!-- $item['description'] -->
               &nbsp;&nbsp;&nbsp;
               <?php if(!$item['id_product']) {?>
               		<span style="cursor:pointer;cursor:hand;" onclick="Ycoord = <?=$item['Ycoord'];?>; Xcoord = <?=$item['Xcoord'];?>; window.open('http://next24.home/popup.html','map','toolbar=0,width=520,height=350,location=0,menubar=0,resizable=0,status=map'); return false;">посмотреть на карте</span>
               <?php }?>	
          </td>
          <td style="text-align: center;"><a href="<?=$request->createUrl('Index','Index', null, $item['login']); ;?>"><?=$item['login']; ?></a></td>
          <td style="text-align: center;"><?=number_format($item['avg_rating'], 2, '.',' '); ?></td>
          <td style="text-align: center;"><?=$item['count_comments']; ?></td>
          <td><?=date_format(new DateTime($item['creation_date']),'d.m.y H:i'); ?></td>
          <td>
            <?php if($item['user_id'] == Project::getUser()->getDbUser()->id) { ?>
              <a href=<?=$this->createUrl('Social','SocialDelete',array($item['id']))?>>[Удалить]</a> 
            <?php } ?>
          </td>
         </tr>
         <? } ?>
        </table>
       </div>
   <!-- листинг -->
        				<!-- <img src="http://maps.google.com/staticmap?center=40.714728,-73.998672&zoom=14&size=512x512&maptype=mobile\&markers=40.702147,-74.015794,blues%7C40.711614,-74.012318,greeng%7C40.718217,-73.998284,redc\&key=ABQIAAAAIMN2iaCMFuGQ7iw1w3khQhR-v9yHoD50evrZ-pbO1wgn-sHpRBTCwGDBW1h8fK3f31phKFZTanuxDA" style="width: 500px; height: 300px" /> -->
		<!-- 		 <form action="#" onsubmit="showAddress(this.address.value); return false"> 
				    <input type="text" size="60" name="address" value="1600 Amphitheatre Pky, Mountain View, CA" /> 
        			<input type="submit" value="Go!" /> 
    			  	<div id="map_canvas" style="width: 500px; height: 300px"></div>	    
    			  </form>	-->		  
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