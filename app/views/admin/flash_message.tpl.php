<div>Flash messages:Msg icon</div>
<? if (is_array($this -> messages)){
	foreach($this -> messages as $message) { ?>
		<div><? echo $message;?></div>
	<?php } 
}?>