			<!-- ������� ����, � ��������� (�������) -->
			<div class="tab-page" id="modules-cpanel">
				<script type="text/javascript">var tabPane1 = new WebFXTabPane( document.getElementById( "modules-cpanel" ), 1 )</script>

				<div class="tab-page">
					<h2 class="tab">����</h2>
					<!-- ������� -->
					<table width="100%" height="100%" cellpadding="0">
					<tr>
						<tr>
							<td class="next24_right">
								<table width="100%" height="100%" cellpadding="0">
									<tr>
										<td class="next24u_left">
										<!-- ����� ���� -->
											<div class="block_ee1"><div class="block_ee2">
												<div class="block_ee3">
													<div class="block_ee4">
														<div class="block_title"><h2><? echo $this->userData['blog_info']['title'];  ?></h2></div>
															<?php require('blog_left_tree.tpl.php'); ?>
														</div>
													</div>
												</div>
											</div>
											<?php require('blog_control_panel.tpl.php'); ?>
				
									<!-- /����� ���� -->
				
						
						</td>
						<td class="next24u_right">
							<!-- �������� ������ ������� -->
							<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
								<form action="<?php echo $this->router->createUrl('Blog', 'PostSave');?>" method="post">
									<input type="hidden" name="post_id" value="<?php echo (int)$this->userData['post_info']['id']; ?>"><br />
									<h1><?php if((int)$this->userData['post_info']['id'] === 0) echo '����� ����'; else echo '�������������� �����';?></h1>
									<br />
	
									<table>
									<tr>
										<td width="100" valign="top">��������</td>
	
										<td>
											<input type="text" name="post_name" style="width: 300px;" value="<?php echo $this->userData['post_info']['title']; ?>"><br />
											<span id="micro2">��� ������ �������� � �������������� ���� ������.</span>
										</td>
									</tr>
									<tr>
										<td width="100" valign="top">������</td>
										<td>
											<select style="width: 300px;" name="post_branch">
												<?php foreach($this->userData['branch_list'] as $key => $item){ ?>
														<option <?php if($this->userData['post_info']['ub_tree_id'] == $item['id']) echo 'selected'; ?> value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
												<?php } ?>
												
											</select><br />
											<span id="micro2">�������� � ������� �����.</span>
										</td>
	
									</tr>
									<tr>
										<td width="100" valign="top">����� ��������</td>
										<td>
											???
											<span id="micro2">�������� � ������� ��������.</span>
										</td>
	
									</tr>
									<tr>
										<td valign="top">������� �������</td>
										<td>
											<select style="width: 300px;" name="post_access">
												<option value="1">��� ����</option>
												<option value="2">������ ��� ������</option>
												<option value="0">������ ��� ����</option>
											</select><br />
											<!--<span id="micro2">� ����� ������ ����� ��������� �����������.</span>-->
										</td>
									</tr>
									<tr>
										<td valign="top">�������� �����</td>
										<td>
											<textarea name="small_text"  style="width:300px;height:100px;"><?php echo $this->userData['post_info']['small_text']; ?></textarea><br />
											<span id="micro2">Small text</span>
										</td>
									</tr>
									<tr>
										<td valign="top">������ �����</td>
										<td>
											<textarea name="full_text" style="width:300px;height:200px;"><?php echo $this->userData['post_info']['full_text']; ?></textarea><br />
											<span id="micro2">Full text</span>
										</td>
									</tr>
									<tr>
										<td valign="top">��������� ��������������</td>
										<td>
											<input type="checkbox" name="allowcomments" <?php if((int)$this->userData['post_info']['allowcomments'] > 0) echo 'checked'; ?> />
											<span id="micro2">������������ ����� �������������� ����</span>
										</td>
									</tr>
									<tr>
										<td valign="top">���������� ������</td>
										<td>
											<select style="width: 300px;" name="post_mood">
												<option value="0">----</option>
												<?php foreach($this->userData['mood_list'] as $key => $item){ ?>
														<option <?php if($this->userData['post_info']['mood'] == $item['id']) echo 'selected'; ?> value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
												<?php } ?>
											</select><br />
											<span id="micro2">����� ����������</span>
										</td>
									</tr>
									<tr>
										<td valign="top">������ � "������ �� ����"</td>
										<td>
											<select style="width: 300px;" name="post_best_status">
												<option value="0">�� ����������</option>
												<option value="1">��������� �� ���������</option>
												<option value="2">������� �����������</option>
												<option value="3">�������� �����������</option>
											</select><br />
											<span id="micro2">��� ���� � ����?????????????????????</span>
										</td>
									</tr>
									<tr>
										<td colspan="2" align="right"><input type="submit" value="���������" /></td>
	
									</tr>
									</table>
								</form>
							</div></div></div></div>
							<!-- /�������� ������ ������� -->
						</td>
					</tr>
					</table>
					<!-- /������� -->
				</div>

			</div>
			<!-- /������� ����, � ��������� (�������) -->