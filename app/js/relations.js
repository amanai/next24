function showRelationForm(){
    $("#relations_form").show();
    $("#change_relation_link").hide();
}

function relationSelect(){
	$("#relation_text").val($("#relation_select_"+$("#relation_select").val()).html());
	//$("#relation_select").show();
}