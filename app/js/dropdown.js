$(function() { 
if($("div.dropdown")) {	
	$("div.dropdown").hover(
			function () {
				$(".dropdown-active").removeClass("dropdown-active"); 
				$(this).addClass("dropdown-active");
			}, 
			function () {
				$(this).removeClass("dropdown-active");  
			}
	);
}
if($("ul.nav-list")) {
	$("i.arrow-icon").click(function () {
		if($(this).siblings("ul.nav-list").is(":hidden")) {
			$(this).siblings("ul.nav-list").slideDown("slow");
		}
		else {
			$(this).siblings("ul.nav-list").slideUp("slow");
		}
	}); 
}  
if($("div.info-entry")) {
	$("i.arrow-icon").click(function () {
		if($(this).parent().siblings("div.info-entry").is(":hidden")) {
			$(this).parent().siblings("div.info-entry").slideDown("slow");
		}
		else {
			$(this).parent().siblings("div.info-entry").slideUp("slow");
		}
	}); 
}
if($("a.frind-list-dropdown")) {
	$("a.frind-list-dropdown").click(function () {
		if($(this).parent().siblings("dd.friend-list-dd").is(":hidden")) {
			$(this).parent().siblings("dd.friend-list-dd").slideDown("slow");
		}
		else {
			$(this).parent().siblings("dd.friend-list-dd").slideUp("slow");
		}
	}); 	
}

if($("div.widget")) {
	
/*	$("div.widget").resizable({ 
			maxWidth: $("div.widget").parent().width()-12, 
			minWidth: 265, 
			minHeight: 30
	}); */
	$("i.widget-сollapse-icon").parent("span").click(function () {
		if($(this).parent().parent().parent().siblings("div.widget-content").is(':hidden')) {
			$(this).parent().parent().parent().siblings("div.widget-content").slideDown("slow");			
		}
		else {
			widget_height = $(this).parent().parent().parent().siblings("div.widget").height();
			$(this).parent().parent().parent().siblings("div.widget-content").slideUp("slow");
		} 
	}); 
	$("i.widget-add-icon").parent("span").click(function () {
		$(this).parent().parent().parent().siblings("div.widget-tabs").children().append('<li><a href="#">Новая вкладка</a></li>');
	}); 	

	  /**
	   * Default plugin settings
	   *
	   * Here we initialize the plugin default settings, that can be overwrite
	   * when the user call to plugin public methods. In every case we merge this
	   * settings with the user provided, to obtain in any case correct values.
	   *
	   */
/*	  $.fn.EasyWidgets.defaults = {

	    // Behaviour of the plugin
	    behaviour : {

	      // Miliseconds delay between mousedown and drag start
	      dragDelay : 100,

	      // Miliseconds delay between mouseup and drag stop
	      dragRevert : 100,

	      // Determinme the opacity of Widget when start drag
	      dragOpacity : 0.8,

	      // Use cookies to store positions and states
	      useCookies : true
	    },

	    // Some effects that can be apply sometimes
	    effects : {

	      // Miliseconds for effects duration
	      effectDuration : 500,

	      // Can be none, slide or fade
	      widgetShow : 'none',
	      widgetHide : 'none',
	      widgetClose : 'slide',
	      widgetExtend : 'none',
	      widgetCollapse : 'none',
	      widgetOpenEdit : 'none',
	      widgetCloseEdit : 'none',
	      widgetCancelEdit : 'none'
	    },

	    // Only for the optional cookie feature
	    cookies : {

	      // Cookie path
	      path : '',

	      // Cookie domain
	      domain : '',

	      // Cookie expiration time in days
	      expires : 90,

	      // Store a secure cookie?
	      secure : false,

	      // Cookie name for close Widgets
	      closeName : 'ew-close',

	      // Cookie name for enable/disable Widgets
	      disableName : 'ew-disable',

	      // Cookie name for positined Widgets
	      positionName : 'ew-position',

	      // Cookie name for collapsed Widgets
	      collapseName : 'ew-collapse'
	    },

	    // Options name to use in the HTML markup
	    options : {

	      // To recognize a movable Widget
	      movable : 'movable',

	      // To recognize a editable Widget
	      editable : 'editable',

	      // To recognize a collapse Widget
	      collapse : 'collapse',

	      // To recognize a removable Widget
	      removable : 'removable',

	      // To recognize a collapsable Widget
	      collapsable : 'collapsable',

	      // To recognize Widget that require confirmation when remove
	      closeConfirm : 'closeconfirm'
	    },

	    // Callbacks functions
	    callbacks : {

	      // When a Widget is added on demand, send the widget object and place ID
	      onAdd : null,

	      // When a editbox is closed, send the link and the widget objects
	      onEdit : null,

	      // When a Widget is show, send the widget object
	      onShow : null,

	      // When a Widget is hide, send the widget object
	      onHide : null,

	      // When a Widget is closed, send the link and the widget objects
	      onClose : null,

	      // When Widgets are enabled using the appropiate public method
	      onEnable : null,

	      // When a Widget is extend, send the link and the widget objects
	      onExtend : null,

	      // When Widgets are disabled using the appropiate public method
	      onDisable : null,

	      // When a editbox is closed, send a ui object, see jQuery::sortable()
	      onDragStop : null,

	      // When a Widget is collapse, send the link and the widget objects
	      onCollapse : null,

	      // When a Widget is try to added, send the widget object and place ID
	      onAddQuery : null,

	      // When a editbox is try to close, send the link and the widget objects
	      onEditQuery : null,

	      // When a Widget is try to show, send the widget object
	      onShowQuery : null,

	      // When a Widget is try to hide, send the widget object
	      onHideQuery : null,

	      // When a Widget is try to close, send the link and the widget objects
	      onCloseQuery : null,

	      // When a editbox is cancel (close), send the link and the widget objects
	      onCancelEdit : null,

	      // When Widgets are enabled using the appropiate public method
	      onEnableQuery : null,

	      // When a Widget is try to expand, send the link and the widget objects
	      onExtendQuery : null,

	      // When Widgets are disabled using the appropiate public method
	      onDisableQuery : null,

	      // When a Widget is try to expand, send the link and the widget objects
	      onCollapseQuery : null,

	      // When a editbox is try to cancel, send the link and the widget objects
	      onCancelEditQuery : null,

	      // When one Widget is repositioned, send the positions serialization
	      onChangePositions : null,

	      // When Widgets need repositioned, get the serialization positions
	      onRefreshPositions : null
	    },

	    // Selectors in HTML markup. All can be change by you, but not all is
	    // used in the HTML markup. For example, the "editLink" or "closeLink"
	    // is prepared by the plugin for every Widget.
	    selectors : {

	      // Container of a Widget (into another element that use as place)
	      // The container can be "div" or "li", for example. In the first case
	      // use another "div" as place, and a "ul" in the case of "li".
	      container : 'div',

	      // Class identifier for a Widget
	      widget : '.widget',

	      // Class identifier for a Widget place (parents of Widgets)
	      places : '.widget-place',

	      // Class identifier for a Widget header (handle)
	      header : '.widget-header',

	      // Class for the Widget header menu
	      widgetMenu : '.widget-menu',

	      // Class identifier for Widget editboxes
	      editbox : '.widget-editbox',

	      // Class identifier for Widget content
	      content : '.widget-content',

	      // Class identifier for editbox close link or button, for example
	      closeEdit : '.widget-close-editbox',

	      // Class identifier for a Widget edit link
	      editLink : '.widget-editlink',

	      // Class identifier for a Widget close link
	      closeLink : '.widget-closelink',

	      // Class identifier for Widgets placehoders
	      placeHolder : 'widget-placeholder',

	      // Class identifier for a Widget collapse link
	      collapseLink : '.widget-collapselink'
	    },

	    // To be translate the plugin into another languages
	    // But this variables can be used to show images instead
	    // links text, if you preffer. In this case set the HTML
	    // of the IMG elements.
	    i18n : {

	      // Widget edit link text
	      editText : 'Edit',

	      // Widget close link text
	      closeText : 'Close',

	      // Widget extend link text
	      extendText : 'Extend',

	      // Widget collapse link text
	      collapseText : 'Collapse',

	      // Widget cancel edit link text
	      cancelEditText : 'Cancel',

	      // Widget edition link title
	      editTitle : 'Edit this widget',

	      // Widget close link title
	      closeTitle : 'Close this widget',

	      // Widget confirmation dialog message
	      confirmMsg : 'Remove this widget?',

	      // Widget cancel edit link title
	      cancelEditTitle : 'Cancel edition',

	      // Widget extend link title
	      extendTitle : 'Extend this widget',

	      // Widget collapse link title
	      collapseTitle : 'Collapse this widget'
	    }
	  }; */

	$.fn.EasyWidgets();
	$("i.widget-delete-icon").parent("span").click(function () {
		var id = $(this).parent().parent().parent().parent().attr('id');
		$.fn.HideEasyWidget(id);
	}); 	
} 	
});	



function add_theme(fromId){
    var fromElement = document.getElementById(fromId);
    if (fromElement && fromElement.value){
        ajax(
            {"url":"\/debate","type":"POST","async":true,"data":{"theme":fromElement.value, "addTheme":1},"dataType":"json"}, 
            true);
        fromElement.value = "";
        return true;
    }else{
        return false;
    }    
}

function vote_theme(theme_id, subject){
    ajax(
        {"url":"\/debate_vote","type":"POST","async":true,"data":{"theme_id":theme_id, "subject":subject},"dataType":"json"}, 
        true);
    return true;
}

function doStakeSecondUser(){
    var doStakeBtn = document.getElementById('doStakeBtn');
    var stakeAmount = document.getElementById('stake_amount');
    if (doStakeBtn && stakeAmount && stakeAmount.value){
        ajax(
            {"url":"\/debate","type":"POST","async":true,"data":{"stake_amount":stakeAmount.value, "doStake":1},"dataType":"json"}, 
            true);
        stakeAmount.value = "";
        $("#doStakeBtn").hide();
        $("#stake_amount").hide();
        return true;
    }else{
        return false;
    }    
}

function wantBeHelper(helperN){
    var helper1tr = document.getElementById('helper1tr');
    var helper2tr = document.getElementById('helper2tr');
    if (helper1tr && helper2tr){
        var helper = 'helper'+helperN;
        if (helperN == 1){
            ajax({"url":"\/debate","type":"POST","async":true,"data":{"helper1":1},"dataType":"json"}, true);
        }else{
            ajax({"url":"\/debate","type":"POST","async":true,"data":{"helper2":1},"dataType":"json"}, true);
        }
        $("#helper1tr").hide();
        $("#helper2tr").hide();
        return true;
    }else{
        return false;
    }   
}

function doStake(userN){
    var stake_amount = document.getElementById('stake_amount');
    if (stake_amount && stake_amount.value){
        var helper = 'doStake'+userN;
        if (userN == 1){
            ajax({"url":"\/debate","type":"POST","async":true,"data":{"doStake1":1, "stake_amount":stake_amount.value},"dataType":"json"}, true);
        }else{
            ajax({"url":"\/debate","type":"POST","async":true,"data":{"doStake2":1, "stake_amount":stake_amount.value},"dataType":"json"}, true);
        }
        stake_amount.value = "";
        return true;
    }else{
        return false;
    }   
}

function send_message(fromId, toId, isHide){
    var fromElement = document.getElementById(fromId);
    if (fromElement && fromElement.value){
        ajax(
            {"url":"\/debate_chat","type":"POST","async":true,"data":{"areaId":toId,"textValue":fromElement.value},"dataType":"json"}, 
            true);
        fromElement.value = "";
        if (isHide){
            $("#debate_MessageboxForDebateUsers").hide();
        }
        return true;
    }else{
        return false;
    }    
}

function helperSay(elementId, helper_id){
    var formElement = document.getElementById(elementId);
    if (formElement){
        ajax(
            {"url":"\/debate_helper_cansay","type":"POST","async":true,"data":{"elementId":elementId,"helper_id":helper_id},"dataType":"json"}, 
            true);
        $("#"+elementId).hide();
        return true;
    }else{
        return false;
    }    
}

function voteForDebateUser(debate_user_id){
    ajax(
        {"url":"\/debate_vote","type":"POST","async":true,"data":{"debate_user_id":debate_user_id, "subject":"debateUser", "isAjax":1},"dataType":"json"}, 
        true);
    $("#vote_for_user_1").hide();
    $("#vote_for_user_2").hide();
}

function pauseSet(pauseId, userNumber){
    var formElement = document.getElementById(pauseId);
    if (formElement){
        ajax(
            {"url":"\/debate_pause_press","type":"POST","async":true,"data":{"userNumber":userNumber},"dataType":"json"}, 
            true);
        $("#"+pauseId).hide();
    }
}

function RefreshDebate(){
    var currEtap = document.getElementById("currEtap");
    var refreshNow = document.getElementById("refreshNow");
    if (refreshNow && refreshNow.value == 1){
        if (currEtap && currEtap.value == 'GetTheme'){
           var themeElement = document.getElementById("theme");
           if (themeElement && !themeElement.value){
               window.location.reload(true);
           }
        }else{
            window.location.reload(true);
        }
    }
    if (currEtap && currEtap.value == 'Debates'){
        ajax(
            {"url":"\/debate_refresh_chat","type":"POST","async":true,"data":{},"dataType":"json"}, 
            true);
    }
    ajax(
        {"url":"\/debate_etaps_checker","type":"POST","async":true,"data":{},"dataType":"json"}, 
        true);
    t=setTimeout("RefreshDebate()",10000);
}
RefreshDebate();