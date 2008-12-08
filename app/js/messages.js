

function ShowMessages(pageNumber, groupId, groupName){
    ajax(
        {"url":"\/get_folder_messages","type":"POST","async":true,"data":{"groupName":groupName, "groupId":groupId, "pageNumber":pageNumber},"dataType":"json"},
        true);
}

function DelMessage(messageId, current_page, groupId, groupName){
    ajax(
        {"url":"\/del_message","type":"POST","async":true,"data":{"messageId":messageId, "groupId":groupId, "current_page":current_page, "pageName":"mymessages"},"dataType":"json"},
        true);
    return true;
}

function DelMessageCorrespondence(messageId, corr_user_id){
    ajax(
        {"url":"\/del_message","type":"POST","async":true,"data":{"messageId":messageId, "corr_user_id":corr_user_id, "pageName":"correspondent"},"dataType":"json"},
        true);
    return true;
}

function messageRecipientChange(element){
    if (element == 1 && $("#recipient").val() != ""){
        $("#recipient_name").val("");
    }else if(element == 2  && $("#recipient_name").val() != ""){
        $("#recipient").val("");
    }
}