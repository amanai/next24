<?php if (count ($this->question_tag_list) > 0) { ?>
<div class="tag-list">
	<i class="icon tags-list-icon"></i>
	<ul>	
	<?php 
		arsort($this->question_tag_list);
		$this->question_tag_list=array_slice($this->question_tag_list,0,40);
		asort($this->question_tag_list);
		$dif = count ($this->question_tag_list);
		foreach ( $this->question_tag_list as $key => $tag) {
			$prc = ceil(($tag['count'] * 100) / $dif);
			$size = $prc + 100;
			$tags_set[$tag['name']] = '<li><a rel="tag" href="'.$tag['id'].'">'.$tag['name'].'</a></li>';
		}
		ksort($tags_set);							
	?>
	&nbsp;&nbsp;<?=implode(', ', $tags_set)?>
	</ul>
</div>						
<?php } ?>