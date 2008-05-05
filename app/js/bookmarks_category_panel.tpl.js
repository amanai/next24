/*
  doLevelMainClick(p_obj) - обрабатывает нажатие на иконку Категории
  для раскрытия/закрытия списка подкатегорий в модуле Закладки
  unit: \app\templates\site\Bookmarks\control_panel.tpl.php 
*/

function doLevelMainClick(p_obj) {
  var v_url_img_icon_plus  = "/app/images/icons/plus.gif";
  var v_url_img_icon_minus = "/app/images/icons/minus.gif";
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
