<?php
print_r($this->_js_files);
?>
<script type="text/javascript">

$(document).ready(function(){  
    alert(123);
    $(".minus").click(function(){
        alert(123);
    });
    
    $(".test").click(function(){
        alert(456);
    });
});

</script>
<p class="test">sdfsdfsdfs</p>
<ul class="checkbox_tree">
    <?php $this->BuildTree($this->news_list,0); echo $this->_htmlTree; ?>
</ul>