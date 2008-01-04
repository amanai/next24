<textarea name="<?php echo $field['name']; ?>" cols="<?php if (isset($field['cols'])): echo $field['cols']; else: echo '50'; endif; ?>" rows="<?php if (isset($field['rows'])): echo $field['rows']; else: echo '10'; endif; ?>">
<?php echo $this->form['data'][$field['name']]; ?>
</textarea>
