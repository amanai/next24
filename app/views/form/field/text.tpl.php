<?php if(isset($field['beforeText'])) {echo $field['beforeText'];} ?><input type="text" name="<?php echo $field['name']; ?>" value="<?php echo $this->form['data'][$field['name']]; ?>" <?php if (isset($field['size'])): ?> size="<?php echo $field['size']; ?>" <?php endif; ?>>
<?php if (!empty($field['desc'])): ?>
<?php echo $field['desc']; ?>
<?php endif; ?>
