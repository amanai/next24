<!-- TEMPLATE: Строка тегов = всех интересов пользователей -->
<?php if (count ($this->interests_list) > 0) { ?>
<div class="block_ee1">
	<div class="block_ee2">
		<div class="block_ee3">
			<div class="block_ee4">
				<div style="margin: 0px 0px;">
						<?php 
              $v_request = Project::getRequest();
              $v_id_interest = $v_request->getKeyByNumber(0);
              $v_n_page      = $v_request->getKeyByNumber(1);
              $v_count_tag_max = 1;
              foreach ($this->interests_list as $key => $value) {
                if ($value['count'] > $v_count_tag_max) $v_count_tag_max = $value['count'];
              }
              foreach ($this->interests_list as $key => $value) { 
                $v_URL  = $this->createUrl('SearchUser', $this->action, array($value['id']));
                if ($v_count_tag_max > 1) {
                  $v_size = 100 + ceil(75*($value['count']-1)/$v_count_tag_max);
                } else {
                  $v_size = 100;
                }
                
                if ($v_id_interest == $value['id']) {
                  // -- Выбранный тег
                  $tags_set[] = '<b style="color: gray; font-size: '.$v_size.'%">'.$value['name'].'</b>';
                  $v_name_tag_selected = $value['name'];
                } else {
                  $tags_set[] = '<a style="font-size: '.$v_size.'%" href="'.$v_URL.'" title="'.$value['count'].' раз(а)">'.$value['name'].'</a>';
                }
              }
              print implode(', ', $tags_set);
						?>
					</div>  
        </div>
      </div>
    </div>
  </div>
            <? if ($v_name_tag_selected != null) { ?>
            <div class="block_ee1">
              <div class="block_ee2">
                <div class="block_ee3">
                  <div class="block_ee4">
                    <div style="margin: 0px 0px;">
                        Пользователи, разделяющие интерес «<?=$v_name_tag_selected;?>»
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <? } ?>
<?php } ?>