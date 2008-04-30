<div class="block_ee1">
	<div class="block_ee2">
		<div class="block_ee3">
			<div class="block_ee4">
				<div class="block_title"><h2>Категории</h2></div>
<?PHP if (is_array($this->bookmarks_catalog_list)) {
	  foreach($this->bookmarks_catalog_list as $key => $item){ ?>
		<p style="padding-left:<?PHP echo $item['level_item']*20;?>px;">
  <?PHP if ($item['level_item']==0) print '[-]';?>
			<a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksList', array($item['id']));?>"><? echo $item['name']; ?></a>
		</p>
	<?php } ?>
<?php } ?>
			</div>
		</div>
	</div>
</div>
