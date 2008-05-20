<!-- TEMPLATE: Форма редактирования категории закладки -->
<form action="<?php echo $this->createUrl('Bookmarks', 'BookmarksCategorySave');?>" method="post">
	<h1>Добавление категории</h1>
	<br />
	<table>
  <tr>
    <td valign="top" width="140">Родительская категория: </td>
    <td>   
      <select style="width: 300px;" name="sel_parent_category">
        <option value="0">---</option>
        <?php foreach ($this->bookmarks_category_list as $key=>$item){?>
          <? if ($item['level_item'] == 0) {?>
          <option value="<?=$item['id']; ?>"><?=$item['name']; ?></option>
          <? } ?>
        <?php } ?>
      </select><br />
    </td>
  </tr>
	<tr>
		<td width="100" valign="top">Название: </td>

		<td>
			<input type="text" name="inp_categiry_name" style="width: 300px;" value="<?=$this -> category_name; ?>"><br />
			<span id="micro2">Название категории.</span>
		</td>
	</tr>
	
	<tr>
		<td colspan="2" align="right"><input type="submit" value="Сохранить" /></td>
	</tr>
	</table>
</form>
