

function ShowMessages(pageNumber, groupId, groupName){
	blockUnblockUI();
    ajax(
        {"url":"\/get_folder_messages","type":"POST","async":true,"data":{"groupName":groupName, "groupId":groupId, "pageNumber":pageNumber},"dataType":"json"},
        true);
    blockUnblockUI();
}
function ShowAllMessages(pageNumber, groupId, groupName){
	blockUnblockUI();
    ajax(
            {"url":"\/get_all_messages","type":"POST","async":true,"data":{"groupName":groupName, "groupId":groupId, "pageNumber":pageNumber},"dataType":"json"},
            true);
    blockUnblockUI();
}

function DelMessage(messageId, current_page, groupId, groupName){
	blockUnblockUI();
    ajax(
        {"url":"\/del_message","type":"POST","async":true,"data":{"messageId":messageId, "groupId":groupId, "current_page":current_page, "pageName":"mymessages"},"dataType":"json"},
        true);
    return true;
    blockUnblockUI();
}

function DelMessageCorrespondence(messageId, corr_user_id){
	blockUnblockUI();
    ajax(
        {"url":"\/del_message","type":"POST","async":true,"data":{"messageId":messageId, "corr_user_id":corr_user_id, "pageName":"correspondent"},"dataType":"json"},
        true);
    return true;
    blockUnblockUI();
}

function messageRecipientChange(element){
    if (element == 1 && $("#recipient").val() != ""){
        $("#recipient_name").val("");
    }else if(element == 2  && $("#recipient_name").val() != ""){
        $("#recipient").val("");
    }
}