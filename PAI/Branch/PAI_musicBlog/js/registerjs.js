<!--
function SprawdzWymaganePola()
{
	var login 	= document.Rejestracja.login.value;
	var pass 	= document.Rejestracja.pass.value; 
	var repass 	= document.Rejestracja.repass.value;
	var	mail	= document.Rejestracja.mail.value;

	if(login != '') {
		document.getElementById('lo').src = 'images/valid.png';
	}
	else {
		document.getElementById('lo').src = 'images/error.png'; 
	}

	if((pass == repass) && (pass != '') && (repass != '')) 
	{
		document.getElementById('np').src 	= 'images/valid.png';	
		document.getElementById('rp').src 	= 'images/valid.png';
	}
	else 
	{
		document.getElementById('np').src 	= 'images/error.png';	
		document.getElementById('rp').src 	= 'images/error.png';
	}
	
	if(mail != '') {
		document.getElementById('ma').src = 'images/valid.png'; 
	}
	else {
		document.getElementById('ma').src = 'images/error.png'; 
	}
}

function SprawdzWymaganePolaPrzyEdycji()
{
	var mail 	= document.EdycjaDanych.mail.value;
	var oldpass = document.EdycjaDanych.oldPass.value;
	var pass    = document.EdycjaDanych.pass.value;
	var repass  = document.EdycjaDanych.repass.value;

	if(mail != '') {
		document.getElementById('ma').src = 'images/valid.png'; 
	}
	else {
		document.getElementById('ma').src = 'images/error.png'; 
	}
	
	if(oldpass != '') {
		document.getElementById('op').src = 'images/valid.png';
	}
	else {
		document.getElementById('op').src = 'images/error.png';
	}
	
	if((pass == repass) && (pass != '') && (repass != '')) 
	{
		document.getElementById('np').src 	= 'images/valid.png';	
		document.getElementById('rn').src 	= 'images/valid.png';
	}
	else 
	{
		document.getElementById('np').src 	= 'images/error.png';	
		document.getElementById('rn').src 	= 'images/error.png';
	}
}
-->