			</div>
			<!-- /middle -->

			<div class="footer">
				<p class="copyright">© <span class="next24">NEXT<span>24</span></span> 2008</p>
				<script type="text/javascript">
					var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
					document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
				</script>
				<script type="text/javascript">
					try {
						var pageTracker = _gat._getTracker("UA-8560199-1");
						pageTracker._trackPageview();
					} catch(err) {}
				</script>	
				<!--LiveInternet counter-->
				<script type="text/javascript"><!--
					document.write("<a href='http://www.liveinternet.ru/click' "+
					"target=_blank><img src='http://counter.yadro.ru/hit?t45.6;r"+
					escape(document.referrer)+((typeof(screen)=="undefined")?"":
					";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
					screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
					";"+Math.random()+
					"' alt='' title='LiveInternet' "+
					"border='0' width='31' height='31'><\/a>")
				//--></script>
				<!--/LiveInternet-->											
			</div>
			<!-- /footer -->

		</div>
		<!-- /bone -->
		<div class="popup-frame popup-frame-main" style="display: none;" id="main_unreg_popup"> 
			<div class="popup-content"> 
				<div class="popup-ttl clearfix"> 
					<h2><span class="next24">NEXT<span>24</span></span></h2> 
					<div class="close"><a href="#" onclick="getElementById('main_unreg_popup').style.display='none';"><span>x</span> закрыть</a></div> 
				</div> 
				<div class="popup-text"> 
					<div class="site-features clearfix"> 
						<ul class="c-1"> 
							<li><i class="icon"></i>Настройте главную страницу “под себя”</li> 
							<li><i class="icon"></i>Смотрите самые свежие новости</li> 
							<li><i class="icon"></i>Учавствуйте в Дебатах</li> 
							<li><i class="icon"></i>Заводите блоги на любые темы</li> 
							<li><i class="icon"></i>Фотогалерея на 5Гб беслпатно!</li> 
						</ul> 
						<ul class="c-2"> 
							<li><i class="icon"></i>Задавайте вопросы и получайте ответы</li> 
							<li><i class="icon"></i>Используйте социальные сервисы</li> 
							<li><i class="icon"></i>Делитесь закладками</li> 
							<li><i class="icon"></i>Пишите статьи</li> 
							<li><i class="icon"></i>Находите новых друзей</li> 
						</ul> 
					</div> 
					<div>Смотреть подробный <a href="#">Тур по сайту</a></div> 
					<p class="explanation">Мы постарались сделать портал для вас. Он максимально удобен и ориентирован как на новичков
	в Интернет, так и на профессиональных пользователей сети. В скором времени появятся еще очень 
	много интересных разделов.</p> 
					<div class="reg-button"> 
						<a href="<?php echo $this->createUrl('User', 'Registration', null, false)?>"><span><span>Регистрация</span></span></a> 
					</div> 
				</div> 
			</div> 
			<div class="popup-shadow"></div> 
			 <!--[if lte IE 6.5]><iframe></iframe><![endif]--> 
		</div> 		
	</body>
</html>