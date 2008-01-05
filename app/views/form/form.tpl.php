<?php if (isset($this->form['title']) && !empty($this->form['title'])): ?>
	<h2><?php echo $this->form['title']; ?></h2>
<?php endif; ?>
<?php if ($this->form['error']): ?>
	<div style="color: red; align: center;"><b>Ошибка!</b></div>
<?php endif; ?>
<form action="<?php echo $this->form['action']; ?>" method="<?php echo $this->form['method']; ?>" <?php if ($this->form['enctype'] != ''): ?> enctype="$this->form['enctype']" <?php endif; ?>>
<table>
	<?php foreach ((array)$this->form['fields'] as $field): ?>
	<tr>
		<td>
			<?php echo $field['title']; ?>
			<?php if ($field['required']): ?>
				<font color="red">*</font>
			<?php endif; ?>
		</td>
			<td>
				<?php if (array_key_exists($field['name'], $this->form['error'])): ?>
					<span><?php echo $this->form['error'][$field['name']]; ?></span><br>
				<?php endif; ?>
				<?php include($field['type']); ?><?php if(isset($field['beforeText'])) {echo $field['afterText'];} ?>
			</td>
	</tr>
	<?php endforeach; ?>
	<?php foreach ((array)$this->form['hidden'] as $key=>$value): ?>
	<input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
	<?php endforeach; ?>
	<tr>
		<td align="center" colspan="2">
			<input type="submit" name="submit" value="<?php echo $this->form['SubmitText']; ?>">&nbsp;&nbsp;
			<input type="button" name="cancel" value="<?php echo $this->form['CancelText']; ?>" onClick="javascript:document.location='<?php echo $this->form['CancelUrl']; ?>'">
		</td>
	</tr>
</table>
</form>
</div>
