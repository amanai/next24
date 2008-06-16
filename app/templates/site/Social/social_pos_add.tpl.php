<!-- TEMPLATE: Форма создания Соц.позиций, добавления комментариев, оценки -->
<?php include($this -> _include('../header.tpl.php')); ?>

<script language="JavaScript" type="text/javascript" src="<?php echo $this -> js_url;?>tab.js"></script>

<script language="JavaScript" type="text/javascript">
 var arr_criterias = new Array();
 <? foreach($this->arr_social_tree_criteria as $key => $val ) { ?>
 <? 
   echo "\narr_criterias[".$key."]= new Array();";
   echo "\narr_criterias[".$key."]['social_tree_id']= ".$val['social_tree_id'].";\n";
   echo "arr_criterias[".$key."]['social_tree_name']= '".$val['social_tree_name']."';\n";
   echo "arr_criterias[".$key."]['social_criteria_id']= ".$val['social_criteria_id'].";\n";
   echo "arr_criterias[".$key."]['social_criteria_name']= '".$val['social_criteria_name']."';\n";
 ?>  
 <? } ?>
// -- Установка заголовка
function _setCaption(p_id, p_caption){
  var o = document.getElementById(p_id);
  if (o.textContent) {
    o.textContent = p_caption;
  } else {
    o.innerText = p_caption;
  }
}
// -- Отработка изменения списка КАТЕГОРИЯ 
function doChangeCat() {
  //alert('begin');
  var v_n = document.getElementById('id_sp_category').value;
  var cnt = 0;
  for (vi in arr_criterias) {
    if (arr_criterias[vi]['social_tree_id'] == v_n) {
      cnt++;
      document.getElementById('id_num_criteria_'+cnt).value = arr_criterias[vi]['social_criteria_id'];
      _setCaption('cr_'+cnt, arr_criterias[vi]['social_criteria_name']);
    }
  }
  
  if (cnt == 0) {// -- Критерии для выбранной категории отсутствуют
    for (var i=1; i<=3; i++) {
      _setCaption('cr_'+i, '---');
      document.getElementById('inp_select_'+i).disabled   = true;
    }
    _setCaption('id_sp_mess', "Для данной категории критерии не определены.");
    document.getElementById('btn_submit').disabled   = true;
  } else {
    for (var i=1; i<=3; i++) {
      document.getElementById('inp_select_'+i).disabled   = false;
    }
    _setCaption('id_sp_mess', "");
    document.getElementById('btn_submit').disabled   = false;
  }
 // alert('end');
} 
</script>

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
      <?=$this->tab_soc_pos_add?>
  </div>
<!-- вывод контента в самой странице (TabPage) - содержимого -->
<div class="tab-page tab-page-selected">
  
<!-- Вывод строки закладки -->
   <div class="block_ee1">
    <div class="block_ee2">
     <div class="block_ee3">
      <div class="block_ee4">
       <div style="margin: 0px 10px;">
       <?=$this -> flash_messages; ?>
       
         <?php $v_form_action = $this->createUrl('Social', 'SocialPosAdd'); ?>
         <form action="<?=$v_form_action;?>" method="post">
        <table class="questions"  style="text-align: left;" width="100%">
         <tr align="left">
          <td style="width: 75;"><b>* Название : </b></td>
          <td style="text-align: left;">
            <input type="text" name="inp_sp_name" style="width: 500;" value="<?=$this->inp_sp_name;?>">
          </td>
         </tr>
         <tr>
          <td><b>* Отзыв : </b></td>
          <td style="text-align: left;">
            <textarea name="inp_sp_comment" rows="5" cols="75"><?=$this->inp_sp_comment;?></textarea>
          </td>
         </tr>
         <tr>
          <td><b>Категория : </b></td>
          <td style="text-align: left;">
          <select style="width: 200;" name="inp_sp_category" id="id_sp_category" onchange="doChangeCat();">
          <? foreach($this->arr_categories as $key => $val) { ?>
            <option value="<?=$val['id'];?>"><?=$val['name'];?></option>
          <? } ?>
            </select><div style="color: blue;" id="id_sp_mess">Для данной категории критерии не определены.</div></td>
         </tr>
         <tr>
          <td><b>Оценка : </b></td>
          <td style="text-align: left;">
            <table style="width: 75%";>
              <tr>
                <td><p id="cr_1">Критерий 1</p></td>
                <td>
                   <input type="hidden" name="inp_num_criteria_1" id="id_num_criteria_1" value="0">
                   <select name="inp_select_1" style="width: 35px;">
                     <option value="1">1</option>
                     <option value="2">2</option>
                     <option value="3">3</option>
                     <option value="4">4</option>
                     <option value="5">5</option>
                     <option value="6">6</option>
                     <option value="7">7</option>
                     <option value="8">8</option>
                     <option value="9">9</option>
                     <option value="10">10</option>
                   </select>
                </td>
                <td><p id="cr_2">Критерий 2</p></td>
                <td>
                   <input type="hidden" name="inp_num_criteria_2" id="id_num_criteria_2" value="0">
                   <select name="inp_select_2" style="width: 35px;">
                     <option value="1">1</option>
                     <option value="2">2</option>
                     <option value="3">3</option>
                     <option value="4">4</option>
                     <option value="5">5</option>
                     <option value="6">6</option>
                     <option value="7">7</option>
                     <option value="8">8</option>
                     <option value="9">9</option>
                     <option value="10">10</option>
                   </select>
                </td>
                <td><p id="cr_3">Критерий 3</p></td>
                <td>
                   <input type="hidden" name="inp_num_criteria_3" id="id_num_criteria_3" value="0">
                   <select name="inp_select_3" style="width: 35px;">
                     <option value="1">1</option>
                     <option value="2">2</option>
                     <option value="3">3</option>
                     <option value="4">4</option>
                     <option value="5">5</option>
                     <option value="6">6</option>
                     <option value="7">7</option>
                     <option value="8">8</option>
                     <option value="9">9</option>
                     <option value="10">10</option>
                   </select>
                </td>
              </tr>
            </table>
              <tr>
                <td colspan="2" style="text-align: center;"><input type="submit" name="btn_submit" value="Создать"></td>
              </tr>
              
          </td>
         </tr>
        </table>  
        </form>
       </div>     
      </div>
     </div>
    </div>
   </div>
<!-- /Вывод строки закладки -->

			
			
			</div>
		</div>
<script language="JavaScript" type="text/javascript">
  doChangeCat()
</script>
		
<?php include($this -> _include('../footer.tpl.php')); ?>