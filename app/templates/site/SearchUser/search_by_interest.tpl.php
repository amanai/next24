<?php include($this -> _include('../header.tpl.php')); ?>
<?php $request = Project::getRequest(); ?>
<!-- TEMPLATE: "Поиск по интересам" -->
<div class="friends-page">
	<ul class="view-filter clearfix">
		<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	</ul>	
	<?php include($this -> _include('list_tags.tpl.php')); ?>
	<table style="width: 100%; height: 100%; border-spacing: 0;">
 		<tr>
  			<td class="next24u_right">
  			<!-- Выдача результата поиска -->
				<?php include($this -> _include('list_users.tpl.php')); ?>
  			<!-- /Выдача результата поиска -->
  			<!-- Pager - страничная листалка -->  
    			<?=$this->search_user_list_pager; ?>
  			<!-- /Pager - страничная листалка -->  
  			</td>
 		</tr>
	</table>
</div>
<?php include($this -> _include('../footer.tpl.php')); ?>