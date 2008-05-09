<!-- TEMPLATE: Панель "Категории" - содержит дерево-каталог категорий закладок -->
<div class="block_ee1">
 <div class="block_ee2">
  <div class="block_ee3">
   <div class="block_ee4">
    <div class="block_title"><h2>Категории</h2></div>
<? if (is_array($this->bookmarks_catalog_list)) { $v_count = 0; ?>
   <? foreach($this->bookmarks_catalog_list as $key => $item){ ?>
    <!-- для всех дочерних Категорий организуем контейнер-скрыватель-раскрыватель -->
    <!-- Его состояние обрабатывается JavaScript function //align="absmiddle" -->
    <? if ($item['level_item']==0) { ?>
      <? if ($v_count != 0) { ?></span><? } ?>
        <? $v_count++; ?>
     <p style="font-weight: bolder; line-height: 14px; cursor: pointer;" id="id_<?=$item['id']?>" onclick="doLevelMainClick(this.id)">
       <input type="image" tag="+" id="inp_id_<?=$item['id']?>" src="<?=$this -> image_url."icons/plus.gif"; ?>" title="Открыть/закрыть категорию" style="vertical-align: middle; border: 0; cursor: pointer;" />
       <?=$item['name']?>
     </p>
     <span style="display: none;" id="span_show_id_<?=$item['id']?>">
    <? } else { ?>
     <p style="padding-left: 14px; line-height: 14px;">
       <b>» </b> 
       <? if ($this->bookmarks_catalog_selectedID == $item['id']) { ?>
         <?=$item['name']?>
       <? } else { ?>  
         <a href="<?=$this->createUrl('Bookmarks', $this->action, array($item['id']))?>"><?=$item['name']?></a>
       <? } ?>
     </p>
    <? } ?>
 <? } ?>
   </span>
<? } ?>

<? if (count($this->category_row) > 0) { ?>
<script language="JavaScript" type="text/javascript">
  doLevelMainClick('id_'+<?=$this->category_row[0]['parent_id'];?>);
</script>
<? } ?>

   </div>
  </div>
 </div>
</div>
