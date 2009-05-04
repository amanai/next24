<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="debate-page"> 
					<ul class="view-filter clearfix"> 
						<?php include($this -> _include('../tab_panel.tpl.php')); ?>
					</ul> 
					<!-- /view-filter --> 
					<div class="d-head"> 
						<input type="hidden" name="currEtap" id="currEtap" value="Results" />
						<input type="hidden" name="refreshNow" id="refreshNow" value="0" />	
					</div> 
					<!-- /d-head --> 
					<div class="d-wrap clearfix"> 
						<div class="d-content">
						<table class="stat-table">
							<thead>
								<tr>
									<th>Время начала</th>
									<th>Тема</th>
									<th>1-й участник<br/>[помощники]</th>
									<th>Количество голосов</th>
									<th>2-й участник<br/>[помощники]</th>
									<th>Количество голосов</th>
								</tr>
							</thead>
							<tbody>
			<?php 
			$userModel = new UserModel(); $i=1;
			foreach ($this->aDebateHistory as $debateHistory){
	    		if ($i/2 == 1){$tr_id = ""; $i=1;} else {$tr_id = "cmod_tab2"; $i++;}
	    		$user1 = $userModel->getUserById($debateHistory['user_id_1']);
	   		 	$user2 = $userModel->getUserById($debateHistory['user_id_2']);
	    		$helper1_1 = $userModel->getUserById($debateHistory['helper_id_1_1']);
	    		$helper1_2 = $userModel->getUserById($debateHistory['helper_id_1_2']);
	    		$helper2_1 = $userModel->getUserById($debateHistory['helper_id_2_1']);
	    		$helper2_2 = $userModel->getUserById($debateHistory['helper_id_2_2']);
	    		echo '
	    		<tr id="'.$tr_id.'">
	       			<td>'.$debateHistory['start_time'].'</td>
	       			<td>'.$debateHistory['theme'].'</td>
	       			<td>
	           			<a href="'.$this->createUrl('User', 'Profile', null, $user1['login']).'">'.$user1['login'].'</a><br/>[';
	         			if ($helper1_1){
	           				echo '<a href="'.$this->createUrl('User', 'Profile', null, $helper1_1['login']).'">'.$helper1_1['login'].'</a>';
	         			}
	         			if ($helper1_1 && $helper1_2){
	           				echo '; ';  
	         			}
	         			if ($helper1_2){
	           				echo '<a href="'.$this->createUrl('User', 'Profile', null, $helper1_2['login']).'">'.$helper1_2['login'].'</a>';
	         			}
	         			if (!$helper1_1 && !$helper1_2){
	           				echo 'без помощников';  
	         			}
	    		echo ']
	       			</td>
	       			<td style="text-align:center;vertical-align:middle;">'.$debateHistory['user1_vote'].'</td>
	       			<td>
	           			<a href="'.$this->createUrl('User', 'Profile', null, $user2['login']).'">'.$user2['login'].'</a><br/>[';
	         			if ($helper2_1){
	           				echo '<a href="'.$this->createUrl('User', 'Profile', null, $helper2_1['login']).'">'.$helper2_1['login'].'</a>';
	         			}
	         			if ($helper2_1 && $helper2_2){
	           				echo '; ';  
	         			}
	         			if ($helper2_2){
	           				echo '<a href="'.$this->createUrl('User', 'Profile', null, $helper2_2['login']).'">'.$helper2_2['login'].'</a>';
	         			}
	         			if (!$helper2_1 && !$helper2_2){
	          				echo 'без помощников';  
	         			}
	    		echo ']
	       			</td>
	       			<td style="text-align:center;vertical-align:middle;">'.$debateHistory['user2_vote'].'</td>
	    		</tr>';
			} ?>								
							</tbody>
						</table>
						<ul class="short-pages-list">
							<?php echo $this->debate_pager;  ?>
						</ul>							
					</div></div> 
					<!-- /end-view --> 
				</div> 
				<!-- /debate-page --> 
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>