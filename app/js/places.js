function reload_dropdowns(changed_list){
        ajax(
            {"url":"\/reload_dropdowns","type":"GET","async":true,"data":{'geo_type_id':$("#geo_type").val(), 'country_id':$("#country").val(), 'city_id':$("#city").val(), 'geo_subtype_id':$("#geo_subtype").val(), 'changed_list': changed_list},"dataType":"json"}, 
            false);
}

function AddPlace() {
	if ($("#geo_subtype").val()!=0) {
		return true;
	} else {
		alert('Чтобы добавить место, нужно сначала выбрать его тип.');
		return false;
	}
}

function AddType() {
	if ($("#geo_type").val()!=0) {
		return true;
	} else {
		alert('Чтобы добавить тип места, нужно сначала выбрать его вид.');
		return false;
	}
}


function AddObjToUser() {
	if ($("#geo_place").val()!=0) {
		return true;
	} else {
		alert('Чтобы добавить место в ваш список мест, нужно его сначала выбрать.');
		return false;
	}
}