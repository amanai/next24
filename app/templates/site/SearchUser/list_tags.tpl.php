<!-- TEMPLATE: Строка тегов = всех интересов пользователей -->
<?php if (count ($this->interests_list) > 0) { ?>
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
/*                if ($v_count_tag_max > 1) {
                  $v_size = 100 + ceil(75*($value['count']-1)/$v_count_tag_max);
                } else {
                  $v_size = 100;
                }	*/
                if ($v_id_interest == $value['id']) {
                  // -- Выбранный тег
                  $tags_set[] = '<li><b class="w'.rand(1,5).'">'.$value['name'].'</b></li>';
                  $v_name_tag_selected = $value['name'];
                } else {
                  $tags_set[] = '<li><a class="w'.rand(1,5).'" rel="tag" href="'.$v_URL.'" title="'.$value['count'].' раз(а)">'.$value['name'].'</a></li>';
                }
              }
              echo '<ul class="tag-cloud">';
              	print implode(', ', $tags_set);
              echo '</ul>';	
						?>
            <? if ($v_name_tag_selected != null) { ?>
                        <span class="new-link" style="font-size: 110%; color: ">Пользователи, разделяющие интерес</span> <strong>«<?=$v_name_tag_selected;?>»</strong>
            <? } ?>
<?php } ?>