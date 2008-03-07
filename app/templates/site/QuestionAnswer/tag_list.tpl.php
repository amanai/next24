<?php if (count ($this->question_tag_list) > 0) { ?>
<div class="block_ee1">
							<div class="block_ee2">
								<div class="block_ee3">
									<div class="block_ee4">
										<div style="margin: 0px -10px;">
							<?php 
								arsort($this->question_tag_list);
								$this->question_tag_list=array_slice($this->question_tag_list,0,40);
								asort($this->question_tag_list);
								$i = 1; $dif = count ($this->question_tag_list);
								foreach ( $this->question_tag_list as $cont => $tag) {
									$prc = ceil(($i * 100) / $dif);
									$size = ceil($prc/2) + 100;
									$tags_set[$tag['name']] = '<a style="font-size: '.$size.'%" href="tag_id:'.$tag['id'].'">'.$tag['name'].'</a>';
									$i++;
								}
								ksort($tags_set);							
							?>
							&nbsp;&nbsp;<?=implode(', ', $tags_set)?>
						</div>
						</div></div></div></div>
<?php } ?>