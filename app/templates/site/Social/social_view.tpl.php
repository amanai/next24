<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Форма просмотра закладки BookmarksViewAction -->

<script language="JavaScript" type="text/javascript" src="<?php echo $this -> js_url;?>tab.js"></script>

		<div id="tabs">
<?php $request = Project::getRequest(); ?>
  <div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
    <a href="<?=$request->createUrl('Social','SocialMainList'); ?>"><?=$this->tab_main_list; ?></a>
  </div>
  <div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
    <a href="<?=$request->createUrl('Social','SocialLastAddPos'); ?>" title="<?=$this->tab_last_add_pos_list; ?>"><?=$this->tab_last_add_pos_list; ?></a>
  </div>
<? if($this->current_user && $this->current_user->id > 0) { ?>
  <div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
    <a href="<?=$request->createUrl('Social','SocialUserList'); ?>" title="<?=$this->tab_user_list; ?>"><?=$this->tab_user_list; ?></a>
  </div>
<? } ?>
  <div class="tab tab-selected" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
      <?=$this->tab_social_view?>
  </div>
<!-- вывод контента в самой странице (TabPage) - содержимого -->
<div class="tab-page tab-page-selected">
  
<!-- Вывод строки закладки -->
   <div class="block_ee1">
    <div class="block_ee2">
     <div class="block_ee3">
      <div class="block_ee4">
       <div style="margin: 0px -10px;">
        <table class="questions">
         <tr>
          <td style="width: 200; text-align: left;"><b>Название</b></td>
          <td style="text-align: center;"><b>Рейтинг</b></td>
          <td style="text-align: center;"><b>Автор</b></td>
          <td style="text-align: center;"><b>Категория</b></td>
          <td style="text-align: center;"><b>Дата создания</b></td>
         </tr>
         <? if (count($this->social_row > 0)) { ?>
         <tr id="cmod_tab2">
          <td style="text-align: left; white-space: normal;"><p><img src="<?=$this->image_url; ?>d_ld_ico3.png" id="ico2" /><?=$this->social_row[0]['name'];?></p></td>
          
          <td>
            <? foreach($this->social_row as $key => $value)  {?>
            <?=$value['criteria_name'].' : '.number_format($value['votes_avg'], 2, '.',' ').'<br />';?>
            <? } ?><hr />
          <b>Общий : </b><?=number_format($this->social_row[0]['avg_rating'], 3, '.',' ');?>
          </td>
          <td style="text-align: center;"><a href="<?=$request->createUrl('Index','Index', null, $this->social_row[0]['login']); ;?>"><?=$this->social_row[0]['login']; ?></a></td>
          <td style="text-align: center" width="70"><?=$this->social_row[0]['social_category']; ?></td>
          <td><?=date_format(new DateTime($this->social_row[0]['creation_date']),'d.m.y H:i'); ?></td>
         </tr>
         <? } ?>
        </table>  
       </div>     
       <p style="text-indent: 1em;"><?=$this->bookmark_row['description'];?></p>
      </div>
     </div>
    </div>
   </div>
<!-- /Вывод строки закладки -->
			
				<?=$this->comment_list?>
			
				<?php 
					if ($this -> is_logged){
						include($this -> _include('../form_add_comment.tpl.php'));
					}				  
				?>
			</div>
		</div>
		
<?php include($this -> _include('../footer.tpl.php')); ?>