/////////////////////////////////////////////////////////////
/////                      UPLOAD                     ///////
/////////////////////////////////////////////////////////////
function setFiltrAccept(event){
	var id = $(this).data('id');
	var patterntype = $('[data-id='+id+']').filter(".filetype").val();
	patterntype = patterntype.replace(/\s+/g, '');
	var ExtArr = patterntype.split(',');
	patterntype = "." + ExtArr.join(',.');
	$(this).attr('accept', patterntype);//встановлюємо фільтр за типами файлів
}

function checkFile(event) {//перевірка типу та розміру файлу
	var id = $(this).data('id');
	var groupObj = $('[data-id='+id+']');
	var fileObj = groupObj.filter(".myfile");
	var statusObj = groupObj.filter(".status");
	var maxfilesize = groupObj.filter(".maxfilesize").val();	
	var patterntype = groupObj.filter(".filetype").val();
	var err = false;
	if(!validateSize(this,maxfilesize)){
		err = true;
	statusObj.html('<span style="color: red">Розмір файлу перевищує '+maxfilesize+' MB</span>');
        }
	if(!validateType(this,patterntype)){
	err = true;
	statusObj.html('<span style="color: red">Некоректний тип файлу!</span>');
        }
		if (err){
			fileObj.val('');
			setTimeout(function(){
	        statusObj.empty();
			},3000);
		}
	statusObj.html('<span style="color: black">'+fileObj.val()+'</span>');	
}

function attachmentFile(event){
	var user = $('[name="userId"]:input').val();
	var id = $(this).data('id');//id обєкта на якому відбулась подія
	var groupObj = $('[data-id='+id+']');
	var fileObj = groupObj.filter(".myfile");
	var statusObj = groupObj.filter(".status");
	var progressObj = groupObj.filter(".pBar");
	var maxfilesize = groupObj.filter(".maxfilesize").val();
	//alert(maxfilesize);
	//var datafileId = $('[data-file='+id+']');
	var urlfileObj = $('[data-url='+id+']');
	if(fileObj.val() == ''){
		statusObj.html('<span style="color: red">Виберіть файл!</span>');
				setTimeout(function(){
	        statusObj.empty();
		},3000);
	return false;
	}
	progressObj.show();
	//console.log("done", id);
	$(".myfile").upload("upload/xhr2.php",{
		name: "myfile",
		userId: user,
		path: "upload/files"
	},
	function(success){
		var result_json = success;
		var result_txt;
		if (!result_json.error){ 
			result_txt = "Файл додано!";
			//datafileId.attr('href', result_json.data);
			urlfileObj.val(result_json.data).change();//запис url в приховане поле
			statusObj.html('<span style="color: green">'+result_txt+'</span>');
		}
		else {
			result_txt = result_json.error;
			//datafileId.attr('href', '#');
			urlfileObj.val('').change();//запис порожнього url в приховане поле
			statusObj.html('<span style="color: red">'+result_txt+'</span>');
		}
		//if(datafileId.attr('href') == '#') datafileId.hide(); else datafileId.show();
		progressObj.hide();
		//console.log("done", result_txt);
		fileObj.val('');
		setTimeout(function(){
	        statusObj.empty();
		},3000);
	return false;	
	},
	function(prog,value){
		progressObj.val(value);
	})
}

//////////////////////////////////////////////////////////////////////////
function validateSize(fileInput,size) {
    var fileObj, oSize;
    if ( typeof ActiveXObject == "function" ) { // IE
        fileObj = (new ActiveXObject("Scripting.FileSystemObject")).getFile(fileInput.value);
    }else {
        fileObj = fileInput.files[0];
    }
 
    oSize = fileObj.size; // Size returned in bytes.
    if(oSize > size * 1024 * 1024){
        return false
    }
    return true;
}
////////////////////////////////////////////////////////////////////////////
function validateType(fileInput,ext_str) {
    var fileObj, oName,myExt;
	var oNameArr = {};
	var oExtArr = {};
    if ( typeof ActiveXObject == "function" ) { // IE
        fileObj = (new ActiveXObject("Scripting.FileSystemObject")).getFile(fileInput.value);
    }else {
        fileObj = fileInput.files[0];
    }
    oName = fileObj.name;
	oNameArr = oName.split('.');
	myExt = oNameArr[oNameArr.length - 1];
	ext_str = ext_str.replace(/\s+/g, '');
	oExtArr = ext_str.split(',');
	var indexPos = oExtArr.indexOf(myExt);
    if(indexPos == -1){
        return false
    }
    return true;
}	