<?php include($this -> _include('../header.tpl.php')); ?>

<script language="JavaScript" type="text/javascript" src="<?=$this -> js_url; ?>tab.js"></script>
<script language="JavaScript" type="text/javascript" src="<?=$this -> js_url; ?>bookmarks_category_panel.tpl.js"></script>

<div id="tabs">
<?php $request = Project::getRequest(); ?>
<div class="tab tab-selected" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
  <a href="<?=$request->createUrl('Bookmarks','BookmarksList'); ?>"><?=$this->tab_list_name; ?></a>
</div>
<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
  <a href="<?=$request->createUrl('Bookmarks','BookmarksMostVisit'); ?>" title="<?=$this->tab_most_visit; ?>"><?=$this->tab_most_visit; ?></a>
</div>
<? if($this->current_user && $this->current_user->id > 0) { ?>
  <div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
    <a href="<?=$request->createUrl('Bookmarks','BookmarksList'); ?>" title="<?=$this->tab_my_list_name; ?>"><?=$this->tab_my_list_name; ?></a>
  </div>
<? } ?>
<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
  <a href="<?=$this->createUrl('Bookmarks', 'BookmarksList'); ?>" title="<?=$this->tab_add_bookmark; ?>"><?=$this->tab_add_bookmark; ?></a>
</div>
<div class="tab-page tab-page-selected">
<!-- Вопросы пользователей -->

<table  width="100%" height="100%" cellpadding="0">
 <tr>
  <td class="next24u_left">
   <!-- панель слева -->
   <?php include($this -> _include('category_panel.tpl.php')); ?>
   <?php include($this -> _include('control_panel.tpl.php')); ?>
   <!-- /панель слева -->
  </td>
  <td class="next24u_right">
  <?php //include($this -> _include('tag_list.tpl.php')); ?>
   <div class="block_ee1">
    <div class="block_ee2">
     <div class="block_ee3">
      <div class="block_ee4">
       <div style="margin: 0px -10px;">
        <table class="questions">
         <tr>
          <td style="width: 100%; text-align: left;"><b>Закладка</b></td>
          <td><b>Автор</b></td>
          <td><b>Категория</b></td>
          <td><b>Комментариев</b></td>
          <td><b>Просмотров</b></td>
          <td><b>Дата создания</b></td>
         </tr>
         <? foreach($this->bookmarks_list as $key => $item) { ?>
         <?   ($key%2==0) ? $v_id = "cmod_tab2" : $v_id = "cmod_tab1"; ?>
         <tr id="<?=$v_id; ?>">
          <td style="text-align: left; white-space: normal;">
           <img src="<?=$this->image_url; ?>d_ld_ico2.png" id="ico2" />
             <a href="<?=$item['url'];?>" title="<?=$item['title'];?>"><?=$item['description_cut'];?></a>
               <!-- $this- >createUrl('Bookmarks', 'BookmarksView', array($item['id'])) -->
               <!-- $item['description'] -->
          </td>
          <td style="text-align: center;"><a href="<?=UserController::getProfileUrl($item['login']);?>"><?=$item['login']; ?></a></td><!-- TODO: User profile -->
          <td style="text-align: center" width="70"><?=$item['bookmark_category']; ?></td>
          <td style="text-align: center;"><?=$item['count_comments']; ?></td>
          <td style="text-align: center;"><?=number_format($item['views'], 0, '',' '); ?></td>
          <td><?=date_format(new DateTime($item['creation_date']),'d.m.y H:i'); ?></td>
         </tr>
         <? } ?>
        </table>
       </div>
   <!-- листинг -->

    <?=$this->bookmarks_list_pager; ?>
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