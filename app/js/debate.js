
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

function RefreshDebate(){
    var currEtap = document.getElementById("currEtap");
    var refreshNow = document.getElementById("refreshNow");
    if (refreshNow && refreshNow.value == 1){
        window.location.reload(true);
    }
    if (currEtap && currEtap.value == 'GetTheme'){
        var themeElement = document.getElementById("theme");
        if (themeElement && !themeElement.value){
            t=setTimeout(window.location.reload(true),5000);
        }
    }
    if (currEtap && currEtap.value == 'VoteTheme' || currEtap && currEtap.value == 'ChooseHelpers'){
        t=setTimeout(window.location.reload(true),10000);
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