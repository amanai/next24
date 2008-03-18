<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
		<!-- Подписка::список -->
		<table width="100%" height="100%" cellpadding="0">
		<tr>
			<td class="next24u_right">
				<!-- Список подписок -->
				<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					<div>
						<?php if ($this -> only_subscribed === true) { echo '<span style="background-color:#ffff00;">отобразить только подписанные</span>'; } else { ?><a href="<?php echo $this -> only_subscribed_link; ?>">отобразить только подписанные</a><?php } ?> | 
						<?php if ($this -> all_tree === true) { echo '<span style="background-color:#ffff00;">отобразить все</span>'; } else { ?><a href="<?php echo $this -> all_link; ?>">отобразить все</a><?php } ?>
					</div>
					<?php include($this -> _include('blog_tree.tpl.php')); ?>
						
				</div></div></div></div>
				
				<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					sadfdsfsdfsdfsd


				</div></div></div></div>
				


				<!-- /Список подписок -->
							
			</td>
		</tr>
		</table>
		<!-- /Подписка::список -->
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>