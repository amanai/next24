<html>
<head>
	<title><?=$this->page_title;?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<link href="<?=$this->getBothCJ($this -> _css_files,'css');?>" type="text/css" rel="StyleSheet"/>
	<script type="text/javascript" src="<?=$this->getBothCJ($this -> _js_files,'js');?>"></script>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" /> 
	<link id="page_favicon" href="/favicon.ico" rel="icon" type="image/x-icon" />
      <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAIMN2iaCMFuGQ7iw1w3khQhR-v9yHoD50evrZ-pbO1wgn-sHpRBTCwGDBW1h8fK3f31phKFZTanuxDA"
            type="text/javascript"></script>
    <script type="text/javascript">

    function initialize() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map_canvas"));
        map.setCenter(new GLatLng(37.4419, -122.1419), 13);
      }
    }
	
    </script>
 <script type="text/javascript" charset="utf-8"> 
 
    //<![CDATA[



	var search_mode = false;



    function load() {

      if (GBrowserIsCompatible()) {



	 	var map = new GMap2(document.getElementById("map"),{mapTypes:[G_HYBRID_MAP, G_SATELLITE_MAP]});



		document.map = map;



  		document.map.addControl(new GScaleControl());

		document.map.addControl(new GMapTypeControl());

		document.map.addControl(new GLargeMapControl());



		var copyright = new GCopyright(1,

          new GLatLngBounds(new GLatLng(58.215939957794006,55.65673828125),

          					new GLatLng(57.837441387883096,56.79039001464844)),

          0, "&copy; 2007 next24.ru");



      	var copyrightCollection = new GCopyrightCollection("p59.ru");

      	copyrightCollection.addCopyright(copyright);



      	CustomGetTileUrl=function(a,b){

          return "http://next24.ru/img/map/"+(17-b)+"/"+a.x+"/"+a.x+"_"+a.y+"_"+(17-b)+".png";

      	}



       	var tilelayers = [new GTileLayer(copyrightCollection,0,17)];

      	tilelayers[0].getTileUrl = CustomGetTileUrl;



      //	var custommap = new GMapType(tilelayers, new GMercatorProjection(18), "Пермь",{errorMessage:"Данный фрагмент карты отсутствует"});



     	map.custommap = custommap;

     	document.map.addMapType(custommap);



        document.map.setCenter(new GLatLng(58.0163, 56.2403), 11, custommap);



		var InfomirIcon = new GIcon();

		InfomirIcon.iconSize=new GSize(22,32);

		InfomirIcon.iconAnchor=new GPoint(11,32);

		InfomirIcon.infoWindowAnchor=new GPoint(11,0);

		InfomirIcon.image="/img/arrow.png";

 		document.InfomirIcon = InfomirIcon;



		var TbIcon = new GIcon();

		TbIcon.iconSize=new GSize(24,24);

		TbIcon.iconAnchor=new GPoint(12,12);

		TbIcon.infoWindowAnchor=new GPoint(12,0);

		TbIcon.image="/img/tb.gif";

		document.TbIcon = TbIcon;



		var TmIcon = new GIcon();

		TmIcon.iconSize=new GSize(24,24);

		TmIcon.iconAnchor=new GPoint(12,12);

		TmIcon.infoWindowAnchor=new GPoint(12,0);

		TmIcon.image="/img/tm.gif";

		document.TmIcon = TmIcon;



		var BusIcon = new GIcon();

		BusIcon.iconSize=new GSize(24,24);

		BusIcon.iconAnchor=new GPoint(12,12);

		BusIcon.infoWindowAnchor=new GPoint(12,0);

		BusIcon.image="/img/bus.gif";

		document.BusIcon = BusIcon;







		GEvent.addListener(map, "dblclick", function(overlay, latlng) {

          if (latlng) {

			document.map.clearOverlays();



			var UserIcon = new GIcon();

			UserIcon.iconSize=new GSize(22,32);

			UserIcon.iconAnchor=new GPoint(11,32);

			UserIcon.infoWindowAnchor=new GPoint(11,0);

			UserIcon.image="/img/arrow_user.png";



            marker = new GMarker(latlng, {draggable:true, icon:UserIcon});



              GEvent.addListener(marker, "click", function() {

              var html = "<div id='InfoWindowError'></div>"+

             			 "><div id='InfoWindowId'><table>" +
                         "<tr><td>Название<span style='color:red;'>*</span>:</td><td><input type='text' id='marker_name'style/ size='50' =''></td></tr>" +
                         "<tr><td>Адрес:</td><td><input type='text' id='marker_address'style/ size='50' =''></td></tr>" +
                         "<tr><td colspan='2'>Описание:</td></tr>" +
                         "<tr><td colspan='2' align='center'><textarea name='marker_desc' id='marker_desc' rows='5' cols='40' style='border: #0A3F8A 1px solid;font-size:10px;'></textarea></td></tr>" +
                         "<tr><td colspan='2' align='center'><input type='button' value='Добавить' onclick='javascript:saveData();'  style='border: #0A3F8A 1px solid;font-size:10px;'/></td></tr></table>" +
                         "<span style='font-size:90%;'><span style='color:red;'>*</span> - обязательно для заполенения</span></div>";
 
              marker.openInfoWindow(html);
              });
            document.map.addOverlay(marker);
          }
        });
 
		function showAddress(lat, lng, htmlInfo, moveToPoint, zoom, alt) {
			var point = new GLatLng(lat, lng);
	      		if (moveToPoint) {
		           document.map.setCenter(point, zoom);
		 	}
		  	var marker = new GMarker(point,{icon: InfomirIcon, title: alt});
		    document.map.addOverlay(marker);
		    if (htmlInfo != "") {
		    	GEvent.addListener(marker, "mouseover", function() {
		        	marker.openInfoWindowHtml(htmlInfo);
		           });
	    	}
		}
		
  	  }
	}
 
 
 	function saveData() {
 
      var marker_name = encodeURI(document.getElementById("marker_name").value);
      var marker_address = encodeURI(document.getElementById("marker_address").value);
      var marker_desc = encodeURI(document.getElementById("marker_desc").value);
      var latlng = marker.getLatLng();
      var lat = latlng.lat();
      var lng = latlng.lng();
 
      var request = GXmlHttp.create();
	  request.open("GET", "/ajax/get_map_element.php?mode=add_object&marker_name="+marker_name+"&marker_address="+marker_address+"&marker_desc="+marker_desc+"&lat="+lat+"&lng="+lng, true);
      request.onreadystatechange = function() {
	    if (request.readyState == 4) {
          var xmlDoc = GXml.parse(request.responseText);
          var result = xmlDoc.documentElement.getElementsByTagName("result");
 
          var status = result[0].getAttribute("status");
          var message = result[0].getAttribute("message");
 
 		  if (status==1){
 		  	document.getElementById("InfoWindowError").innerHTML=message;
 		  }
          else{
 		  	document.getElementById("InfoWindowError").innerHTML=message;
          	changeStateDisplay("InfoWindowId");
          }
		}
	  }
	  request.send(null);
    }
 
 
	function clear_all(){
		document.map.clearOverlays();
	    document.getElementById("clear_all").style.display="none";
	}

	function show_street(id_street){
		document.map.clearOverlays();
	    document.getElementById("clear_all").style.display="";
 
	    var request = GXmlHttp.create();
	    request.open("GET", "/ajax/get_map_element.php?mode=street&id_street="+id_street, true);
	    request.onreadystatechange = function() {
	        if (request.readyState == 4) {
 
	          var xmlDoc = GXml.parse(request.responseText);
 
	          var street = xmlDoc.documentElement.getElementsByTagName("street");
 
              var street_name = street[0].getAttribute("street_name");
              var color = street[0].getAttribute("color");
              var weight = parseInt(street[0].getAttribute("weight"));
              var points = street[0].getAttribute("encodedPolyline");
			  var levels = street[0].getAttribute("encodedLevels");
			  var zoomFactor = parseInt(street[0].getAttribute("zoomFactor"));
			  var numLevels = parseInt(street[0].getAttribute("numLevels"));
 
 
		  	  var encodedPolyline = new GPolyline.fromEncoded({
		    	color: color,
		    	weight: weight,
		    	points: points,
		    	levels: levels,
		    	zoomFactor: zoomFactor,
		    	numLevels: numLevels
			  });
 
			  document.map.addOverlay(encodedPolyline);
 
			  var bounds=encodedPolyline.getBounds();
 
	  	  	  var SouthWest = bounds.getSouthWest();
	          var NorthEast = bounds.getNorthEast();
		      var lat1 = SouthWest.lat();
		      var lng1 = SouthWest.lng();
		      var lat2 = NorthEast.lat();
		      var lng2 = NorthEast.lng();
		  	  var lat = (lat1 + lat2)/2;
		      var lng = (lng1 + lng2)/2;
 
   	          document.map.setCenter(new GLatLng(lat, lng), 14, document.custommap);
	        }
	    }
	    request.send(null);
	}
 
 
	function all_district(mode){
	    var polys = [];
	    var labels = [];
 
		document.map.clearOverlays();
	    document.getElementById("clear_all").style.display="";
 
	    var request = GXmlHttp.create();
	    request.open("GET", "/ajax/get_map_element.php?mode="+mode, true);
	    request.onreadystatechange = function() {
	        if (request.readyState == 4) {
	          var xmlDoc = GXml.parse(request.responseText);
 
	          var districts = xmlDoc.documentElement.getElementsByTagName("points");
 
	          for (var a = 0; a < districts.length; a++) {
	            var name  = districts[a].getAttribute("name");
	            var BorderColor = districts[a].getAttribute("BorderColor");
	            var BorderWeight = districts[a].getAttribute("BorderWeight");
	            var BorderOpacity = districts[a].getAttribute("BorderOpacity");
	            var fillColor = districts[a].getAttribute("fillColor");
	            var fillOpacity = districts[a].getAttribute("fillOpacity");
 
	            // read each point on that line
	            var points = districts[a].getElementsByTagName("point");
	            var pts = [];
	            for (var i = 0; i < points.length; i++) {
	               pts[i] = new GLatLng(parseFloat(points[i].getAttribute("lat")),
	                                    parseFloat(points[i].getAttribute("lng")));
	            }
 
	            var poly = new GPolygon(pts,BorderColor,BorderWeight,BorderOpacity,fillColor,fillOpacity,{clickable:true});
 
	            polys.push(poly);
	            labels.push(name);
 
	            document.map.addOverlay(poly);
	          }
	        }
	      }
	    request.send(null);
	}
 
	function ShowCity(id_city){
 
		document.map.clearOverlays();
	    document.getElementById("clear_all").style.display="";
 
	    var request = GXmlHttp.create();
	    request.open("GET", "/ajax/get_map_element.php?mode=city&id_city="+id_city, true);
	    request.onreadystatechange = function() {
	    	if (request.readyState == 4) {
	        	var xmlDoc = GXml.parse(request.responseText);
 
	          	var city = xmlDoc.documentElement.getElementsByTagName("city");
 
            	var lat = city[0].getAttribute("lat");
            	var lng = city[0].getAttribute("lng");
            	var name = city[0].getAttribute("name");
 
				var html="<h3>"+name+"</h3>";
				html += "Широта: "+lat+"<br>";
				html += "Долгота: "+lng+"";
 
		  		var marker = new GMarker(new GLatLng(lat, lng),{icon: document.InfomirIcon});
		    	document.map.addOverlay(marker);
	        	marker.openInfoWindowHtml(html);
 
              	GEvent.addListener(marker, "click", function() {
	        		marker.openInfoWindowHtml(html);
                });
 
				if (id_city==1) document.map.setCenter(new GLatLng(lat, lng), 16, map.custommap);
				else {
					document.map.setMapType(G_NORMAL_MAP);
					document.map.setCenter(new GLatLng(lat, lng), 11);
					}
	        }
		}
	 	request.send(null);
	}
 
	function ShowCompany(id_company){
		document.map.clearOverlays();
	    document.getElementById("clear_all").style.display="";
 
	    var request = GXmlHttp.create();
	    request.open("GET", "/ajax/get_map_element.php?mode=company&id_company="+id_company, true);
	    request.onreadystatechange = function() {
	    	if (request.readyState == 4) {
	        	var xmlDoc = GXml.parse(request.responseText);
	          	var addresses = xmlDoc.documentElement.getElementsByTagName("address");
				var marker=new Array();
	          	for(var a=0;a<addresses.length;a++){
	          		var company_name = addresses[a].getAttribute("company_name");
            		var lat = addresses[a].getAttribute("lat");

            		var lng = addresses[a].getAttribute("lng");

            		var num = addresses[a].getAttribute("num");

            		var street_name = addresses[a].getAttribute("street_name");

            		var name_neighbourhood = addresses[a].getAttribute("name_neighbourhood");

                    var name_district = addresses[a].getAttribute("name_district");
                    var Hidden_URL = addresses[a].getAttribute("Hidden_URL");

                    var company_logo = addresses[a].getAttribute("company_logo");

                    var company_logo_alt = addresses[a].getAttribute("company_logo_alt");



                    var html="";

					if (company_logo!="") html += "<a href='"+Hidden_URL+"' title='Перейти на страницу "+company_name+"'><img src='/img/company/"+company_logo+"' "+company_logo_alt+"></a>";
                    html += "<h3><a href='"+Hidden_URL+"' title='Перейти на страницу "+company_name+"'>"+company_name+"</a></h3>";
                    if (street_name!="" && num!="") html += street_name+", "+num+"<br>";
                    if (name_district!="" && name_neighbourhood!="") html += "<span style='color:#808080;'>"+name_district+"</span>, <span style='color:#808080;'>"+name_neighbourhood+"</span><br>";
 
		  			marker[a] = new GMarker(new GLatLng(lat, lng),{icon: document.InfomirIcon});
		    		document.map.addOverlay(marker[a]);
	        		marker[a].openInfoWindowHtml(html);
                }
 				if (addresses.length==1){
 					document.map.setCenter(new GLatLng(lat, lng), 16, map.custommap);
 				}
 				else{
 					document.map.setCenter(new GLatLng(lat, lng), 11, map.custommap);
 				}
	        }
		}
	 	request.send(null);
	}
 
 
	function showHous(id_hous){
		document.map.clearOverlays();
	    document.getElementById("clear_all").style.display="";
 
	    var request = GXmlHttp.create();
	    request.open("GET", "/ajax/get_map_element.php?mode=hous&id_hous="+id_hous, true);
	    request.onreadystatechange = function() {
	    	if (request.readyState == 4) {
	        	var xmlDoc = GXml.parse(request.responseText);
 
	          	var houses = xmlDoc.documentElement.getElementsByTagName("hous");
 
            	var lat = houses[0].getAttribute("lat");
            	var lng = houses[0].getAttribute("lng");
            	var num = houses[0].getAttribute("num");
            	var street_name = houses[0].getAttribute("street_name");
            	var name_neighbourhood = houses[0].getAttribute("name_neighbourhood");
            	var name_district = houses[0].getAttribute("name_district");
				var companys = houses[0].getAttribute("companys");
 
				var html="<h3>"+street_name+", "+num+"</h3>";
				html += "<span style='color:#808080;'>"+name_district+", "+name_neighbourhood+"</span><br>"+companys;
 
		  		var marker = new GMarker(new GLatLng(lat, lng),{icon: document.InfomirIcon});
		    	document.map.addOverlay(marker);
	        	marker.openInfoWindowHtml(html);
 
	      	  	document.map.setCenter(new GLatLng(lat, lng), 16, map.custommap);
	        }
		}
	 	request.send(null);
	}
 
	function SendMailError(){
		var map_error_text=document.getElementById("map_error_text").value;
		var nc_captcha_code=document.getElementById("nc_captcha_code").value;
		var nc_captcha_hash=document.getElementById("nc_captcha_hash").value;
 
	    var request = GXmlHttp.create();
	    request.open("GET", "/ajax/get_map_element.php?mode=mail&map_error_text="+encodeURI(map_error_text)+"&nc_captcha_code="+encodeURI(nc_captcha_code)+"&nc_captcha_hash="+encodeURI(nc_captcha_hash), true);
	    request.onreadystatechange = function() {
	    	if (request.readyState == 4) {
	        	var xmlDoc = GXml.parse(request.responseText);
	          	var results = xmlDoc.documentElement.getElementsByTagName("result");
 
				var status=results[0].getAttribute("status");
				var message=results[0].getAttribute("message");
				var extras=results[0].getAttribute("extras");
 
				if (status==0){
					document.getElementById("error_message_id").innerHTML=message;
					document.getElementById("map_error_text").value="";
					document.getElementById("nc_captcha_code").value="";
					document.getElementById("nc_captcha_formfield").innerHTML=extras;
                    changeStateDisplay("error_message");
				}
                if (status==1){
					document.getElementById("error_message_id").innerHTML=message;
                }
                if (status==2){
					document.getElementById("error_message_id").innerHTML=message;
					document.getElementById("nc_captcha_code").value="";
					document.getElementById("nc_captcha_formfield").innerHTML=extras;
                }
			}
		}
	 	request.send(null);
	}
 
	function one_district_neighbourhood(mode){
 
		document.map.clearOverlays();
	    document.getElementById("clear_all").style.display="";
 
	    var polys = [];
	    var labels = [];
 
	    var request = GXmlHttp.create();
	    request.open("GET", "/ajax/get_map_element.php?mode="+mode, true);
	    request.onreadystatechange = function() {
	    	if (request.readyState == 4) {
	        	var xmlDoc = GXml.parse(request.responseText);
 
	          	var districts = xmlDoc.documentElement.getElementsByTagName("points");
 
	          	for (var a = 0; a < districts.length; a++) {
	            	var name  = districts[a].getAttribute("name");
	            	var BorderColor = districts[a].getAttribute("BorderColor");
	            	var BorderWeight = districts[a].getAttribute("BorderWeight");
	            	var BorderOpacity = districts[a].getAttribute("BorderOpacity");
	            	var fillColor = districts[a].getAttribute("fillColor");
	            	var fillOpacity = districts[a].getAttribute("fillOpacity");
 
	            	// read each point on that line
	            	var points = districts[a].getElementsByTagName("point");
	            	var pts = [];
	            	for (var i = 0; i < points.length; i++) {
	               		pts[i] = new GLatLng(parseFloat(points[i].getAttribute("lat")),
	                                    	 parseFloat(points[i].getAttribute("lng")));
	            	}
	           		var poly = new GPolygon(pts,BorderColor,BorderWeight,BorderOpacity,fillColor,fillOpacity,{clickable:true});
 
	            	if(a == 0){
	            		var bounds=poly.getBounds();
	            		var area=poly.getArea()/1000000;
	            		area = area.toFixed(2);
	            	}
 
	            	polys.push(poly);
	            	labels.push(name);
	            	document.map.addOverlay(poly);
	            	a=999;
	          	}
		  	  	SouthWest = bounds.getSouthWest();
	          	NorthEast = bounds.getNorthEast();
		      	lat1 = SouthWest.lat();
		      	lng1 = SouthWest.lng();
		      	lat2 = NorthEast.lat();
		      	lng2 = NorthEast.lng();
		  	  	lat = (lat1 + lat2)/2;
		      	lng = (lng1 + lng2)/2;
 
				var html="<h3>"+name+"</h3><br>Площадь: "+area+" км<sup>2</sup>";
 
				document.map.openInfoWindowHtml(new GLatLng(lat,lng),html);
 
	      	  	document.map.setCenter(new GLatLng(lat, lng), 11, map.custommap);
	        }
		}
	 	request.send(null);
    }
	//]]>
	</script>     		
</head>
<body onload="initialize()" onunload="GUnload()">

<table width="100%" height="100%" cellpadding="0">
<tr>
	<td class="header">
		<!-- HEADER -->
		<table width="100%" height="180" cellpadding="0">
		<tr>
			<td width="270"><a href="<?php echo $this->createUrl('Index', 'Index', null, false); ?>"><img src="<?php echo $this -> image_url;?>logo.png" width="270" height="180" /></a></td>
			<td class="header2" align="right">
				<!-- Блок авторизации -->
				<?php if($this->current_user && ((int)$this->current_user->id > 0)) {?>
					<table width="210" height="125" cellpadding="0">
					<tr>
						<td class="user1"> </td>
						<td class="user2">

							<div class="user2_title">ДОБРО ПОЖАЛОВАТЬ</div>
							<div class="user2_zz">
								<a href="<?php echo $this->createUrl('User', 'Profile', null, $this->current_user->login)?>">Профиль</a><br />
								<a href="<?php echo $this->createUrl('Album', 'List', null, $this->current_user->login)?>">Фотоальбом</a><br />
								<a href="<?php echo $this->createUrl('Subscribe', 'List', null, $this->current_user->login)?>">Подписка</a><br />

								<a href="<?php echo $this->createUrl('Messages', 'Mymessages', null, $this->current_user->login)?>">Сообщения</a><br />
								<!--<a href="#">Сообщения</a>-->
							</div>

							<div align="right" style="padding-top: 7px;">Вы вошли как: <a href="<?php echo $this->createUrl('User', 'Profile', null, $this->current_user->login)?>"><?php echo $this->current_user->login;?></a></div>

						</td>
						<td class="user3"> </td>
						<td width="20"><a href="<?php echo $this->createUrl('User', 'Logout')?>"><img src="<?php echo $this -> image_url;?>exit.png" width="20" height="63" /></a></td>
					</tr>
					</table>
				<?php } else { ?>
					<table width="220" height="125" cellpadding="0">
					<tr>
						<td class="user1"> </td>
						<td class="user2">
							<form action="<?php echo $this->createUrl('User', 'Login')?>" method="POST">
								<input type="hidden" value="<?php echo $this->lastPath; ?>" name="lastPath">
								<div class="user2_title">АВТОРИЗАЦИЯ</div>
								<table align="center" cellpadding="0">
								<tr>
									<td>Логин:</td>
									<td><input type="text" style="width: 130px;" name="login"/></td>
								</tr>
								<tr>
									<td>Пароль:</td>
									<td><input type="password" style="width: 130px;" name="pass"/></td>
								</tr>
								</table>
								<div class="user2_x"><input type="checkbox" id="remember" name="remember" value="1" style="padding: 0px;" /> <label for="remember"></>Запомнить</label> <input type="submit" value="Вход" style="width: 45px;" /></div>
								<div class="user2_x"><a href="<?php echo $this->createUrl('User', 'RemindPassword', false, null);?>">Забыли пароль?</a> | <a href="<?php echo $this->createUrl('User', 'RegistrationForm');?>">Регистрация</a></div>
							</form>
						</td>
						<td class="user3"> </td>
					</tr>
					</table>
				<?php } ?>
				<!-- /Блок авторизации -->

							</td>
			<td width="170">
				<!-- Навигация -->
				<table width="170" height="180" cellpadding="0">
				<tr>
					<td class="menu1"> </td>
					<td class="menu2"> </td>
					<td class="menu3">
						<a href="<?php echo $this->createUrl('News', 'News', null, false); ?>">Новости</a><br />
						<a href="<?php echo $this->createUrl('Article', 'List', null, false); ?>">Статьи</a><br />
						<a href="<?php echo $this->createUrl('SearchUser','SearchUserMain'); ?>">Найти знакомых</a><br />
						<a href="#">Дневники</a><br />
						<a href="<?php echo $this->createUrl('QuestionAnswer', 'List', null, false); ?>">Вопрос-ответ</a><br />
						<a href="<?php echo $this->createUrl('Album', 'LastList', null, false); ?>">Фотоальбомы</a><br />
                        <a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksList', null, false); ?>">Закладки</a><br />
                        <a href="<?php echo $this->createUrl('Social', 'SocialMainList', null, false); ?>">Соц. разделы</a>
					</td>
				</tr>
				</table>
				<!-- /Навигация -->
			</td>
		</tr>
		</table>
		<!-- /HEADER -->
	</td>
</tr>
<tr>
	<td valign="top">
	<!-- ТЕЛО САЙТА -->
	<table width="100%" cellpadding="0">
	<tr>
		<td class="next24">
