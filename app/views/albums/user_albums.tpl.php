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
							<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
									<div class="block_title"><h2>�����������</h2></div>
									<?php foreach ($this -> userData['album_list'] as $item) {?>
										<a href="#"><?php echo $item['name'];?></a><br />
									<?php } ?>
								</div></div></div></div>
							
								<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
									<div class="block_title"><h2>���������� ���������</h2></div>
									<a href="#">������� ������</a><br />
									<a href="#">��������� ����������</a><br />
									<a href="#">������ ��������</a>
								</div></div></div></div>
							<!-- /����� ���� -->
						</td>
						<td class="next24u_right">
							<!-- �������� ����������� -->
							<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

								<h1>�������� �����������</h1>
								<span id="micro2">�� ������ ��������� �����, �� ����������� �������� 4 ���������.<br />����� ��������� PNG, JPG, GIF �����������.</span>
								<br /><br />
								
								<form action="<?php echo BASE_URL;?>Album/Upload" method="post" enctype="multipart/form-data">
									<table>
										<tr>
											<td width="100">����</td>
											<td><input type="file" style="width: 300px;" name="picture" /><br /></td>
										</tr>
										<tr>
											<td width="100">��������</td>
											<td><input type="text" style="width: 300px;" name="pic_name" /><br /></td>
										</tr>
										<tr>
											<td width="100">� ��������</td>
											<td><input type="checkbox" name="rating" /><br /></td>
										</tr>
										<tr>
											<td width="100">�� �������</td>
											<td><input type="checkbox" name="on_main" /><br /></td>
										</tr>
										<tr>
											<td valign="top">������� �������</td>
											<td>
		
												<select style="width: 300px;" name="access">
													<option value="1">��� ����</option>
													<option value="2">������ ��� ������</option>
													<option value="0">������ ��� ����</option>
												</select><br />
												<span id="micro2">��� ������ �������� � �������������� ���� ������.</span>
											</td>
		
										</tr>
										<tr>
											<td valign="top">������</td>
											<td>
												<select style="width: 300px;" name="album_id">
													<?php foreach ($this -> userData['album_list'] as $item) {?>
													<option value=<?php echo (int)$item['id'];?>><?php echo $item['name'];?></option>
													<?php } ?>
												</select><br />
												<span id="micro2">� ����� ������ ����� ��������� �����������.</span>
		
											</td>
										</tr>
										<tr>
											<td colspan="2" align="right"><input type="submit" value="���������" /></td>
										</tr>
									</table>
								</form>

							</div></div></div></div>
							<!-- /�������� ����������� -->


							<!-- �������� ������ ������� -->
							<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

								<h1>�������� ������ �������</h1>
								<br />
								<table>
								<tr>
									<td width="100" valign="top">�������� �������</td>

									<td>
										<input type="text" style="width: 300px;"><br />
										<span id="micro2">��� ������ �������� � �������������� ���� ������.</span>
									</td>
								</tr>
								<tr>
									<td valign="top">������� �������</td>
									<td>

										<select style="width: 300px;">
											<option>��� ����</option>
											<option>������ ��� ������</option>
											<option>������ ��� ����</option>
										</select><br />
										<span id="micro2">� ����� ������ ����� ��������� �����������.</span>
									</td>

								</tr>
								<tr>
									<td colspan="2" align="right"><input type="submit" value="������� ������" /></td>
								</tr>
								</table>

							</div></div></div></div>
							<!-- /�������� ������ ������� -->


							<!-- ���������� ��������� -->
							<h1>���������� ���������</h1>
							<br />

							<table class="photo_table">
							<tr>
								<td>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

										<div align="center" class="block_title">
											<input type="text" value="Boris" style="width: 140px;" />
										</div>
										<img src="<?php echo IMG_URL?>x1.png" width="140" height="112" id="iborder" />
										<div class="block_title2">
											<span id="micro">����������� �� �������</span> &nbsp; <input type="radio" /><br />
											<a href="#">�������</a>				
										</div>

									</div></div></div></div>
								</td>
								<td>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
										<div align="center" class="block_title">
											<input type="text" value="Boris" style="width: 140px;" />
										</div>
										<img src="<?php echo IMG_URL?>x1.png" width="140" height="112" id="iborder" />
										<div class="block_title2">

											<span id="micro">����������� �� �������</span> &nbsp; <input type="radio" /><br />
											<a href="#">�������</a>				
										</div>
									</div></div></div></div>
								</td>
								<td>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

										<div align="center" class="block_title">
											<input type="text" value="Boris" style="width: 140px;" />
										</div>
										<img src="<?php echo IMG_URL?>x1.png" width="140" height="112" id="iborder" />
										<div class="block_title2">
											<span id="micro">����������� �� �������</span> &nbsp; <input type="radio" /><br />
											<a href="#">�������</a>				
										</div>

									</div></div></div></div>
								</td>
								<td>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
										<div align="center" class="block_title">
											<input type="text" value="Boris" style="width: 140px;" />
										</div>
										<img src="<?php echo IMG_URL?>x1.png" width="140" height="112" id="iborder" />
										<div class="block_title2">

											<span id="micro">����������� �� �������</span> &nbsp; <input type="radio" /><br />
											<a href="#">�������</a>				
										</div>
									</div></div></div></div>
								</td>
							</tr>

							<tr>

								<td>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
										<div align="center" class="block_title">
											<input type="text" value="Boris" style="width: 140px;" />
										</div>
										<img src="<?php echo IMG_URL?>x1.png" width="140" height="112" id="iborder" />
										<div class="block_title2">
											<span id="micro">����������� �� �������</span> &nbsp; <input type="radio" /><br />

											<a href="#">�������</a>				
										</div>
									</div></div></div></div>
								</td>
								<td>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
										<div align="center" class="block_title">
											<input type="text" value="Boris" style="width: 140px;" />
										</div>

										<img src="<?php echo IMG_URL?>x1.png" width="140" height="112" id="iborder" />
										<div class="block_title2">
											<span id="micro">����������� �� �������</span> &nbsp; <input type="radio" /><br />
											<a href="#">�������</a>				
										</div>
									</div></div></div></div>
								</td>

								<td>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
										<div align="center" class="block_title">
											<input type="text" value="Boris" style="width: 140px;" />
										</div>
										<img src="<?php echo IMG_URL?>x1.png" width="140" height="112" id="iborder" />
										<div class="block_title2">
											<span id="micro">����������� �� �������</span> &nbsp; <input type="radio" /><br />

											<a href="#">�������</a>				
										</div>
									</div></div></div></div>
								</td>
								<td>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
										<div align="center" class="block_title">
											<input type="text" value="Boris" style="width: 140px;" />
										</div>

										<img src="<?php echo IMG_URL?>x1.png" width="140" height="112" id="iborder" />
										<div class="block_title2">
											<span id="micro">����������� �� �������</span> &nbsp; <input type="radio" /><br />
											<a href="#">�������</a>				
										</div>
									</div></div></div></div>
								</td>

							</tr>
							</table>

							<input type="submit" value="��������� ���������" />
							<!-- /���������� ��������� -->
						</td>
					</tr>
					</table>
					<!-- /������� -->
				</div>

			</div>
			<!-- /������� ����, � ��������� (�������) -->