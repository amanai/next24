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
              foreach ($this->bookmarks_tags_list as $key => $value) { 
                $v_URL  = $this->createUrl('Bookmarks', $this->action, array($v_categoryID, '0', $value['id']));
                $tags_set[] = '<a href="'.$v_URL.'">'.$value['tag_name'].'</a>';
              }
              print implode(', ', $tags_set);
						?>
					</div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>