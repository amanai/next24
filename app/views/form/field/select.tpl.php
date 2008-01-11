<select size="1" name="<?php echo $field['name']; ?>" <?php if (!empty($field['OnClick'])): ?> OnClick = "<?php echo $field['OnClick']; ?>"<?php endif; ?> <?php if (!empty($field['OnChange'])): ?> OnChange = "<?php echo $field['OnChange']; ?>"<?php endif; ?>>
	<?php foreach ($field['options'] as $option): ?>
	<option value="<?php echo $option['id']; ?>" <?php if ($this->form['data'][$field['name']] == $option['id']) echo 'selected'; ?>><?php echo $option['title']; ?></option>
	<?php endforeach; ?>
</select>
