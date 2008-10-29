<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	
	<div class="tab-page tab-page-selected">
	<table width="100%" height="100%" cellpadding="0">
	<tr>
		<td class="next24u_left">
			<!-- левый блок -->

				<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					<div class="block_title"><h2>Отображать каналы RSS</h2></div>
					
					<?php include($this -> _include('news_tree.tpl.php')); ?>

					

				</div></div></div></div>


				<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					<div class="block_title"><h2>Вид отображения</h2></div>
					<div class="rss_cat">
						 <input type="checkbox" /> Полный список новостей<br />
						 <input type="checkbox" /> Сводка новостей
					</div>
				</div></div></div></div>

			<!-- /левый блок -->

		</td>
		<td class="next24u_right">



			<!-- Категория -->
			<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
				<div class="block_title">
					<div class="block_title_left"><h2><?php echo $this->ShowNewsTreeBreadCrumb($this->aNewsTreeBreadCrumb); ?> (все новости)</h2></div>
					<div class="block_title_right"><img src="<?php echo $this -> image_url;?>close.png" width="21" height="24" onclick="ShowOrHide(this, 'rss_cat_n1')" style="cursor: pointer;" /></div>
				</div>
				
				<div id="rss_cat_n1">

					<!-- Бедный Трепашкин --->
					<table>
					<tr>
						<td class="arh_x1">
							<h3><a href="#">Трепашкин отсудил у России три тысячи евро за пытки</a><span style="font-weight: normal;"> &nbsp; (09.07.2008)</span></h3><br />
							Европейский суд по правам человека удовлетворил жалобу бывшего полковника ФСБ Михаила Трепашкина,
							осужденного на четыре года тюрьмы за разглашение гостайны, и обязал Россию выплатить ему три
							тысячи евро в качестве компенсации морального ущерба. Судьи признали, что была нарушена статья,
							запрещающая применять пытки.
						</td>

						<td class="arh_x2" rowspan="3">
							<ul class="list_style1">
								<li><a href="#">Самолет "Аэрофлота" сел в "Шереметьево" с отказавшим двигателем</a> (18.07.2007)</li>
								<li><a href="#">МИД РФ не спешит с ответными мерами в адрес Великобритании</a> (17.07.2007)</li>
								<li><a href="#">В Назрани обстреляли дом родственников Зязикова</a> (16.07.2007)</li>
							</ul>
						</td>
					</tr>
					
					<tr>
						<td class="arh_x1">
							<h3><a href="#">Трепашкин отсудил у России три тысячи евро за пытки</a><span style="font-weight: normal;"> &nbsp; (09.07.2008)</span></h3><br />
							Европейский суд по правам человека удовлетворил жалобу бывшего полковника ФСБ Михаила Трепашкина,
							осужденного на четыре года тюрьмы за разглашение гостайны, и обязал Россию выплатить ему три
							тысячи евро в качестве компенсации морального ущерба. Судьи признали, что была нарушена статья,
							запрещающая применять пытки.
						</td>

					</tr>
					
					<tr>
						<td class="arh_x1">
							<h3><a href="#">Трепашкин отсудил у России три тысячи евро за пытки</a><span style="font-weight: normal;"> &nbsp; (09.07.2008)</span></h3><br />
							Европейский суд по правам человека удовлетворил жалобу бывшего полковника ФСБ Михаила Трепашкина,
							осужденного на четыре года тюрьмы за разглашение гостайны, и обязал Россию выплатить ему три
							тысячи евро в качестве компенсации морального ущерба. Судьи признали, что была нарушена статья,
							запрещающая применять пытки.
						</td>

					</tr>
					</table>
					<div class="rmb14"></div>
					<!-- /Бедный Трепашкин --->

				</div>

			</div></div></div></div>
			<!-- /Категория -->

		</td>
	</tr>
	</table>
		
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>