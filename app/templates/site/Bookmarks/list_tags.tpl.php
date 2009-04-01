<!-- TEMPLATE: Строка тегов, соответствующих выбранной категории -->
<?php if (count ($this->bookmarks_tags_list) > 0) { ?>
<div class="tag-list">
	<i class="icon tags-list-icon"></i>
		<ul>		
						<?php 
              $v_request = Project::getRequest();
              $v_categoryID = $v_request->getKeyByNumber(0);
              $v_n_page     = $v_request->getKeyByNumber(1);
              $v_count_tag_max = 1;
              foreach ($this->bookmarks_tags_list as $key => $value) {
                if ($value['count_tag'] > $v_count_tag_max) $v_count_tag_max = $value['count_tag'];
              }
              foreach ($this->bookmarks_tags_list as $key => $value) { 
                $v_URL  = $this->createUrl('Bookmarks', $this->action, array($v_categoryID, $value['id'], '0'));
                if ($v_count_tag_max > 1) {
                  $v_size = 100 + ceil(75*($value['count_tag']-1)/$v_count_tag_max);
                } else {
                  $v_size = 100;
                  //style="font-size: '.$v_size.'%"
                }
                if ($value['tag_name'] != $this->tag_name_selected) {
                  $tags_set[] = '<li><a rel="tag" href="'.$v_URL.'" title="'.$value['count_tag'].' раз(а)">'.$value['tag_name'].'</a></li>';
                } else {
                  $tags_set[] = '<li><b>'.$value['tag_name'].'</b></li>';
                }
              }
              print implode(', ', $tags_set);
						?>
	</ul>
</div>
<!-- /tag-list -->						
<?php } ?>