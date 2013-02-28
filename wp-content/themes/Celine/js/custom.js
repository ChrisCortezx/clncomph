// JavaScript Document
var formName = "formprodfinder";
/*function ajaxUpdater(container, actionFile, action, extra, flag) {

    var d = new Date();
    var timex = d.getTime();

    //var formParams = Form.serialize(formName);
    var params = 'flag=' + flag + '&extra=' + extra + '&action=' + action + '&nocaching=' + timex;
	
    var myAjax = new Ajax.Updater(
                {success: container},
                actionFile,
                {
                  method: 'post',
                  parameters: params,
                  evalScripts: true
                });
}*/
function ajaxRequest(file,action,div,id) {
  new Ajax.Request(file, {
              method: 'post',
              parameters: { action:action, id:id },
              onSuccess: function(transport) { Element.update(div,transport.responseText); }
           });   
}
function radioBtnValue(formname,radioname) {
  return typeValue = Form.getInputs(formname,'radio',radioname).find(function(radio) { return radio.checked; }).value;
}
function getAllProduct(id) {
  ajaxRequest("productfinder.php","getall","div"+id,id);
}
function showHideLink(id) {
  var divcon = $('div'+id);
  if (divcon.style.display == "none") {
    divcon.style.display = "block";
  } else {
    divcon.style.display = "none"; 
  }
}

function getPerProduct(catid,appid,stid) {
  //set value of hiddenflag to 1
  $('hdflag'+catid).value = 1;
  var newid = catid+','+appid+','+stid;
  ajaxRequest("productfinder.php","perprod","div"+catid,newid);
}
function showHide(id) {
  Element.hide('divrobot');
  Element.show('divcontent');
  var hdf = $('hdflag'+id).value;
  
  document.getElementById('p-btn').style.display = 'block';
  
  //alert(hdf);
  switch(id) {
    case 1:
      Element.show('div'+id);
      Element.hide('div2'); Element.hide('div3'); Element.hide('div4'); Element.hide('div5'); Element.hide('div6'); Element.hide('div7');
	  
      break;
    case 2:
      Element.show('div'+id);
      Element.hide('div1'); Element.hide('div3'); Element.hide('div4'); Element.hide('div5'); Element.hide('div6'); Element.hide('div7');
      break;
    case 3:
      Element.show('div'+id);
      Element.hide('div1'); Element.hide('div2'); Element.hide('div4'); Element.hide('div5'); Element.hide('div6'); Element.hide('div7');
      break;
    case 4:
      Element.show('div'+id);
      Element.hide('div1'); Element.hide('div2'); Element.hide('div3'); Element.hide('div5'); Element.hide('div6'); Element.hide('div7');
      break;
    case 4:
      Element.show('div'+id);
      Element.hide('div1'); Element.hide('div2'); Element.hide('div3'); Element.hide('div5'); Element.hide('div6'); Element.hide('div7');
      break;
    case 5:
      Element.show('div'+id);
      Element.hide('div1'); Element.hide('div2'); Element.hide('div3'); Element.hide('div4'); Element.hide('div6'); Element.hide('div7');
      break;
    case 6:
      Element.show('div'+id);
      Element.hide('div1'); Element.hide('div2'); Element.hide('div3'); Element.hide('div4'); Element.hide('div5'); Element.hide('div7');
      break;
	case 7:
      Element.show('div'+id);
      Element.hide('div1'); Element.hide('div2'); Element.hide('div3'); Element.hide('div4'); Element.hide('div5'); Element.hide('div6');
      break;
  }
  if (hdf == 0) {
	getAllProduct(id);
  }
}
function checkRadio(frmName, rbGroupName) {
 var radios = document[frmName].elements[rbGroupName];
 for (var i=0; i <radios.length; i++) {
  if (radios[i].checked) {
   return true;
  }
 }
 return false;
} 
function validateRegistration() {
  var stype = checkRadio('formregistration','stype');
  var lstlye = checkRadio('formregistration','lifestyle');
  if ($("name").value == "") {
    alert("Please input Name");
    $("name").focus();
    return false;
  }
  if ($("mname").value == "") {
    alert("Please input Middle Name");
    $("mname").focus();
    return false;
  }
  if ($("surname").value == "") {
    alert("Please input Surname");
    $("surname").focus();
    return false;
  }
  if ($("age").value == "") {
    alert("Please select Age");
    $("age").focus();
    return false;
  }
  if (!stype) {
    alert("Please select benefit");
    return false;
  }
  if (!lstlye) {
    alert("Please select Lifestyle");
    return false;
  }
  
  return true;
}
function popupwin(url,wn,w,h)
{

   var leftpos = 0;
	 var toppos = 0;
	 
	 if (screen)
	 {
	    leftpos = (screen.width/2) - (w/2);
		  toppos = (screen.height/2) - (h/2);
	 }
	 
	 OpenWin = this.open(url,wn,"toolbar=no,menubar=no,location=no,scrollbars=yes,resizable=0,width="+ w +",height="+ h +",left="+ leftpos +",top="+ toppos).focus();
	 
	 /*if (window.focus) {
     OpenWin.focus()
   }*/
}
function alpha(e) {
  var k;
  document.all ? k = e.keyCode : k = e.which;
  return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8);
}