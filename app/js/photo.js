function ShowHideComplaint(complaintId){
	if($("#"+complaintId).css('display')=='none') {
		$("#"+complaintId).css('display','block');
	}
	else {
		$("#"+complaintId).css('display','none');
	}
}
function sendArbitration(item_id, user_login){
    var complaint_text = "";
    complaint_text += $("#complaint"+item_id).val();
    complaint_text += $("#complaint_text"+item_id).val();
    ajax(
        {"url":"\/add_complaint","type":"POST","async":true,"data":{"item_id":item_id, "complaint_text":complaint_text, "user_login":user_login, "arbitration_group_id":1},"dataType":"json"},
        true
        );
}

