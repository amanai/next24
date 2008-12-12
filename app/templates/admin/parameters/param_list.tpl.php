<?php include($this -> _include('../header.tpl.php')); ?>
	<div class="list">
 	    <div style="float: left;"><h3><?php if($this -> controller_id>0){ echo $this -> controller_name;} else {echo 'Общие параметры системы';}?></h3><?php if (strlen($this -> controller_description)){echo " (".$this -> controller_description.")";}?></div>
 	
 	    <table class="list_table">
 	        <tr class="head">
 	            <td class="first" rowspan="100">&nbsp;</td>
 	            <td>
 	                N
	            </td>
 	            <td>
 	                Название
 	            </td>
 	            <td>
 	                Значение
 	            </td>
 	            <td>
 	                Тип
 	            </td>
 	            <td>
 	                Действие
 	            </td>
 	            <td class="last" rowspan="100">&nbsp;</td>
 	        </tr>
 	        <form action="<?php echo $this -> save_action;?>" method="post">
 	            <input type="hidden" name="id" value="<?php echo $this -> param_group_id; ?>"/>
 	            <input type="hidden" name="controller_id" value="<?php echo $this -> controller_id; ?>"/>
 	            <input type="hidden" name="param_group_id" value="<?php echo $this -> param_group_id; ?>"/>
 	            
 	            <?php foreach($this -> param_list as $item) { ?>
	                <input type="hidden" name="ids[<?php echo $item['id'];?>]" value="<?php echo $item['id']; ?>"/>
 	            <tr>
 	                <td>
 	                    <?php echo $item['number']; ?>
 	                </td>
 	                <td>
 	                    <input type="text" size="70" name="param_name[<?php echo $item['id'];?>]" value="<?php echo $item['name']; ?>"/>
 	                </td>
 	                <td>
 	                    <input type="text" size="5" name="param_value[<?php echo $item['id'];?>]" value="<?php echo $item['value']; ?>"/>
 	                </td>
 	                <td>
 	                    <select name="php_type[<?php echo $item['id'];?>]">
 	                        <?php foreach($this -> php_types as $key=>$value){ ?>
 	                            <option value="<?php echo $key;?>" <?php if ($key==$item['php_type']) echo 'selected'; ?>><?php echo $value;?></option>
 	                        <? } ?>
 	                    </select>
 	                </td>
 	                <td>
 	                	<?php if ($item['id'] > 0 ) { ?>
 	                    	<div class="button bsmall" style="float: left;"><a href="<?php echo $item['delete_link'];?>"><img src="<?php echo $this -> image_url;?>icons/small_del.gif" alt="Удалить"/></a></div>
 	                    <?php } ?>
 	                </td>
 	   
 	            </tr>
 	            <?php } ?>
 	            <tr>
 	                <td colspan="4" align="center"><input type="submit" value="Сохранить" /></td>
 	            </tr>
 	        <form>
 	    </table>
 	
	</div>
<?php include($this -> _include('../footer.tpl.php')); ?>