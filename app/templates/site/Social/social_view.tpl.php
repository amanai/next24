<!-- TEMPLATE: Форма просмотра Соц.позиций, добавления комментариев, оценки -->
<?php include($this -> _include('../header.tpl.php')); ?>

<script language="JavaScript" type="text/javascript" src="<?php echo $this -> js_url;?>tab.js"></script>
<link href="<?php echo $this -> css_url;?>vote.css" rel="stylesheet" type="text/css" />          

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
        <table class="questions"  style="text-align: center;" border="0">
         <tr align="center">
          <td style="width: 300px; text-align: left;"><b>Название</b></td>
          <td style="text-align: center;"><b>Рейтинг</b></td>
          <td style="text-align: center;"><b>Автор</b></td>
          <td style="text-align: center;"><b>Категория</b></td>
          <td style="text-align: center;"><b>Дата создания</b></td>
         </tr>
         <? if (count($this->social_row > 0)) { ?>
         <tr id="cmod_tab2">
          <td style="text-align: left; white-space: normal;"><p><img src="<?=$this->image_url; ?>d_ld_ico3.png" id="ico2" /><?=$this->social_row[0]['name'];?></p></td>
          
          <td>
            <table border="0" width="100%">
            <? $cnt=1; ?>
            <? foreach($this->social_row as $key => $value)  {?>
              <tr id="vote-grph">
              <td class="vote<?=$cnt++;?>" style="text-align: left; width: 130px; padding: 0px; margin: 0px;"><?=$value['criteria_name'];?><br /><span><img width="<?=number_format($value['votes_avg'], 2, '.',' ')*10;?>" src="<?=$this->image_url; ?>spacer.gif" /></span></td>
              <td style="padding: 0px; margin: 0px;"><br /><?=number_format($value['votes_avg'], 2, '.',' ');?></td>
              </tr>
            <? } ?>
              <tr>
                <td colspan="2"><hr /><b>Общий : </b><?=number_format($this->social_row[0]['avg_rating'], 3, '.',' ');?></td.
              </tr>
            </table>
      
          </td>
          <td style="text-align: center;"><a href="<?=$request->createUrl('Index','Index', null, $this->social_row[0]['login']); ;?>"><?=$this->social_row[0]['login']; ?></a></td>
          <td style="text-align: center" width="70"><?=$this->social_row[0]['social_category']; ?></td>
          <td style="text-align: center;"><?=date_format(new DateTime($this->social_row[0]['creation_date']),'d.m.y H:i'); ?></td>
         </tr>
         <? } ?>
        </table>  
       </div>     
      </div>
     </div>
    </div>
   </div>
<!-- /Вывод строки закладки -->

<!-- Панель оценки соц.позиции -->
   <div class="block_ee1">
    <div class="block_ee2">
     <div class="block_ee3">
      <div class="block_ee4">
       <div style="margin: 0px -10px;">  
        <table class="questions">
         <tr>
          <td style="width: 200; text-align: left;" colspan="4"><b>Оценка позиции</b></td>
         </tr>
         <? $a=1; 
          $a=1; 
          $a=1; ?>
         <tr id="cmod_tab2">
         <?php $v_form_action = $this->createUrl('Social', 'SocialVoteAdd', array($this->social_row[0]['id'])); ?>
         <form action="<?=$v_form_action;?>" method="post">
         <? if ($this->count_comment == 0) { ?>
           <!-- Комментариев ещё нет - оценивать пользователь не может -->
           <td style="text-align: left;" colspan="4">Для того, чтобы иметь возможность оценить позицию вам необходимо оставить хотя бы один комментарий к ней.</td>
         <? } else { ?>
         <? $v_i = 1; ?>
           <? if ($this->count_votes < 1) { ?>
           <? foreach($this->social_row as $key => $value) {?>
             <td style="text-align: left; width: 200px;">
               <?=$value['criteria_name'].' : ';?>
               <select name="inp_select_<?=$v_i;?>" style="width: 40px;" id="vote<?=$v_i;?>">
                 <option value="1">1</option>
                 <option value="2">2</option>
                 <option value="3">3</option>
                 <option value="4">4</option>
                 <option value="5" selected="">5</option>
                 <option value="6">6</option>
                 <option value="7">7</option>
                 <option value="8">8</option>
                 <option value="9">9</option>
                 <option value="10">10</option>
               </select>
               <input type="hidden" name="inp_criteria_id_<?=$v_i;?>" value="<?=$value['criteria_id'];?>">
             </td>
             <? $v_i++; ?>
           <? } ?>
           <td style="text-align: left;"><input type="submit" name="inp_submit_vote" value="Оценить"></td>
           <? } else { ?>
             <td style="text-align: left;" colspan="4">Вы уже проголосовали.</td>
           <? } ?>
         <? } ?>
         </form>
         </tr>
        </table>  
       </div>     
      </div>
     </div>
    </div>
   </div>
<!-- /Панель оценки соц.позиции -->
			
				<?=$this->comment_list?>
			
				<?php 
					if ($this -> is_logged){
						include($this -> _include('../form_add_comment.tpl.php'));
					}				  
				?>
			</div>
		</div>
		
<?php include($this -> _include('../footer.tpl.php')); ?>