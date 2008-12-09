<?php include($this -> _include('header.tpl.php')); ?>

<div id="tabs">
	<div id="top_tabs">
    <?php
    $tabs_map = $this->tabs_map;
    echo $this->getTabsNames($tabs_map);
    ?>
    </div>
	
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
	
    <div id="page_tabs">					
	<?php
    echo $this->getTabsPages($tabs_map);
    ?>
    </div>
    						

</div>

<script type="text/javascript">
	CloseAllTabs(1);
</script>

<?php include($this -> _include('footer.tpl.php')); ?>