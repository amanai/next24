			<!-- ������� ����, � ��������� (�������) -->
			<div class="tab-page" id="modules-cpanel">
				<script type="text/javascript">var tabPane1 = new WebFXTabPane( document.getElementById( "modules-cpanel" ), 1 )</script>

				<div class="tab-page">
					<h2 class="tab">�������</h2>
					<!-- ������� -->
					<table width="100%" height="100%" cellpadding="0">
					<tr>
						<td class="next24u_left">
							<!-- ����� ���� -->
								<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
									<div class="block_title"><h2>����������</h2></div>

									<a href="#">������������� �������</a><br />
									<a href="#">������������� �������</a>

								</div></div></div></div>
							<!-- /����� ���� -->
						</td>
						<td class="next24u_right">
							<!-- ������ ���� -->
								<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
									<div class="block_title">
											<div class="block_title_left"><h2>������� ������������</h2></div>
											<div class="block_title_right"><img src="<?php echo IMG_URL?>/close.png" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js')" style="cursor: pointer;" /></div>
									</div>

									<div id="user_profile_js">
										<table width="100%" cellpadding="3">
										<tr>
											<td width="150"><b>������������</b></td>
											<td><?php echo $this->userData['login'];?></td>
										</tr>
											<td><b>��� ������������</b></td>
											<td><?php echo $this->userData['last_name'].' '.$this->userData['first_name'].' '.$this->userData['middle_name'];?></td>
										</tr>
											<td><b>���� ��������</b></td>
											<td><?php echo $this->userData['birth_date_formatted'];?></td>
										</tr>
											<td><b>���� �����������</b></td>
											<td><?php echo $this->userData['registration_date_formatted'];?></td>
										</tr>
											<td><b>���</b></td>
											<td><?php echo $this->userData['gender_formatted'];?></td>
										</tr>
											<td><b>������������</b></td>
											<td><?php echo $this->userData['city'];?></td>
										</tr>
											<td><b>��������</b></td>
											<td><?php echo $this->userData['interests'];?></td>
										</tr>
											<td><b>���������</b></td>
											<td><?php echo $this->userData['reputation'];?> ���������� ���������  (���� - �����)</td>
										</tr>
										</table>
										<table width="100%" cellpadding="3">
										<tr>
											<td colspan="2"><b>� ����</b></td>
										</tr>
										<tr>
											<td colspan="2"><i>
												<?php echo $this->userData['about'];?>
											</i></td>
										</tr>
										</table>
									</div>

								</div></div></div></div>
							<!-- /������ ���� -->
						</td>
					</tr>
					</table>
					<!-- /������� -->
				</div>

			</div>
			<!-- /������� ����, � ��������� (�������) -->