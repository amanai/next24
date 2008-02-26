<form action="<?php echo $this -> add_comment_url;?>" method="post">
		<input type="hidden" name="id" value="<?php echo $this->add_comment_id;?>" />
	    <input type="hidden" name="element_id" value="<?php echo $this->add_comment_element_id;?>" />
		<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
			<table width="100%">
			<tr>
				<td><h2>Оставить комментарий</h2></td>
			</tr>
	
			<tr>
				<td><textarea name="comment" style="width: 100%; height: 100px;"></textarea></td>
			</tr>
			<tr>
				<td align="right" style="padding-right: 5px;"><input type="submit" name="Submit" value="Комментировать"></td>
			</tr>
			</table>
		</div></div></div></div>
		</form>
	</td>
</tr>
</table>