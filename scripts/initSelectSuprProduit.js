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


var xhr = getXMLHttpRequest();

xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {

        document.getElementById("rowSuppression").innerHTML = xhr.responseText;

    }

};

xhr.open("POST", "controleur/initSelectSuprProduit.php", true);
xhr.send(null);


});