<? if (is_array($this -> messages)){
	echo '<div class="info" id="flash_message"><table><tr><td valign="middle">';
	if ($this->category == FM::ERROR) echo '<img src="'.$this -> image_url.'flash_messages/error.gif" align="left"/>';
	if ($this->category == FM::WARNING) echo '<img src="'.$this -> image_url.'flash_messages/warning.gif" align="left"/>';
	if ($this->category == FM::INFO) echo '<img src="'.$this -> image_url.'flash_messages/info.gif" align="left"/>';
	echo '</td><td'.(($this->category == FM::ERROR)?' class="red"':'').'><ul>';
	foreach($this -> messages as $message) { ?>
		<li><? echo $message;?></li>
	<?php } 
	echo '</ul></tr></table></div>';
}?>