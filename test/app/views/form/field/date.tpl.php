<?php if ($this->form['data'][$field['name']]): ?>
<?php list($day, $month, $year) = explode("/", $this->form['data'][$field['name']]); ?>
<?php endif; ?>
<select size="1" name="<?php echo $field['name']; ?>[day]">
	<?php for ($i = 1; $i < 32; $i++): ?>
		<option value="<?php echo $i; ?>" <?php if ($i == $day) echo 'selected'; ?>><?php echo $i; ?></option>
	<?php endfor; ?>
</select>
<select size="1" name="<?php echo $field['name']; ?>[month]">
	<?php for ($i = 1; $i < 13; $i++): ?>
		<option value="<?php echo $i; ?>" <?php if ($i == $month) echo 'selected'; ?>><?php echo $i; ?></option>
	<?php endfor; ?>
</select>
<select size="1" name="<?php echo $field['name']; ?>[year]">
	<?php for ($i = 2006; $i < 2036; $i++): ?>
		<option value="<?php echo $i; ?>" <?php if ($i == $year) echo 'selected'; ?>><?php echo $i; ?></option>
	<?php endfor; ?>
</select>
