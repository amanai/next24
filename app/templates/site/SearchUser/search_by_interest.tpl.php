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
<!-- Вкладка -->
<?php include($this -> _include('list_tags.tpl.php')); ?>
<table  width="100%" height="100%" cellpadding="0">
 <tr>
  <td class="next24u_right">
  
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