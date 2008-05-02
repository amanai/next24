<div class="block_ee1">
 <div class="block_ee2">
  <div class="block_ee3">
   <div class="block_ee4">
    <div class="block_title"><h2>Категории</h2></div>
<? if (is_array($this->bookmarks_catalog_list)) { $v_count = 0; ?>
<?    foreach($this->bookmarks_catalog_list as $key => $item){  ?>
    <!-- для всех дочерних Категорий организуем контейнер-скрыватель-раскрыватель -->
    <!-- Его состояние обрабатывается JavaScript function //align="absmiddle" -->
<?     if ($item['level_item']==0) { ?>
<? 	     if ($v_count != 0) { ?></span><? } ?>
<?         $v_count++; ?>
     <p style="font-weight: bolder; line-height: 14px;">
       <input type="image" tag="+" src="<?=$this -> image_url."icons/plus.gif"; ?>" id="id_<?=$item['id']?>" onclick="doLevelMainClick(this)" title="Открыть/закрыть категорию" style="vertical-align: middle; border: 0; cursor: pointer;" />
       <a href="<?=$this->createUrl('Bookmarks', 'BookmarksList', array($item['id']))?>" style="text-decoration: none;"><?=$item['name']?></a>
     </p>
     <span style="display: none;" id="span_show_id_<?=$item['id']?>">
<?     } else { ?>
     <p style="padding-left: 14px; line-height: 14px;">
       <b>» </b> <a href="<?=$this->createUrl('Bookmarks', 'BookmarksList', array($item['id']))?>"><?=$item['name']?></a>
     </p>
<?     } ?>
<?  } ?>
   </span>
<? } ?>
   </div>
  </div>
 </div>
</div>
