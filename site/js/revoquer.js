/* Instanciation XMLHttpRequest */
function newXMLHttpRequest() {
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

/* Revoque */
function revoquerFichier(titre){
    var xhr = newXMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            window.location.reload();
        }
    };
    xhr.open("POST", chemin_revoquer, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("titre="+titre);
}

function revoqFichier(titre){
    if(confirm('Voulez-vous vraiment révoquer ce fichier à la date d\'hier ?')){
        revoqFichier(titre);
    }
}