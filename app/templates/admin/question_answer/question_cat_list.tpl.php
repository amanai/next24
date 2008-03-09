<?php include($this -> _include('../header.tpl.php')); ?>
 	    <div style="float: left;"><h3>Категории</h3></div><!-- TODO: descript -->
 	    <div class="list">
				<div class="options">
					<div class="button bnormal" style="float: left;"><a href="<?=$this->createUrl('AdminQuestionAnswer','ManagedCat')?>">Добавить</a></div>
				</div>
				<table class="list_table">
					<tr class="head">
						<td class="first" rowspan="100">&nbsp;</td>
						<td>
							№
						</td>
						<td>
							Название
						</td>
						<td>
							Позиция
						</td>
						<td>
							Действия
						</td>
					</tr>
					<?php $num = 1;
					?>
					<?for ($i=0;count($this->cat_list)>$i;$i++) :?>
					<tr>
						<td>
							<?=$num?>
						</td>
						<td>
							<?=$this->cat_list[$i]['name']?>
						</td>
						<td>
							<a href="<?=$this->createUrl('AdminQuestionAnswer','MoveCat',array($this->cat_list[$i]['id'],$this->cat_list[$i-1]['id']))?>">[Up]</a> 
							<a href="<?=$this->createUrl('AdminQuestionAnswer','MoveCat',array($this->cat_list[$i]['id'],$this->cat_list[$i+1]['id']))?>">[Down]</a>
						</td>
						<td>
							<div class="button bsmall" style="float: left;"><a href="<?=$this->createUrl('AdminQuestionAnswer','ManagedCat',array($this->cat_list[$i]['id']))?>"><img src="<?=$this -> image_url?>icons/small_edit.gif" alt="Правка"/></a></div>
							<div class="button bsmall" style="float: left;"><a href="<?=$this->createUrl('AdminQuestionAnswer','DeleteCat',array($this->cat_list[$i]['id']))?>"><img src="<?=$this -> image_url?>icons/small_del.gif" alt="Удалить"/></a></div>
						</td>
					</tr>
					<?php $num++ ?>
					<?endfor;?>
				</table>
			</div>
<?php include($this -> _include('../footer.tpl.php')); ?>