<!-- TEMPLATE: Форма создания Соц.позиций, добавления комментариев, оценки -->
<?php include($this -> _include('../header.tpl.php')); ?> 
<?php $request = Project::getRequest(); ?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<div class="view-filter clearfix">
							<ul class="clearfix">
								<?php include($this -> _include('../tab_panel.tpl.php')); ?>
							</ul>
						</div>
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
  //alert(v_n);
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
    }
    _setCaption('id_sp_mess', "Для данной категории критерии не определены.");
    document.getElementById('id_div_vote1').style.visibility = 'hidden';
    document.getElementById('id_div_vote2').style.visibility = 'hidden';
    
  } else {
    _setCaption('id_sp_mess', " ");
    document.getElementById('id_div_vote1').style.visibility = 'visible';
    document.getElementById('id_div_vote2').style.visibility = 'visible';
  }
 // alert('end');
} 
</script>

		<div id="tabs">
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
            </select>
            <div style="color: blue;" id="id_sp_mess">Для данной категории критерии не определены.</div>            
            </td>
         </tr>
         <tr>
         	<td>
         		<b>Тип позиции :</b>     		
         	</td>
         	<td style="text-align: left;">
         		Продукт <input type="checkbox" name="type_prod" value="1" onclick="if(this.checked){getElementById('type_num').style.display='block'; getElementById('type_place').style.display='block';} else {getElementById('type_num').style.display='none'; getElementById('type_place').style.display='none'; getElementById('address').style.display='none'; getElementById('chk_type_place').checked='';}" />
         		<select name=id_product id="type_num" style="display: none;">
         			<?php foreach($this->_stack['product_places'] as $key => $value) {
         				echo '<option value="'.$key.'">'.$value['full_name'].'</option>';
         			}?>   
         		</select> 
         		<div id="type_place" style="display: none;">      		
         				Место <input id="chk_type_place" type="checkbox" name="type_place" value="1"  onclick="if(this.checked){getElementById('address').style.display='block';} else {getElementById('address').style.display='none';}" />
         			<div id="address" style="display: none;">	
         				<span class="field">	
         					<label for="country" class="label">Страна</label>
							<select name="country" id="country" onChange='changeList(<?=$this->change_country_param;?>, this);' class="field">
								<option value="0">не важно</option>
							<?php foreach($this -> country_list as $item) { ?>
								<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> country === (int)$item['id']){ echo 'selected="selected"';}?>><?php echo $item['name'];?></option>
							<?php } ?>
							</select> 
						</span>	 
						<div id="state_div">
						</div>
						<div id="city_div">			
						</div>
         				<span id="street_house" style="display:none;">
         					улица : <input type="text" value=""	name="street" /> 
         					дом : <input type="text" value="" name="house" style="width:25px;"/>
         				</span> 
         			</div>							
				</div>											       			   		
         	</td>
         </tr>
         <tr id="id_div_vote1">
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
          </td>
         </tr>
         <tr id="id_div_vote2">
         	<td colspan="2" style="text-align: center;"><input type="submit" name="btn_submit" value="Создать"></td>
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
<?php include($this -> _include('../footer.tpl.php')); ?>