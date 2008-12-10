//if (!req) var req=new JsHttpRequest();
var tasks=new Array();

function PushTask(task)
	{
	tasks.push(task);
	}
	
function PopTask()
	{
	return tasks.pop();
	}
	
function ClearTasks()
	{
	tasks=new Array();
	}
	
function ReverseTasks()
	{
	tasks.reverse();
	}

function RunTask()
	{
	task=PopTask();
	if (task) setTimeout(task);
	}
	
function GetY(o)
{
	if (o.getBoundingRect) return o.getBoundingRect().top+document.body.scrollTop-2+o.height;
	var r=o.offsetTop+o.offsetHeight;
	while(o=o.offsetParent) 
		{
		if (o.offsetTop) r+=o.offsetTop;
		}
	return r;
}

function GetX(o)
{
	if (o.getBoundingRect) return o.getBoundingRect().left+document.body.scrollLeft-2+o.width;
	var r=o.offsetLeft;
	while(o=o.offsetParent) 
		{
		r+=o.offsetLeft;
		}
	return r;
}

// Посчитать число вкладок
function CountTabs()
{
	var aTabs = $("#top_tabs").find(".tab");
	return aTabs.length;
}

// Закрыть открытые вкладки, если openfirst = true, то открыть первую вкладку
function CloseAllTabs(openfirst)
{
    $("#top_tabs").find(".tab-selected").removeClass("tab-selected");
    $("#page_tabs").find(".tab-page-selected").removeClass("tab-page-selected");
    if (openfirst){
        var sIdTabs = 'tab0';
        $("#top_tabs").find(".tab:first").each(function(){ sIdTabs = this.id; });
        idTabs = sIdTabs.substr(3);
        $("#tab"+idTabs).addClass("tab-selected");
        $("#page"+idTabs).addClass("tab-page-selected");
    }
}

// Открыть заданную вкладку
function ActivateTab(num)
	{
	var tab=document.getElementById('tab'+num);
	var page=document.getElementById('page'+num);
	if (tab&&page)
		{
		CloseAllTabs();
		tab.className='tab tab-selected';
		page.className='tab-page tab-page-selected';
		}
	return false;
	}
	

	
function doCloseTab()
	{
	/*
	if (req.readyState == 4) 
		{
		var num=req.responseJS['tid'];
		if (num!=false)
			{
			var tabs=document.getElementById('tabs');
			var tab=document.getElementById('tab'+num);
			var page=document.getElementById('page'+num);
			if (tabs&&tab&&page&&(CountTabs()>0))
				{
				tabs.removeChild(tab);
				tabs.removeChild(page);
				if (tab.className=='tab tab-selected') CloseAllTabs(1);
				RunTask();
				}
			}
		}
	*/
	}
	
// Удалить заданную вкладку. Если она была активной - открыть первую вкладку.
function DeleteTab(num)
	{
	var tabs=document.getElementById('tabs');
	var tab=document.getElementById('tab'+num);
	var page=document.getElementById('page'+num);
	if (tabs&&tab&&page&&(CountTabs()>0))
		{
		tabs.removeChild(tab);
		tabs.removeChild(page);
		if (tab.className=='tab tab-selected') CloseAllTabs(1);
		}
	return false;
	}
	
// Установить флажки в менеджере вкладок в соответствии с текущим положением дел
function ManagerSetTabs()
	{
	var manager=document.getElementById('tab_manager');
	if (manager)
		{
		for (var i=0;i<manager.childNodes.length;i++) 
			{
			elem=manager.childNodes[i];
			if (elem.nodeType==1&&elem.type=='checkbox')
				{
				index=elem.id.substr(11);
				tab_elem=document.getElementById('tab'+index);
				if (tab_elem) elem.checked=true;
				else elem.checked=false;
				} 
			}
		}
	}
	
// Показать менеджер вкладок
function ShowTabManager(panel)
	{
	var manager=document.getElementById('tab_manager');
	var panel=document.getElementById(panel);
	if (manager&&panel)
		{
		manager.style.visibility='visible';
		manager.style.display='block';
		manager.style.top=GetY(panel)+'px';
		manager.style.left=GetX(panel)+'px';
		ManagerSetTabs();
		}
	}
	
// Спрятать менеджер вкладок
function HideTabManager()
	{
	var manager=document.getElementById('tab_manager');
	if (manager)
		{
		manager.style.visibility='hidden';
		manager.style.display='none';
		}
	}
	
// Вставить вкладку (само действие)
function InsertTab(num, name, content)
	{
	var manager=document.getElementById('tab_manager');
	var tab_elem=document.getElementById('tab'+num);
	var tabs=document.getElementById('tabs');
	if (!tab_elem&&manager)
		{
		var next=false;
		var seek=false;
		for (var i=0;i<manager.childNodes.length;i++) 
			{
			elem=manager.childNodes[i];
			if (elem.nodeType==1&&elem.type=='checkbox')
				{
				index=elem.id.substr(11);
				tab_elem=document.getElementById('tab'+index);
				if (seek&&tab_elem) 
					{
					next=index;
					break;
					}
				if (index==num) seek=true;
				} 
			}
		// Готовим элемент вкладки
		var newTabElem = document.createElement("div");
		newTabElem.className='tab';
		newTabElem.id='tab'+num;
		newTabElem.innerHTML='<a href="#" onClick="return ActivateTab('+num+');">'+name+'</a>';
		newTabElem.innerHTML=newTabElem.innerHTML+'<a href="#" onClick="return UserCloseTab('+num+');"><img src="/images/tabs/w3.png" width="8" height="11"/></a>';
		// Готовим элемент содержимого вкладки
		var newContElem = document.createElement("div");
		newContElem.className='tab-page';
		newContElem.id='page'+num;
		newContElem.innerHTML=content;
		// Есть перед кем вставлять
		if (next)
			{
			// Вставка вкладки
			var nexttab=document.getElementById('tab'+next);
			tabs.insertBefore(newTabElem,nexttab);
			// Вставка страницы
			var page=document.getElementById('page'+next);
			tabs.insertBefore(newContElem,page);
			}
		else // Не перед кем вставлять
			{
			var nexttab=document.getElementById('add');
			tabs.insertBefore(newTabElem,nexttab);
			// Вставка страницы
			var page=document.getElementById('page'+next);
			tabs.appendChild(newContElem);
			}
		
		}
	var ajax_load=document.getElementById('ajax_load');
	tabs.removeChild(ajax_load);
	RunTask();
	}
	
// Добавить новую вкладку (сохранить у юзера)
function AddTab(num)
	{
	var tabs=document.getElementById('tabs');
	var add=document.getElementById('add');
	var tab=document.getElementById('tab'+num);
	if (tabs&&!tab)
		{
		var newTabElem = document.createElement("div");
		newTabElem.id='ajax_load';
		newTabElem.className='tab';
		newTabElem.innerHTML='<img src="/app/images/aload.gif" width="16" height="16" border="0">';
		tabs.insertBefore(newTabElem,add);
		
	    //req.onreadystatechange = doAddTab;
	    //req.open(null, '/ajax.php', true);
		var arr=new Array();
		arr['action']=7;
		arr['tid']=num;
	    //req.send(arr);
		return false;
		}
	}
	
function doAddTab()
	{
	    /*
	if (req.readyState == 4) 
		{
		var num=req.responseJS['tid'];
		var name=req.responseJS['name'];
		var content=req.responseJS['content'];
		InsertTab(num, name, content);
		}
		*/
	}
	
function ManagerSaveTabs()
{
    var checkBoxes = new Array();
    var i = 0;
    $("#tab_manager").find("input:checkbox:checked").each(function(){
        checkBoxes[i] = this.value;
        i++;
    });
    HideTabManager();
    ajax(
        {"url":"\/change_index_tabs","type":"POST","async":true,"data":{"checkBoxes[]":checkBoxes},"dataType":"json"}, 
        true);    
    
}

// Функция для вызова при попытке закрытия вкладки пользователем.
// Сохраняет состояние вкладок пользователя на сервере
function UserCloseTab(num)
{
	var tabs=document.getElementById('tabs');
	var tab=document.getElementById('tab'+num);
	var page=document.getElementById('page'+num);
	if (tabs&&tab&&page&&(CountTabs()>1))
	{
		tab.innerHTML='<img src="/app/images/aload.gif" width="16" height="16" align="top" style="margin-right: 4px;" border="0">'+tab.innerHTML;
		aTabsId = getAllActiveTabsId(num);
	    ajax(
        {"url":"\/change_index_tabs","type":"POST","async":true,"data":{"checkBoxes[]":aTabsId, "addTheme":1},"dataType":"json"}, 
        true);
        
		return false;
	}
}

function SortTabs()
{
	aTabsId = getAllActiveTabsId(-1);
    ajax(
    {"url":"\/change_index_tabs","type":"POST","async":true,"data":{"checkBoxes[]":aTabsId, "addTheme":1},"dataType":"json"}, 
    true);
	return false;
}

function getAllActiveTabsId(idExeption){
    var aTabs = $("#top_tabs").find(".tab");
    var aTabsId = new Array();
    var j = 0, s="";
    for (var i=0; i<aTabs.length; i++){
        id = aTabs[i].id.substr(3);
        if (id != idExeption){
            aTabsId[j] = id;
            //s += id+'; ';
            j++;
        }        
    }
    //alert(s);
    return aTabsId;
}
	
function TabOver(tab)
	{
	if (tab.className=='tab') tab.className='tab-over tab';
	}
	
function TabOut(tab)
	{
	if (tab.className=='tab-over tab') tab.className='tab';
	}

	

