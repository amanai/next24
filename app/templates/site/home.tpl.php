<?php include($this -> _include('header.tpl.php')); ?>

<div id="tabs">
	<div id="top_tabs">
    <?php
    $tabs_map = $this->tabs_map;
    echo $this->getTabsNames($tabs_map, $this->user_id);
    ?>
    </div>
	
    <?php
    if ($this->user_id){ // Менеджер вкладок
    ?>
    	<div id="add" class="add"><a onclick="ShowTabManager('add'); return false;" href="#"><img height="20" width="66" src="<?php echo $this->image_url; ?>add_tab.gif"/></a></div>
    
        <div id="tab_manager" style="visibility: visible; display: none; top: 216px; left: 527px;">
        	<b>Менеджер вкладок</b><br/><br/>
        	<div id="AddTabsInputs">
        	<?php
            echo $this->getAddTabsInputs($tabs_map);
            ?>
            </div>
        	<br/>
        	<center><input type="submit" value="Сохранить" onclick="ManagerSaveTabs(); return false;" name="save"/>  <input type="submit" value="Закрыть" onclick="HideTabManager(); return false;" name="close"/></center>
        </div>
    <?php
    }
    ?>
	
    <div id="page_tabs">					
	<?php
    echo $this->getTabsPages($tabs_map);
    ?>
    </div>
    						

</div>

<script type="text/javascript">
	CloseAllTabs(1);
	
	<?php if ($this->user_id){ ?>
	$(document).ready(function(){
        $("#top_tabs").sortable({
            axis: 'x',
            placeholder: 'tab tab_space',
        	stop: function(ev, ui) {
        	   //$("#top_tabs").find(".tab").prepend('<img src="<?php echo $this->image_url; ?>aload.gif" width="16" height="16" align="top" style="margin-right: 4px;" border="0">'); 
        	   SortTabs();
        	}
        });  
        
    });
    <?php } ?>
    
</script>

<?php include($this -> _include('footer.tpl.php')); ?>