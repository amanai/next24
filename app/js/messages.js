

function ShowMessages(pageNumber, groupId, groupName){
    ajax(
        {"url":"\/get_folder_messages","type":"POST","async":true,"data":{"toElement":"cmod_messages", "groupName":groupName, "groupId":groupId, "pageNumber":pageNumber},"dataType":"json"},
        true);
}

function DelMessage(messageId, pageNumber, groupId, groupName){
    ajax(
        {"url":"\/del_message","type":"POST","async":true,"data":{"toElement":"cmod_messages", "messageId":messageId, "groupId":groupId, "pageNumber":pageNumber},"dataType":"json"},
        true);
    return true;
}