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

									������������� �������<br />

								</div></div></div></div>
							<!-- /����� ���� -->
						</td>
						<td class="next24u_right">
							<!-- ������ ���� -->
								<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
									<div class="block_title"><h2>������� ������������</h2></div>
									<form action="<?php echo $this->router->createUrl('User', 'Saveprofile')?>" method="post">
									<table cellpadding="3">
									<tr>
										<td width="150" valign="top" style="padding-top: 5px;"><b>E-Mail</b></td>
										<td>
											<input type="text" style="width: 200px;" name="email" value="<?php echo $this->userData['email'];?>" /><br />
											<span id="micro2">����������, ���������� ������������ �����,<br />��� ��� �� ���� ��� ����� ���������� ����������� ���������� � ������� �� ����.</span>
										</td>
									</tr>
									<tr>
										<td valign="top" style="padding-top: 5px;"><b>�������</b></td>
										<td>
											<input type="text" style="width: 200px;" name="last_name" value="<?php echo $this->userData['last_name'];?>"/><br />
											<span id="micro2">���� �������� �������. ��������� ���������, ������ � ������ ������.</span>
										</td>
									</tr>
									<tr>
										<td><b>���</b></td>
										<td valign="top" style="padding-top: 5px;">
											<input type="text" style="width: 200px;" name="first_name" value="<?php echo $this->userData['first_name'];?>"/><br />
											<span id="micro2">���� �������� ���. ��������� ���������, ������ � ������ ������.</span>
										</td>
									</tr>
									<tr>
										<td><b>��������</b></td>
										<td valign="top" style="padding-top: 5px;">
											<input type="text" style="width: 200px;" name="middle_name" value="<?php echo $this->userData['middle_name'];?>"/><br />
											<span id="micro2">���� ��������. ��������� ���������, ������ � ������ ������.</span>
										</td>
									</tr>
									<tr>
										<td><b>���� ��������</b></td>
										<td>
											<select name="birth_day">
												<?php for($i=1;$i<=31;$i++){?>
												<?php $selected = ""; ?>
												<?php if($i == $this->userData['birth_day']) $selected = 'selected="selected"';?>
												<option <?php echo $selected;?> ><?php echo $i;?></option>
												<?php }?>
											</select>
											
											<select name="birth_month">
												<option <?php echo $this->userData['birth_month'][1];?> value="1">������</option>
												<option <?php echo $this->userData['birth_month'][2];?> value="2">�������</option>
												<option <?php echo $this->userData['birth_month'][3];?> value="3">�����</option>
												<option <?php echo $this->userData['birth_month'][4];?> value="4">������</option>
												<option <?php echo $this->userData['birth_month'][5];?> value="5">���</option>
												<option <?php echo $this->userData['birth_month'][6];?> value="6">����</option>
												<option <?php echo $this->userData['birth_month'][7];?> value="7">����</option>
												<option <?php echo $this->userData['birth_month'][8];?> value="8">�������</option>
												<option <?php echo $this->userData['birth_month'][9];?> value="9">��������</option>
												<option <?php echo $this->userData['birth_month'][10];?> value="10">�������</option>
												<option <?php echo $this->userData['birth_month'][11];?> value="11">������</option>
												<option <?php echo $this->userData['birth_month'][12];?> value="12">�������</option>
											</select>
											
											<select name="birth_year">
												<?php for($i=1940;$i<=date("Y");$i++){?>
												<?php $selected = "";?>
												<?php if($i == $this->userData['birth_year']) $selected = 'selected="selected"';?>
												<option <?php echo $selected;?> ><?php echo $i;?></option>
												<?php }?>
											</select>
										</td>
									</tr>
									<tr>
										<td><b>������</b></td>
										<td valign="top" style="padding-top: 5px;">
											<select name="country_id">
												<?php foreach($this->userData['countries'] as $country){?>
												<?php $selected = "";?>
												<?php if($country['id'] == $this->userData['country_id']) $selected = 'selected="selected"';?>
												<option <?php echo $selected;?> value="<?php echo $country['id'];?>"><?php echo $country['name'];?></option>
												<?php }?>
											</select><br />
											<span id="micro2">������ ����������.</span>
										</td>
									</tr>
									<tr>
										<td valign="top" style="padding-top: 5px;"><b>�����</b></td>
										<td>
											<input type="text" style="width: 200px;" name="city" value="<?php echo $this->userData['city'];?>"/><br />
											<span id="micro2">����� ����������. ��������� ��������, ��������, ������ � �����.</span>
										</td>
									</tr>
									<tr>
										<td><b>���</b></td>
										<td>
											<input name="gender" value="0" type="radio" <?php echo $this->userData['gender_formatted'][0];?> /> �������  &nbsp;&nbsp;
											<input name="gender" value="1" type="radio" <?php echo $this->userData['gender_formatted'][1];?>/> �������
										</td>
									</tr>
									<tr>
										<td><b>� ����</b></td>
										<td>
											<textarea style="width: 450px; height: 100px;" name="about"><?php echo $this->userData['about'];?></textarea><br />
											<span id="micro2">���������� � ����.</span>
										</td>
									</tr>
									<tr>
										<td><b>��������</b></td>
										<td>
											<textarea style="width: 450px; height: 100px;" name="interest"><?php echo $this->userData['interest'];?></textarea><br />
											<span id="micro2">���� ��������. ����� � �������������� ����������� �������.</span>
										</td>
									</tr>
									<tr>
										<td colspan="2" align="right"><input type="submit" value="��������� ���������" /></td>
									</tr>
									</table>
									</form>
								</div></div></div></div>



								<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
									<div class="block_title"><h2>����� �����, ������, ������, ������</h2></div>


									<table cellpadding="3">
									<tr>
										<td width="150"><b>������ �����</b></td>
										<td>
											<select>
												<option>�������� ���</option>
												<option>�����</option>
												<option>������</option>
												<option>������</option>
												<option>������</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><b>������</b></td>
										<td>
											<select>
												<option>������</option>
												<option>�������</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><b>�����</b></td>
										<td><input type="text" style="width: 200px;" /></td>
									</tr>
									<tr>
										<td><b>���</b></td>
										<td><input type="text" style="width: 200px;" /></td>
									</tr>
									<tr>
										<td><b>�����</b></td>
										<td><input type="text" style="width: 200px;" /></td>
									</tr>
									<tr>
										<td colspan="2" align="right"><input type="submit" value="��������" /></td>
									</tr>
									</table>


								</div></div></div></div>



								<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
									<div class="block_title"><h2>������</h2></div>

									<table cellpadding="3">
									<tr>
										<td colspan="2" id="micro2">������ - ��� ��������, ������� ����� ���� �������� ����� � ����� ������ � ������������, �����, ������ ������� � �.�.<br/> ������ ������ ���� �� ����� 100�100 ��������.</td>
									</tr>
									<tr>
										<td width="150" valign="top" style="padding-top: 5px;"><b>����</br></td>
										<td>
											<input type="file" style="width: 450px;" /><br />
											<span id="micro2">����������� ������� GIF, JPG, PNG</span>
										</td>
									</tr>
									<tr>
										<td colspan="2" align="right"><input type="submit" value="��������� ������"></td>
									</tr>
									</table>

								</div></div></div></div>
							<!-- /������ ���� -->
						</td>
					</tr>
					</table>
					<!-- /������� -->
				</div>
			</div>
			<!-- /������� ����, � ��������� (�������) -->