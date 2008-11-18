
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

function RefreshDebateChat(){
    ajax(
        {"url":"\/debate_refresh_chat","type":"POST","async":true,"data":{},"dataType":"json"}, 
        true);
    t=setTimeout("RefreshDebateChat()",10000);
}
RefreshDebateChat();