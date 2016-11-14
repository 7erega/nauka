$(document).ready(function(){
//-----------------------------
$("#div-content :checkbox").each(function(index, element) {
	if(!!!$(element).attr("value")){
  	$(element).prop('disabled', true);
  }
});
//-------------- Калькулятор ----------------------------------
$("#div-content").on("keyup", "input:text", getEquation);//calculator.js
$("#div-content").on("change", "input:text, input:radio, input:checkbox, select, textarea", getEquation);//calculator.js
//$("#div-content").on("keyup change", ":text, :radio, :checkbox", getEquation);//calculator.js

//---------------Вивантажувач файлів---------------------------
$('.myfile').on("click", setFiltrAccept);//upload.js
$('.myfile').change(checkFile);//upload.js
$(".upload").on("click", attachmentFile);//upload.js
//---------------Автоматичне збереження даних-------------------
$(".hidden-result").on("change", resultSave);//io.js КОЛИ ВІДБУЛАСЯ ЗМІНА ЗНАЧЕНЬ ЗА ФОРМУЛОЮ
$(".fileurl").on("change", resultSave);//КОЛИ ЗАВАНТАЖЕНО ФАЙЛ
//----------Показ кнопок з лінками до перегляду картинок--------
$(".fileurl").on("change", showLinks);//io.js ПОКАЗ КНОПОК з посиланнями на графічні файли
//$(".fileurl").on("change", showAllLinks);//Показ усіх кнопок з лінками до перегляду картинок

});