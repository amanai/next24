<?php include($this -> _include('../header.tpl.php')); ?>	
<?php 
	$v_session = Project::getSession(); 
	$qpp = $v_session->getKey('qpp');
?>			
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
					<?php if($this->current_user && $this->current_user->id > 0) { ?>
						<div class="content-header">
							<h1>Задать вопрос<i class="icon ask-icon"></i></h1>
							<form action="<?=$this->createUrl('QuestionAnswer', 'ManagedQuestion', array($this->question['id']))?>" method="post" class="ask-form">
								<table>
									<tr class="textarea-field">
										<td colspan="5"><textarea name="question_text" rows="5" cols="20"><?=$this->question['q_text']?></textarea></td>
									</tr>
									<tr>
										<td class="label-field">
											<label for="f1">Категория</label>
										</td>
										<td class="select-field">
											<select id="f1" name="cat_id">
								        	<?foreach ($this->question_cat as $cat):?>
								        		<option value="<?=$cat['id']?>" <?if($cat['id']==$this->question['questions_cat_id']) { ?> selected <? } ?>><?=$cat['name']?></option>
								        	<?endforeach;?>
											</select>
										</td>
										<td class="label-field">
											<label for="f2">Tэги</label>
										</td>
										<?php $i = 0;
											foreach ($this->question_tag_list as $v) {
												if($i) {
													$q_list .= ', '.$v['name'];
												}
												else {
													$q_list .= $v['name'];
												}	
												$i++;
											}
										?>	
										<td class="input-field">
											<input id="f2" type="text" value="<?=$q_list; ?>" name="tags" />										
										</td>
										<td class="button-field"><input type="submit" name="submit" value="Спросить" /></td>
									</tr>
								</table>
							</form>
						</div>
						<? }?>
						<!-- /content-header -->
						<ul class="view-filter clearfix">
							<?php include($this -> _include('../tab_panel.tpl.php')); ?>
						</ul>
						<!-- /view-filter -->
						<div class="display-filter clearfix">
							<div class="number-filter">
								показывать по: 
							<?php if(!$qpp || $qpp == 10){ ?>
									<strong>10</strong> | <a href="<?php echo $this->createUrl('QuestionAnswer', 'ListStat', null, false); ?>/qpp:20">20</a> | <a href="<?php echo $this->createUrl('QuestionAnswer', 'ListStat', null, false); ?>/qpp:30">30</a> ответов
							<?php }elseif($qpp == 20) { ?>
									<a href="<?php echo $this->createUrl('QuestionAnswer', 'ListStat', null, false); ?>/qpp:10">10</a> | <strong>20</strong> | <a href="<?php echo $this->createUrl('QuestionAnswer', 'ListStat', null, false); ?>/qpp:30">30</a> ответов
							<?php } elseif($qpp == 30) { ?>	
									<a href="<?php echo $this->createUrl('QuestionAnswer', 'ListStat', null, false); ?>/qpp:10">10</a> | <a href="<?php echo $this->createUrl('QuestionAnswer', 'ListStat', null, false); ?>/qpp:20">20</a> | <strong>30</strong> ответов
							<? } ?>							
							</div>
						</div>
						<!-- /display-filter -->
						<table class="stat-table">
							<thead>
								<tr>
									<th class="main-row">Вопросы</th>
									<th><a class="script-link" href="<?php echo $this->createUrl('QuestionAnswer', 'ListStat', null, false).((($request->inp_sort=='asc')&&($request->type=='author'))?'/inp_sort:desc/type:author':'/inp_sort:asc/type:author'); ?>"><span class="t">Кто спрашивает</span></a></th>
									<th><span class="sort-by-this"><a class="script-link" href="<?php echo $this->createUrl('QuestionAnswer', 'ListStat', null, false).((($request->inp_sort=='asc')&&($request->type=='answer'))?'/inp_sort:desc/type:answer':'/inp_sort:asc/type:answer'); ?>"><span class="t">Ответы</span><i class="arrow-icon"></i></a></span></th>
									<th><a class="script-link" href="<?php echo $this->createUrl('QuestionAnswer', 'ListStat', null, false).((($request->inp_sort=='asc')&&($request->type=='create'))?'/inp_sort:desc/type:create':'/inp_sort:asc/type:create'); ?>"><span class="t">Дата создания</span></a></th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($this->question_list as $key => $item) { ?>
							<?php 
								$user = Project::getUser()->getDbUser()->getUserByLogin($item['login']);
								$avatar = Project::getUser()->getDbUser()->getUserAvatar($user['id']);
								$avPath = $avatar['path'];
								if(!$avPath || $avPath == 'no.png') $avPath = 'no25.jpg';
							?>								
								<tr>
									<td class="qv">
										<a href="<?=$this->createUrl('QuestionAnswer', 'ViewQuestion', array($item['id']))?>"><?=$item['q_text']?></a>
									</td>
									<td class="av"><a href="<?=$request->createUrl('Index','Index', null, $item['login']);?>" class="avatar-link"><img src="<?=$this->image_url.'avatar/'.$avPath;?>" style="width:25px;height:25px;" alt="" class="avatar" /><span class="t"><?=$item['login'];?></span></a></td>
									<td class="an"><?=$item['a_count']?></td>
									<td class="date"><?=date_format(new DateTime($item['creation_date']),'Y.m.d H:i:s')?></td>
								</tr>
							<?php } ?>								
							</tbody>
						</table>
						<ul class="pages-list clearfix">
							<?=$this->question_list_pager?>
						</ul>
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<?php include($this -> _include('left_panel.tpl.php')); ?>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<?php include($this -> _include('../footer.tpl.php')); ?>				