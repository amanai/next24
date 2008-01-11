<?php if ($this->form['data'][$field['name']]): ?>
<img src="<?php echo BASE_URL ?>/image/<?php echo $this->form['data'][$field['name']]; ?>" alt="<?php echo $field['title']; ?>" <?php if ($field['image_width']): ?> width="<?php echo $field['image_width']; ?>" <?php endif; ?>/>
<br>
<?php endif; ?>
<input type="file" name="<?php echo $field['name']; ?>" <?php if (!empty($field['OnClick'])): ?> OnClick = "<?php echo $field['OnClick']; ?>"<?php endif; ?> <?php if (!empty($field['OnChange'])): ?> OnChange = "<?php echo $field['OnChange']; ?>"<?php endif; ?>>
<?php if (!empty($field['desc'])): ?>
<?php echo $field['desc']; ?>
<?php endif; ?>
