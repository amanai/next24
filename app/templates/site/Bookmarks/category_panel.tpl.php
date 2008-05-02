<style type="text/css">
p.level_0 {
  font-weight: bolder;
  line-height: 14px;
}
p.level_0 a {
  text-decoration: none;
}
p.level_1 {
  padding-left: 14px;
  line-height: 14px;
}
input.img_icon {
  vertical-align: middle;
  border: 0;
}

</style>
<?PHP
  $v_url_img_icon_plus  = $this -> image_url."icons/plus.gif";
  $v_url_img_icon_minus = $this -> image_url."icons/minus.gif";
?>
<script language="JavaScript" type="text/javascript">
var v_url_img_icon_plus  = '<?PHP print $v_url_img_icon_plus; ?>';
var v_url_img_icon_minus = '<?PHP print $v_url_img_icon_minus; ?>';
function doLevelMainClick(p_obj) {
  var v_str = p_obj.getAttribute("tag");
  var v_id  = p_obj.id;
  if (v_str == '+') {
    //p_obj.childNodes[0].nodeValue =  '[-] ';
    //document.getElementById('span_show_'+v_id).className = 'span_show';
    document.getElementById('span_show_'+v_id).style.display = 'block';
    p_obj.setAttribute("tag", "-");
    p_obj.setAttribute("src", v_url_img_icon_minus);
  } else {
    document.getElementById('span_show_'+v_id).style.display = 'none';
    p_obj.setAttribute("tag", "+");
    p_obj.setAttribute("src", v_url_img_icon_plus);
  }
  p_obj.blur();
}
</script>
<div class="block_ee1">
 <div class="block_ee2">
  <div class="block_ee3">
   <div class="block_ee4">
    <div class="block_title"><h2>Категории</h2></div>
<?PHP
  if (is_array($this->bookmarks_catalog_list)) {
    $v_count = 0;
    foreach($this->bookmarks_catalog_list as $key => $item){
    // для всех дочерних Категорий организуем контейнер-скрыватель-раскрыватель
    // Его состояние обрабатывается JavaScript function //align="absmiddle"
      if ($item['level_item']==0) {
        if ($v_count != 0) { ?></span><?PHP }?>
        <?PHP $v_count++; ?>
        <p class="level_0">
          <input type="image" class="img_icon" tag="+" src="<?=$v_url_img_icon_plus; ?>" id="id_<?=$item['id']?>" onclick="doLevelMainClick(this)" title="Открыть/закрыть категорию" />
          <a href="<?=$this->createUrl('Bookmarks', 'BookmarksList', array($item['id']))?>"><?=$item['name']?></a>
        </p>
   <span style="display: none;" id="span_show_id_<?=$item['id']?>">
    <?PHP } else { ?>
       <p class="level_1">
         <b>» </b> <a href="<?=$this->createUrl('Bookmarks', 'BookmarksList', array($item['id']))?>"><?=$item['name']?></a>
       </p>
     <?PHP
     }
   }
   ?>
   </span>
<?PHP
  }
?>
   </div>
  </div>
 </div>
</div>
