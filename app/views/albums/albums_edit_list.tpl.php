			<!-- ������� ����, � ��������� (�������) -->
			<div class="tab-page" id="modules-cpanel">
				<script type="text/javascript">var tabPane1 = new WebFXTabPane( document.getElementById( "modules-cpanel" ), 1 )</script>

				<div class="tab-page">
					<h2 class="tab">��������� �������</h2>
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
												<a href="<?php echo $this->router->createUrl('Photo', 'Edit', array('id'=>$item['id']));?>"><img src="<?php echo IMG_URL; ?>edit.gif" alt="������������� ������" class="editbtn" height="12" width="11"></a>
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
							<form action="<?php echo $this->router->createUrl('Album', 'ListSave');?>" method="post">
								<div class="block_title"><h2>���������� ���������</h2></div>
								<table class="photo_table">
									<?php foreach($this->userData['album_list'] as $key => $item){ ?>
										<?php if ($key%4 == 0){ ?><tr><?php } ?>
											<input type="hidden" name="album_id[<?php echo $item['id'];?>]" value="<?php echo $item['id'];?>"/>
											<td>
												<div class="block_ee1" style="width: 160px;">
													<div class="block_ee2">
														<div class="block_ee3">
															<div class="block_ee4">
																<div class="block_title">
																	<input type="text" name="album_name[<?php echo $item['id'];?>]" value="<?php echo $item['name'];?>"/>
																</div>
																<div style="width: 140px; height: 112px; text-align: center;">
																	<a href="<?php echo $this->router->createUrl('Photo', 'Album', array('id'=>$item['id']));?>"><img src="<?php echo ($item['thumbnail'] ===false)?IMG_URL.'noimage.gif' :BASE_URL.$item['thumbnail'];?>" width="140" /></a>
																</div>
																<div class="block_title2">
																	<select style="width: 140px;" name="access[<?php echo $item['id'];?>]">
																		<option value="1" <?php echo ($item['access']==1?'selected':null);?>>��� ����</option>
																		<option value="2" <?php echo ($item['access']==2?'selected':null);?>>������ ��� ������</option>
																		<option value="0" <?php echo ($item['access']==0?'selected':null);?>>������ ��� ����</option>
																	</select>
																	<span id="micro">
	  																	����������� �� �������<input type="radio" name="on_main" value="<?php echo $item['id'];?>"/>
	  																</span>
	
																	<span id="micro">
																		�������<input type="checkbox" name="delete[<?php echo $item['id'];?>]" />
																	</span>
															</div>
														</div>
													</div>
												</div>
											</td>
									<?php }?>
								</table>
								<input type="submit" class="button" value="��������� ���������" />
							</form>
							<div>
							</
						</td>
					</tr>
					</table>
					<!-- /������� -->
				</div>

			</div>
			<!-- /������� ����, � ��������� (�������) -->