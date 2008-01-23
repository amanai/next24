			<!-- Главный блок, с вкладками (Контент) -->
			<div class="tab-page" id="modules-cpanel">
				<script type="text/javascript">var tabPane1 = new WebFXTabPane( document.getElementById( "modules-cpanel" ), 1 )</script>
				<div class="tab-page">
					<h2 class="tab">Топ фотографий</h2>
					<!-- ПРОФИЛЬ -->
					<table width="100%" height="100%" cellpadding="0">
					<tr>
						<td class="next24u_right">
							<table class="photo_table">
								<?php foreach($this->userData['photo_list'] as $key => $item){ ?>
									<?php if ($key%4 == 0){ ?><tr><?php } ?>
										<td>
											<div class="block_ee1" style="width: 160px;">
												<div class="block_ee2">
													<div class="block_ee3">
														<div class="block_ee4">
															<div class="block_title">
																<h2><a href="<?php echo $this->router->createUrl('Photo', 'View', array('id'=>$item['id']));?>"><?php echo $item['name'];?></a></h2>
															</div>
															<div style="width: 140px; height: 112px; text-align: center;">
																<a href="<?php echo $this->router->createUrl('Photo', 'View', array('id'=>$item['id']));?>"><img src="<?php echo ($item['thumbnail'] ===false)?IMG_URL.'noimage.gif' :BASE_URL.$item['thumbnail'];?>" width="140" /></a>
															</div>
															<div class="block_title2">
																<a href="#User/Profile/id:<?php echo $item['user_id'];?>"><?php echo $item['login'];?></a><br />
																<span id="micro"><?php echo date("j F Y", strtotime($item['creation_date']));?></span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</td>
								<?php }?>
							</table>
							<!-- листинг -->
							<div class="listing_div_c">
								<li class="listing">
									<?php if ($this->userData['current_page_number'] > 0) { ?>
										<a href="<?php echo  $this->router->createUrl('Photo', 'TopList', array('pn'=>($this->userData['current_page_number']-1)));?>" title="Предыдущая страница">«</a>
									<?php } ?>
									<?php for($i = 0; $i < $this->userData['pages_number']; $i++){ ?>
										<?php if ($this->userData['current_page_number'] == $i) { ?>
											<a class="active"><?php echo ($i+1);?></a>
										<?php } else { ?>
											<a href="<?php echo  $this->router->createUrl('Photo', 'TopList', array('pn'=>$i));?>"><?php echo ($i+1);?></a>
										<?php } ?>
									<?php } ?>
									<?php if ($this->userData['current_page_number'] < $this->userData['pages_number'] - 1) { ?>
										<a href="<?php echo  $this->router->createUrl('Photo', 'TopList', array('pn'=>($this->userData['current_page_number']+1)));?>" title="Следующая страница">»</a>
									<?php } ?>
									
								</li>

							</div>
							<!-- /листинг -->
						</td>
					</tr>
					</table>
					<!-- /ПРОФИЛЬ -->
				</div>

			</div>
			<!-- /Главный блок, с вкладками (Контент) -->