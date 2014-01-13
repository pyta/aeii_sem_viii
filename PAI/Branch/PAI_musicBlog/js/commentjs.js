// ***** Zmienne globalne

var News 	= new Array(); 			// kolekcja commentsMajstrow
var Activ 	= true;					// Zmienna okreœlaj¹ca czy formularz dodawania komentarzy jest widoczny

// ***** Zmienne globalne koniec

// jakaœ kosmetyka
if (window.XMLHttpRequest) {
	ObiektXMLHttp = new XMLHttpRequest();
}
else if (window.ActiveXObject) {
	ObiektXMLHttp = new ActiveXObject("Microsoft.XMLHTTP");
}

// ************************************************* KLASA DO KOMENTARZY - START
function CommentMajster(id)
{
	this.AddCommentState = true;
	this.ShowCommentState = true;
	this.NewsId = id;
}

CommentMajster.prototype.GetNewsId = function() {return this.NewsId;}
CommentMajster.prototype.ShowCommentForm = function(aim)
{
	if(ObiektXMLHttp) {
		var cel = document.getElementById(aim);
		if(this.AddCommentState) {
			this.AddCommentState = false;
			ObiektXMLHttp.open("GET", "functions/show_comment_form.php");
		} else {
			this.AddCommentState = true;
			ObiektXMLHttp.open("GET", "functions/show_nothing.php");
		}

		ObiektXMLHttp.onreadystatechange = function() {
			if (ObiektXMLHttp.readyState == 4) {
				cel.innerHTML = ObiektXMLHttp.responseText;
			}
		}
		ObiektXMLHttp.send(null); 
	}
}

function AddToArray(id) {
	var obj = new CommentMajster(id);
	News.push(obj);
}

function ShowDynamicForm(id) {
	for(var i = 0; i < News.length; ++i)
		if(News[i].GetNewsId() == id) News[i].ShowCommentForm(id);
}

// ************************************************* KLASA DO KOMENTARZY - KONIEC

/* Funkcja wyœwietlaj¹ca formularz komentarzy. Skromne uporoszczenie CommentMajstra. U¿yteczna gdy widoczny jest tylko jeden wpis */
function ShowCommentsForm(aim)
{
	if(ObiektXMLHttp) {
		var cel = document.getElementById(aim);
		if(Activ) {
			Activ = false;
			ObiektXMLHttp.open("GET", "functions/show_comment_form.php");
		} else {
			Activ = true;
			ObiektXMLHttp.open("GET", "functions/show_nothing.php");
		}

		ObiektXMLHttp.onreadystatechange = function() {
			if (ObiektXMLHttp.readyState == 4) {
				cel.innerHTML = ObiektXMLHttp.responseText;
			}
		}
		ObiektXMLHttp.send(null); 
	}
}

function ShowForm(aim, what)
{
	if(ObiektXMLHttp) {
		var cel = document.getElementById(aim);
		if(Activ) {
			Activ = false;
			ObiektXMLHttp.open("GET", what);
		} else {
			Activ = true;
			ObiektXMLHttp.open("GET", "functions/show_nothing.php");
		}

		ObiektXMLHttp.onreadystatechange = function() {
			if (ObiektXMLHttp.readyState == 4) {
				cel.innerHTML = ObiektXMLHttp.responseText;
			}
		}
		ObiektXMLHttp.send(null); 
	}
}

function HideTheCommentButton()
{
	var element = document.getElementById('ShowCommentsButton');
	element.style.visibility = "hidden";
}

function ShowFilmsDiv(ID, LINK)
{
	var id = 'Films' + ID;
	var iframeid = 'Frame' + ID;
	//if((document.getElementById(iframeid).src) == "/END") {
	document.getElementById(iframeid).src = LINK;
	//}
	document.getElementById(id).style.visibility = "visible";
}

function HideFilmsDiv(ID)
{
	var id = 'Films' + ID;
	var iframeid = 'Frame' + ID;
	document.getElementById(iframeid).src = "/END";
	document.getElementById(id).style.visibility = "hidden";
}

function ShowQuickMessageDiv(ID)
{
	document.SendQuickMessage.recipientId.value = ID;
	document.getElementById('QuickMessage').style.visibility = "visible";
}

function HideQuickMessageDiv()
{
	document.getElementById('QuickMessage').style.visibility = "hidden";
}

function HideCommentButton(ID)
{
	var Name = 'ShowCommentsButton' + ID;
	document.getElementById(Name).style.height = 0;
	document.getElementById(Name).style.visibility = "hidden";
	
}