
function ShowHideComplaint(complaintId){
    if($("#"+complaintId).hasClass('complaintPhoto')){
        $("#"+complaintId).removeClass('complaintPhoto');
    }else{
        $("#"+complaintId).addClass('complaintPhoto');
    }
    
}

function sendArbitration(photoId){
    ajax(
        {"url":"\/get_folder_messages","type":"POST","async":true,"data":{"groupName":groupName, "groupId":groupId, "pageNumber":pageNumber},"dataType":"json"},
        true);
}

