function parsemul(line) {
var k=1;
do {
var lastz=line.lastIndexOf("*");
if (lastz==-1) {k=0;} else {
var z=lastz;
do {
beforez=z-1;
if (line.charAt(beforez)=="*"|line.charAt(beforez)=="/"|line.charAt(beforez)=="-"|line.charAt(beforez)=="+") {z=-2;}
z=z-1;
} while (z>-2)
if (beforez==-2) {op1=line.slice(0,lastz);} else {op1=line.slice(beforez+1,lastz);}
//here we have operand 1
var z=lastz;
do {
afterz=z+1;
if (line.charAt(afterz)=="*"|line.charAt(afterz)=="/"|line.charAt(afterz)=="-"|line.charAt(afterz)=="+") {z=line.length+1;}
z=z+1;
} while (z<line.length+1)
if (afterz>line.length) {op2=line.slice(lastz+1,line.length);} else {op2=line.slice(lastz+1,afterz);}
//and here operand 2
res=parseFloat(op1)*parseFloat(op2);
line=line.substr(0,beforez+1)+res.toString()+line.substr(afterz);
//now we have new line
}} while (k==1)
return (line);
}

function parseadd(line) {
do {
before=1;
if (line.charAt(0)=="-") {before=-1; line=line.slice(1);}
kx=line.indexOf("+");
ky=line.indexOf("-");
if (kx==-1&&ky==-1) {line=(before*parseFloat(line)).toString();break} else {
//
if ((kx>0&&kx<ky)|(kx>0&&ky==-1)) {lastz=kx; attr=1;}
if ((ky>0&&ky<kx)|(ky>0&&kx==-1)) {lastz=ky; attr=-1;}
op1=before*parseFloat(line.slice(0,lastz));
///
arg=lastz+1;
do {
if (line.charAt(arg)=="+" | line.charAt(arg)=="-") {break}
arg=arg+1;
} while (!(arg==line.length))
op2=attr*parseFloat(line.slice(lastz+1,arg));
///
res=op1+op2;
line=res.toString()+line.slice(arg);
//
}
} while (1==1)
return line;
}

function parseeval(line){
////////////////////////////////////////////
//  http://habrahabr.ru/sandbox/20893/  ////
////////////////////////////////////////////
var k=1;
do {
var openskoba=line.lastIndexOf("(");
if (openskoba<0) {k=0;} else {
var closeskoba=line.indexOf(")",openskoba);
var inside = line.slice(openskoba+1,closeskoba);
var changed=parseadd((parsemul(inside)));
line=line.substr(0,openskoba)+changed.toString()+line.substr(closeskoba+1);
}
} while (k==1)
return line;
}

/////////////////////////////////////////////////
//  аналізатор даних + виконавець обрахунків   //
/////////////////////////////////////////////////
function getEquation(event){
	var id = $(this).data('id');//id обєкта на якому відбулась подія
	var typeobj=$(this).attr('type');   //визначаємо тип обєкту
//!!!!!через незнання jquery втілив функціонал підрахунку суми групи відмічених чекбоксів
  if (typeobj=="checkbox"){ 
	var idch = $(this).data('checkbox');
	var sum = 0;
	$('[data-checkbox='+idch+']:checkbox:checked').each(function(index, element) {
		sum += parseFloat($(element).attr("value")); 
  });
		$('[data-checkbox-result='+idch+']').val(sum);
  }
//!!!!!  
  //---------------аналізатор формул-----------------------------------
  var nameEquation= '[data-equation='+id+']';
  var equVal=$(nameEquation).val().replace(",",".");//отримуємо формулу у форматі string
 // $( "#w0" ).text('формула: '+equVal);
  var myreg = /[\+\-\*\/]/g;//пошук знаків арифметичних операцій (+-*/)
  var myreg1 = /[()]/g;//пошук круглих дужок
  var strEqu=equVal.replace(myreg,"|");//знайдене вилучаємо заміною на розділювач |
  strEqu=strEqu.replace(myreg1,"");//вилучаємо круглі дужки
  var arrOperand=strEqu.split("|");//утворюємо масив операндів
  arrOperand=$.unique(arrOperand);//залишаємо унікальні(без повторень) елементи
  var nameObj;
  var valueobj;
  var objInput;
  var keyArr;
  var arrValue = {};
  for (var i = 0; i < arrOperand.length; i++){
	nameObj = "[name='"+arrOperand[i]+"']";
   if ($("input").is(nameObj)){//перевірка існування обєкту з іменем
	objInput=$("input"+nameObj);//отримуємо обєкт input
	typeobj=objInput.attr('type');   //визначаємо тип обєкту
	//якщо обєктом є радіобаттон то вибираємо відмічений(і):
	if (typeobj=="radio")
		objInput=$("input"+nameObj+":checked");
	valueobj="";
  //якщо змінна визначена то отримуємо значення з поточного поля 
  if(!!objInput.val()) valueobj=objInput.val().replace(",",".");
    keyArr=arrOperand[i];//імя поля стає ключом масиву значень
  if(valueobj.replace(/\s+/g, '').length){//чи містить поле дані(значення)
  	arrValue[keyArr]=valueobj;
  } else arrValue[keyArr] = 'empty';
  
   }//if перевірка існування обєкту
}//for
	//console.log(arrValue);
  //формуємо рядок та масив для заміни змінних у формулі їх значеннями
	var restoreStr=equVal.replace(/[\+\-\*\/()]/g,"|$&|");
	var restoreArr=restoreStr.split("|");
	//видаляємо з масиву невизначені елементи: 
	restoreArr=restoreArr.filter(function(e){return e});
	//замінюємо змінні їх значенями
	for (var i = 0; i < restoreArr.length; i++){
		if(!!arrValue[restoreArr[i]])//якщо такий елемент існує
			restoreArr[i]=arrValue[restoreArr[i]];
	}
	var resultStr = false;
	if(restoreArr.indexOf("empty")==-1){//якщо всі значення передані
		resultStr=restoreArr.join('');//масив перетворюємо в строку
	}
	var oldResult =  $('[data-result='+id+']').val();
  var ReSuLt;
	if (resultStr){//якщо вираз отримав усі значення то виконуємо підрахунки за формулою
		 ReSuLt=parseadd(parsemul(parseeval(resultStr)));
	} else ReSuLt="";
if (ReSuLt != oldResult){
	$('[data-view='+id+']').text(ReSuLt);
	$('[data-result='+id+']').val(ReSuLt).change();
  //.change() - для спрацьовування події при зміні значення цього поля
  }
}//function getEquation


