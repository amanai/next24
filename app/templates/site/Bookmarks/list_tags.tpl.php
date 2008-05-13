<!-- TEMPLATE: Строка тегов, соответствующих выбранной категории -->
<?php if (count ($this->bookmarks_tags_list) > 0) { ?>
<div class="block_ee1">
	<div class="block_ee2">
		<div class="block_ee3">
			<div class="block_ee4">
				<div style="margin: 0px 0px;">
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
                }
                if ($value['tag_name'] != $this->tag_name_selected) {
                  $tags_set[] = '<a style="font-size: '.$v_size.'%" href="'.$v_URL.'" title="'.$value['count_tag'].' раз">'.$value['tag_name'].'</a>';
                } else {
                  $tags_set[] = '<b style="font-size: '.$v_size.'%">'.$value['tag_name'].'</b>';
                }
              }
              print implode(', ', $tags_set);
						?>
					</div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>