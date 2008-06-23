<!-- TEMPLATE: "Найти знакомых" - основная вкладка -->
<?php include($this -> _include('../header.tpl.php')); ?>

<script language="JavaScript" type="text/javascript" src="<?=$this -> js_url; ?>tab.js"></script>

<div id="tabs">
<?php $request = Project::getRequest(); ?>
  <div class="tab tab-selected" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
    <a href="<?=$request->createUrl('SearchUser','SearchUserMain'); ?>"><?=$this->tab_main_search; ?></a>
  </div>
  <div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
    <a href="<?=$request->createUrl('SearchUser','SearchByInterest'); ?>"><?=$this->tab_search_interest; ?></a>
  </div>
  
<div class="tab-page tab-page-selected">
<!-- Вкладка -->

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
<?php include($this -> _include('list_users.tpl.php')); ?>
  <!-- /Выдача результата поиска -->

  <!-- Pager - страничная листалка -->  
    <?=$this->search_user_list_pager; ?>
  <!-- /Pager - страничная листалка -->  

  </td>
 </tr>
</table>
  <!-- /Вкладка -->
</div>
</div>

<?php include($this -> _include('../footer.tpl.php')); ?>