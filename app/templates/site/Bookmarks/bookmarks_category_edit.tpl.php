<!-- TEMPLATE: Страница редактирования категории закладки -->
<?php include($this -> _include('../header.tpl.php')); ?>


<script language="JavaScript" type="text/javascript" src="<?=$this -> js_url; ?>tab.js"></script>
<script language="JavaScript" type="text/javascript" src="<?=$this -> js_url; ?>bookmarks_category_panel.tpl.js"></script>

<div id="tabs">
<?php $request = Project::getRequest(); ?>
  <div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
    <a href="<?=$request->createUrl('Bookmarks','BookmarksList'); ?>"><?=$this->tab_list_name; ?></a>
  </div>
  <div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
    <a href="<?=$request->createUrl('Bookmarks','BookmarksMostVisit'); ?>" title="<?=$this->tab_most_visit; ?>"><?=$this->tab_most_visit; ?></a>
  </div>
<? if($this->current_user && $this->current_user->id > 0) { ?>
  <div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
    <a href="<?=$request->createUrl('Bookmarks','BookmarksUser'); ?>" title="<?=$this->tab_my_list_name; ?>"><?=$this->tab_my_list_name; ?></a>
  </div>
<? } ?>
  <div class="tab tab-selected" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
    <a href="<?=$request->createUrl('Bookmarks','BookmarksCategoryEdit'); ?>" title="<?=$this->tab_most_visit; ?>"><?=$this->tab_category_edit; ?></a>
  </div>
  
<div class="tab-page tab-page-selected">
<!-- Основной блок -->

<table  width="100%" height="100%" cellpadding="0">
 <tr>
  <td class="next24u_left">
   <!-- панель слева -->
   <?php include($this -> _include('panel_category.tpl.php')); ?>
   <?php include($this -> _include('panel_control.tpl.php')); ?>
   <!-- /панель слева -->
  </td>
  <td class="next24u_right">
    <div class="info" id="flash_message"><?php echo $this -> flash_messages; ?></div>
    <!-- Создание/редактирование категории закладки -->
    <div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
    <?php require('form_categoty_edit.tpl.php'); ?>
    </div></div></div></div>
    <!-- /Создание/редактирование категории закладки -->
  </td>
 </tr>
</table>
  <!-- /Основной блок -->
</div>
</div>

<?php include($this -> _include('../footer.tpl.php')); ?>