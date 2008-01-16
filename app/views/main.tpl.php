<html>
<head>
	<title>Next24</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<link href="<?php echo CSS_URL?>style.css" type="text/css" rel="StyleSheet" />
	<link href="<?php echo CSS_URL?>tabpane.css" type="text/css" rel="StyleSheet"	/>
	<script type="text/javascript" src="<?php echo JS_URL;?>tabpane.js"></script>
	<script type="text/javascript" src="<?php echo JS_URL;?>sys.js"></script>		
</head>
<body>


<table width="100%" height="100%" cellpadding="0">
<tr>
	<td class="header">
		<!-- HEADER -->
		<table width="100%" height="180" cellpadding="0">
		<tr>
			<td width="270"><a href="#"><img src="<?php echo IMG_URL?>logo.png" width="270" height="180" /></a></td>
			<td class="header2" align="right">
				<!-- ���� ����������� -->
				<?php if(isset($this->userData['first_name'])) {?>
					<table width="210" height="125" cellpadding="0">
					<tr>
						<td class="user1"> </td>
						<td class="user2">

							<div class="user2_title">����� ����������</div>
							<div class="user2_zz">
								<a href="<?php echo $this->router->createUrl('User', 'Viewprofile')?>">�������</a><br />
								<a href="#">����������</a><br />
								<a href="#">�������</a><br />
								<a href="#">���������</a>
							</div>

							<div style="float: left;"><a href="#"><img src="<?php echo IMG_URL?>open.png" width="21" height="24" /></a></div>
							<div align="right" style="padding-top: 7px;">�� ����� ���: <a href="#">Hunter</a></div>

						</td>
						<td class="user3"> </td>
						<td width="20"><a href="<?php echo $this->router->createUrl('User', 'Logout')?>"><img src="<?php echo IMG_URL?>exit.png" width="20" height="63" /></a></td>
					</tr>
					</table>					
				<?php } else { ?>
					<table width="220" height="125" cellpadding="0">
					<tr>
						<td class="user1"> </td>
						<td class="user2">
							<form action="<?php echo $this->router->createUrl('User', 'Login')?>" method="POST">
								<input type="hidden" value="<?php echo $this->lastPath; ?>" name="lastPath">
								<div class="user2_title">�����������</div>
								<table align="center" cellpadding="0">
								<tr>
									<td>�����:</td>
									<td><input type="text" style="width: 130px;" name="login"/></td>
								</tr>
								<tr>
									<td>������:</td>
									<td><input type="password" style="width: 130px;" name="pass"/></td>
								</tr>
								</table>
								<div class="user2_x"><input type="checkbox" style="padding: 0px;" /> ��������� <input type="submit" value="����" style="width: 45px;" /></div>
								<div class="user2_x"><a href="#">�������� ������?</a> | <a href="#">�����������</a></div>
							</form>
						</td>
						<td class="user3"> </td>
					</tr>
					</table>	
				<?php } ?>		
				<!-- /���� ����������� -->
			
							</td>
			<td width="170">
				<!-- ��������� -->
				<table width="170" height="180" cellpadding="0">
				<tr>
					<td class="menu1"> </td>
					<td class="menu2"> </td>
					<td class="menu3">
						<a href="#">�������</a><br />
						<a href="#">������</a><br />
						<a href="#">����� ��������</a><br />
						<a href="#">��������</a><br />
						<a href="#">������-�����</a><br />
						<a href="#">�����������</a><br />
						<a href="#">����</a>
					</td>
				</tr>
				</table>
				<!-- /��������� -->
			</td>
		</tr>
		</table>		
		<!-- /HEADER -->
	</td>
</tr>
<tr>
	<td valign="top">
	<!-- ���� ����� -->
	<table width="100%" cellpadding="0">
	<tr>
		<td class="next24">
		<?php echo $this->content; ?>
								
								
<!--		<td class="next24_left"></td>
		<td class="next24_right"></td> -->
		</td>
	</tr>
	</table>
	<!-- /���� ����� -->
	</td>
</tr>
<tr>
	<td class="footer">
		<!-- FOOTER -->
			��� ����� ��������.<br />
			<a href="http://ruster.info/" target="_blank">Design by Ruster</a><br />
			����������� �����: <a href="#">info@next24.ru</a>
		<!-- /footer -->
	</td>
</tr>
</table>

</body>
</html>
	
	
	
	
	

<!--
<?php if(isset($this->userData['first_name'])) {?>
����� ���������� <?php echo $this->userData['first_name'].' '.$this->userData['last_name']; ?>!<br/>
<a href="<?php echo $this->router->createUrl('User', 'Logout')?>">�����</a>
<?php } else { ?>
<form action="<?php echo $this->router->createUrl('User', 'Login')?>" method="POST">
<input type="hidden" value="<?php echo $this->lastPath; ?>" name="lastPath">
�����: <input type="text" name="login"><br/>
������: <input type="password" name="pass"><br/>
<input type="submit" value="�����">
</form>
<?php } ?>
	
<a href="<?php echo $this->router->createUrl('Rights')?>">���������� �������</a>
	
-->