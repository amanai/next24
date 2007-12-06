<html>
<body>
<div style='float:right;'>
	<form>
		node <input type=text name=id>
		<input type=submit name=mode value=move_up>
		<input type=submit name=mode value=move_down>
		<input type=submit name=mode value=delete>
	</form>
	<hr>
	<form>
		node <input type=text name=id>
		new parent_id <input type=text name=parent_id>
		<input type=hidden name=mode value=change_parent>
		<input type=submit value='Change Parent' >
	</form>
</div>

<? foreach ($_['tree'] as $n): ?>
	<?=str_repeat("&mdash;&nbsp;",  $n['level'] -1)?>
	<?=$n['name']?> (<?=$n['id']?>)<br>
<? endforeach;?>

</body>
</html>
