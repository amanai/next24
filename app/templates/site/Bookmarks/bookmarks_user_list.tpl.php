<!-- TEMPLATE: "Мои закладки" - закладки пользователя -->
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
  <?php if ((count($this->category_row) > 0) or ($this->show_imported_bookmarks == true)) { ?>
  <div class="block_ee1">
    <div class="block_ee2">
      <div class="block_ee3">
        <div class="block_ee4">
          <div style="margin: 0px 10px;">
          <b>Закладки категории:</b> &nbsp;<?=$this->category_row[0]['name']; ?>
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
  <!-- строка тегов -->
<?php include($this -> _include('list_tags.tpl.php')); ?>
  <!-- /строка тегов -->
   <div class="block_ee1">
    <div class="block_ee2">
     <div class="block_ee3">
      <div class="block_ee4">
       <div style="margin: 0px -10px;">
        <table class="questions">
         <tr>
          <td style="width: 100%; text-align: left;"><b>Закладка</b></td>
          <td><b>Автор</b></td>
          <!--<td><b>Категория</b></td>-->
          <td><b>Комментариев</b></td>
          <td><b>Просмотров</b></td>
          <td><b>Дата создания</b></td>
          <td><b>Действие</b></td>
         </tr>
         <? foreach($this->bookmarks_list as $key => $item) { ?>
         <?   ($key%2==0) ? $v_id = "cmod_tab2" : $v_id = "cmod_tab1"; ?>
         <tr id="<?=$v_id; ?>">
          <td style="text-align: left; white-space: normal;">
           <img src="<?=$this->image_url; ?>d_ld_ico2.png" id="ico2" />
             <a href="<?=$this->createUrl('Bookmarks', 'BookmarksView', array($item['id']))?>" title="<?=$item['title'].' ('.$item['url'].')';?>"><?=$item['title_cut'];?></a>
               <!-- $this- >createUrl('Bookmarks', 'BookmarksView', array($item['id'])) -->
               <!-- $item['description'] -->
          </td>
          <td style="text-align: center;"><a href="<?=$request->createUrl('Index','Index', null, $item['login']); ;?>"><?=$item['login']; ?></a></td><!-- TODO: User profile -->
          <!--<td style="text-align: center" width="70"><?=$item['bookmark_category']; ?></td>-->
          <td style="text-align: center;"><?=$item['count_comments']; ?></td>
          <td style="text-align: center;"><?=number_format($item['views'], 0, '',' '); ?></td>
          <td><?=date_format(new DateTime($item['creation_date']),'d.m.y H:i'); ?></td>
          <td>
            <?php if($item['user_id'] == Project::getUser()->getDbUser()->id) { ?>
              <a href=<?=$this->createUrl('Bookmarks','BookmarksDelete',array($item['id']))?>>[Удалить]</a> 
              <a href="<?=$this->createUrl('Bookmarks','BookmarksManage',array($item['id']))?>">[Редактировать]</a>
            <?php } ?>
          </td>
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