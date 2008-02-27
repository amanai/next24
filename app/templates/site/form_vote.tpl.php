<form action="<?php echo $this -> rate_url;?>" method="post">
<input type="hidden" name="id" value="<?php echo $this->element_id;?>" />
<table>
<tr align="center">
<td>0</td>
<td>1</td>
<td>2</td>
<td>3</td>
<td>4</td>
<td>5</td>
<td>6</td>
<td>7</td>
<td>8</td>
<td>9</td>
<td>10</td>
</tr>
<tr align="center">
<td><input type="radio" name="rate_value" value="0" /></td>
<td><input type="radio" name="rate_value" value="1" /></td>
<td><input type="radio" name="rate_value" value="2" /></td>
<td><input type="radio" name="rate_value" value="3" /></td>
<td><input type="radio" name="rate_value" value="4" /></td>
<td><input type="radio" name="rate_value" value="5" checked="checked" /></td>
<td><input type="radio" name="rate_value" value="6" /></td>
<td><input type="radio" name="rate_value" value="7" /></td>
<td><input type="radio" name="rate_value" value="8" /></td>
<td><input type="radio" name="rate_value" value="9" /></td>
<td><input type="radio" name="rate_value" value="10" /></td>
</tr>
<tr>
<td colspan="11" align="center">
<input type="submit" value="Оценить фото" />
</td>
</tr>
</table>
</form>