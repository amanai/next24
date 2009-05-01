

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
    var stakeAmountDone = document.getElementById('stakeAmount');
    if (doStakeBtn && stakeAmount && stakeAmount.value){
        ajax(
            {"url":"\/debate","type":"POST","async":true,"data":{"stake_amount":stakeAmount.value, "doStake":1},"dataType":"json"}, 
            true);
        stakeAmount.value = "";
        stakeAmountDone.value = stakeAmount.value;
      //  $("#doStakeBtn").hide();
      //  $("#stake_amount").hide();
        $("#stake_btn").html('<th></th><td class="vl"><div class="status"><span class="st-ok"><i class="big-icon ok-icon"></i>Ставка сделана!</span></div></td>');
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