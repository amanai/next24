<?php include($this -> _include('header.tpl.php')); ?>
				<div class="widget-page clearfix"> 
					<div class="widgets-tabs"> 
						<ul class="tabs clearfix"> 
						<?php 
							$v_request = Project::getRequest();
    						$v_session = Project::getSession();
    						$request_keys = $v_request->getKeys();	
    						if(isset($request_keys['d'])) $d = $request_keys['d'];				
						?>
							<li <?if(!isset($d)) echo 'class="active"';?>> 							
										<div class="dropdown dropdown-noactive"> 
											<div class="d-head"> 
												<span class="with-drop"><a href="<?php echo $this->createUrl('Index', 'Index', null, false); ?>">моя вкладка</a></span><i class="arrow-icon down-arrow"></i> 
											</div> 
											<div class="d-body"> 
												<ul> 
													<li><a href="#">Переименовать</a></li> 
													<li><a href="#">Удалить</a></li> 
												</ul> 
											</div> 
										</div> 
							</li> 
							<?php if($this->desktops) { ?>
							<?php foreach ($this->desktops as $key => $value) {?>
							<li <?if(isset($d) && ($key==$d)) echo 'class="active"';?>><a href="<?php echo $this->createUrl('Index', 'Index', array('d' => $key), false); ?>"><?=$value;?></a></li>
							<? } ?>
							<? } ?>
							<li class="add"><a href="<?php echo $this->createUrl('Index', 'addDesktop', null, false); ?>" title="Добавить"><i class="icon add-tab-icon"></i>+</a></li> 
						</ul> 
						<ul class="sub-tabs clearfix"> 
							<li><a href="#"><i class="icon add-widget-icon"></i>Добавить виджет</a></li> 
							 
							<li> 
										<div class="dropdown dropdown-noactive"> 
											<div class="d-head"> 
												<a href="#"><i class="icon settings-icon"></i>настройка вкладки</a> 
											</div> 
											<div class="d-body"> 
												<ul> 
													<li><a href="#">Вернуть размеры виджетов по умолчанию</a></li> 
												</ul> 
											</div> 
										</div> 
							</li> 
						</ul> 
					</div>	
					<!-- /widgets-tabs --> 
					<div class="widget-columns clearfix"> 
					</div> 
					<!-- /widget-columns --> 
				</div> 
				<!-- /widget-page --> 			
<?php include($this -> _include('footer.tpl.php')); ?>