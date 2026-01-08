$(document).ready(function() {

	function getXMLHttpRequest() {
		var xhr = null;
		
		if (window.XMLHttpRequest || window.ActiveXObject) {
			if (window.ActiveXObject) {
			   try {
					xhr = new ActiveXObject("Msxml2.XMLHTTP");
				} catch(e) {
					xhr = new ActiveXObject("Microsoft.XMLHTTP");
				}
			} else {
				xhr = new XMLHttpRequest(); 
			}
		} else {
			alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
			return null;
		}

		return xhr;
	}

	function afficheErreurCnx() {
		var xhr = getXMLHttpRequest();

		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				document.getElementById("erreurCnx").innerHTML = xhr.responseText;
				return false;
			}
		};

		xhr.open("POST", "controleur/traitementFormConnexion.php", true);
		xhr.send(null);
	}

    document.getElementById("btnConnexion").addEventListener("submit",afficheErreurCnx,false);
});