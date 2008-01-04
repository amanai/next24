<input type="hidden" name="<?php echo $field['name']; ?>" value='n'>
<input id="<?php echo $field['name']; ?>_ckeckbox" type="checkbox" name="<?php echo $field['name']; ?>" <?php if ($this->form['data'][$field['name']] == 'y'): ?> checked <?php endif; ?> value="y">
<?php if (!empty($field['desc'])): ?>
<label for="<?php echo $field['name']; ?>_ckeckbox">
<?php echo $field['desc']; ?>
</label>
<?php endif; ?>
