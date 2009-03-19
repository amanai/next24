<!-- TEMPLATE: "Поиск по интересам" -->
<?php include($this -> _include('../header.tpl.php')); ?>
<?php $request = Project::getRequest(); ?>

<script language="JavaScript" type="text/javascript" src="<?=$this -> js_url; ?>tab.js"></script>


<div id="tabs">
<?php include($this -> _include('../tab_panel.tpl.php')); ?>
  
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