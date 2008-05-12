<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Форма просмотра закладки BookmarksViewAction -->

<script language="JavaScript" type="text/javascript" src="<?php echo $this -> js_url;?>tab.js"></script>

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
      <?=$this->tab_bookmarks_view?>
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
          <td style="width: 100%; text-align: left;"><b>Закладка</b></td>
          <td style="text-align: center;"><b>Ссылка</b></td>
          <td style="text-align: center;"><b>Категория</b></td>
          <td><b>Автор</b></td>
          <td><b>Просмотров</b></td>
          <td><b>Дата создания</b></td>
         </tr>
         <? if (count($this->bookmark_row > 0)) { ?>
         <tr id="cmod_tab2">
          <td style="text-align: left; white-space: normal;"><p><img src="<?=$this->image_url; ?>d_ld_ico2.png" id="ico2" /><?=$this->bookmark_row['title'];?></p></td>
          <td><a href="<?=$this->bookmark_row['url'];?>" title="<?=$this->bookmark_row['url'];?>" target="_blank"><?=$this->bookmark_row['url_cut'];?></a></td>
          <td style="text-align: center" width="70"><?=$this->bookmark_row['bookmark_category']; ?></td>
          <td style="text-align: center;"><a href="<?=$request->createUrl('Index','Index', null, $this->bookmark_row['login']); ;?>"><?=$this->bookmark_row['login']; ?></a></td>
          <td style="text-align: center;"><?=number_format($this->bookmark_row['views'], 0, '',' '); ?></td>
          <td><?=date_format(new DateTime($this->bookmark_row['creation_date']),'d.m.y H:i'); ?></td>
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