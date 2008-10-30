<?php

?>


<ul class="checkbox_tree">
    <?php 
    $aLeafs = $this->getAllLeafs($this->news_list);
    $this->BuildTree($aLeafs, $this->news_list, 0); echo $this->_htmlTree; 
    ?>
</ul>