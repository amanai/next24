/*
  doLevelMainClick(p_obj) - обрабатывает нажатие на иконку Категории
  для раскрытия/закрытия списка подкатегорий в модуле Закладки
  unit: \app\templates\site\Bookmarks\control_panel.tpl.php 
*/

function doLevelMainClick(p_id) {
  var v_url_img_icon_plus  = "/app/images/icons/plus.gif";
  var v_url_img_icon_minus = "/app/images/icons/minus.gif";
  var v_obj_inp = document.getElementById('inp_'+p_id);
  var v_str = v_obj_inp.getAttribute("tag");
  if (v_str == '+') {
    //p_obj.childNodes[0].nodeValue =  '[-] ';
    //document.getElementById('span_show_'+v_id).className = 'span_show';
    document.getElementById('span_show_'+p_id).style.display = 'block';
    v_obj_inp.setAttribute("tag", "-");
    v_obj_inp.setAttribute("src", v_url_img_icon_minus);
  } else {
    document.getElementById('span_show_'+p_id).style.display = 'none';
    v_obj_inp.setAttribute("tag", "+");
    v_obj_inp.setAttribute("src", v_url_img_icon_plus);
  }
  v_obj_inp.blur();
}
