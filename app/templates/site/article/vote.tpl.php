<div style="width: 170px; display: table;">
	<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
		<div class="block_title"><h2>Проголосовать</h2></div>

	<form action="<?=$this->createUrl('Article', 'Vote', array($this->article['id']))?>">
		<table width="100%" cellpadding="2">
		<tr>
			<td width="100">Оценка</td>
			<td><select name="vote"><?for ($i = 1;$i <= 100; $i++):?><option value="<?=$i?>"><?=$i?></option><?endfor;?></select></td>
		</tr>
		<tr>
			<td colspan="2" align="right" style="padding-right: 6px;"><input type="submit" value="Отправить"></td>
		</tr>
		</table>
	</form>


	</div></div></div></div>
</div>
