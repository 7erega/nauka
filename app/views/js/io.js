function showLinks(event){//показ посилання на щойно завантажений файл
 //console.log('~~~');
	var id = $(this).data('url');//id обєкта на якому відбулась подія
	var datafileId = $('[data-file='+id+']');
	var value = $(this).val();
	if (value != '') 
		datafileId.attr('href', value); 
	else 
		datafileId.attr('href', '#');
 
 if(datafileId.attr('href') == '#') datafileId.hide(); else datafileId.show();

}

function showAllLinks(){//показ посилань на усі завантажені(прикріплені) файли
 var id, value, datafileObj;
	$('.fileurl').each(function(index, element) {
		//value = $(element).attr("value");
		value = $(element).val();
		id = $(element).data('url');
		datafileObj = $('[data-file='+id+']');
		if (value != '') 
			datafileObj.attr('href', value); 
		else 
			datafileObj.attr('href', '#');
 
		if(datafileObj.attr('href') == '#') datafileObj.hide(); else datafileObj.show();
	});
}


function resultSave(event){
	var user = $('[name="userId"]:input').val();//id власника форми
	var value, len, disabled_value = [], dis = {}, globalResult = 0;//загальна сума на поточній формі
	$(".hidden-result").each(function(index, element) {
		value = $(element).attr("value");
		if (value != '') globalResult += parseFloat(value); 
	});
	var input_value = $("form").serializeArray();//зібрані дані з форми
		input_value = JSON.stringify(input_value);
	$(":disabled").each(function(index, element) {//збираємо дані про неактивні інпути та їх значення
		dis = {};
		dis.name = $(element).attr("name");
		dis.value = $(element).attr("value"); 
		len = disabled_value.push(dis);	
	});
	disabled_value = JSON.stringify(disabled_value);//перетворюємо масив обєктів в JSON-рядок
	
//!!!!!!!!!!!!!!!!!!!!!!!
	console.log(globalResult, '----',input_value, '~~~~',disabled_value);

}
