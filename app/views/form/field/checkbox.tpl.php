<input type="hidden" name="<?php echo $field['name']; ?>" value='n'>
<input id="<?php echo $field['name']; ?>_ckeckbox" type="checkbox" name="<?php echo $field['name']; ?>" <?php if ($this->form['data'][$field['name']] == 'y'): ?> checked <?php endif; ?> value="y" <?php if (!empty($field['OnClick'])): ?> OnClick = "<?php echo $field['OnClick']; ?>"<?php endif; ?> <?php if (!empty($field['OnChange'])): ?> OnChange = "<?php echo $field['OnChange']; ?>"<?php endif; ?>>
<?php if (!empty($field['desc'])): ?>
<label for="<?php echo $field['name']; ?>_ckeckbox">
<?php echo $field['desc']; ?>
</label>
<?php endif; ?>
