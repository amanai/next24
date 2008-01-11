<?php echo $field['beforeText']; ?><input type="password" name="<?php echo $field['name']; ?>" value="" <?php if (!empty($field['OnClick'])): ?> OnClick = "<?php echo $field['OnClick']; ?>"<?php endif; ?> <?php if (!empty($field['OnChange'])): ?> OnChange = "<?php echo $field['OnChange']; ?>"<?php endif; ?>>
<?php if (!empty($field['desc'])): ?>
<?php echo $field['desc']; ?>
<?php endif; ?>
