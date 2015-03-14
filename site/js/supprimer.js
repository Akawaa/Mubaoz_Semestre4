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

/* Supprimer */
function supprimerFichier(nom,titre){
    var xhr = newXMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            window.location.reload();
        }
    };
    xhr.open("POST", chemin_supprimer, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("nom="+nom+"&titre="+titre);
}

function suppFichier(nom,titre){
    if(confirm('Voulez-vous vraiment supprimer ce fichier ?')){
        supprimerFichier(nom,titre);
    }
}
