			<!-- ������� ����, � ��������� (�������) -->
			<div class="tab-page" id="modules-cpanel">
				<script type="text/javascript">var tabPane1 = new WebFXTabPane( document.getElementById( "modules-cpanel" ), 1 )</script>

				<div class="tab-page">
					<h2 class="tab">����������</h2>
					<!-- ������� -->
					<table width="100%" height="100%" cellpadding="0">
					<tr>
						<td class="next24u_left">
							<!-- ����� ���� -->
								<?php if (is_array($this -> userData['album_list'])) {?>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
										<div class="block_title"><h2>�����������</h2></div>
										<?php foreach ($this -> userData['album_list'] as $item) {?>
											<p><a href="#"><img src="<?php echo IMG_URL; ?>folder.png" id="ico2" height="12" width="15"><?php echo $item['name'];?></a>&nbsp;&nbsp;
												<a href="<?php echo $this->router->createUrl('Album', 'Edit', array('id'=>$item['id']));?>"><img src="<?php echo IMG_URL; ?>edit.gif" alt="������������� ������" class="editbtn" height="12" width="11"></a>
											</p>
										<?php } ?>
									</div></div></div></div>
								<?php } ?>
								<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
									<div class="block_title"><h2>���������� ���������</h2></div>
									<p><a href="<?php echo $this->router->createUrl('Album', 'CreateForm');?>">������� ������</a></p>
									<p><a href="<?php echo $this->router->createUrl('Album', 'UploadForm');?>">��������� ����������</a></p>
									<p><a href="<?php echo $this->router->createUrl('Album', 'List');?>">������ ��������</a></p>
								</div></div></div></div>
							<!-- /����� ���� -->
						</td>
						<td class="next24u_right">
							<!-- �������� ������ ������� -->
							<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
							<form action="<?php echo $this->router->createUrl('Album', 'Create');?>" method="post">
								<h1>�������� ������ �������</h1>
								<br />
								<table>
								<tr>
									<td width="100" valign="top">�������� �������</td>

									<td>
										<input type="text" name="album_name" style="width: 300px;"><br />
										<span id="micro2">��� ������ �������� � �������������� ���� ������.</span>
									</td>
								</tr>
								<tr>
									<td valign="top">������� �������</td>
									<td>

										<select style="width: 300px;" name="album_access">
											<option value="1">��� ����</option>
											<option value="2">������ ��� ������</option>
											<option value="0">������ ��� ����</option>
										</select><br />
										<span id="micro2">� ����� ������ ����� ��������� �����������.</span>
									</td>

								</tr>
								<tr>
									<td colspan="2" align="right"><input type="submit" value="������� ������" /></td>
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