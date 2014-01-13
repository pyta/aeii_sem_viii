<!--
var State = 0;


function ShowMessageForm(aim)
{
	if(ObiektXMLHttp) {
		var cel = document.getElementById(aim);
		if(State == 0) {
			ObiektXMLHttp.open("GET", "functions/show_message_form.php");
			State = 1;
		} else if(State == 1) {
			ObiektXMLHttp.open("GET", "functions/show_nothing.php");
			State = 0;
		}
		ObiektXMLHttp.onreadystatechange = function() {
			if (ObiektXMLHttp.readyState == 4) {
				cel.innerHTML = ObiektXMLHttp.responseText;
			}
		}
		ObiektXMLHttp.send(null); 
	}
}

-->