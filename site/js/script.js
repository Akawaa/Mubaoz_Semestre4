function verifFichier(){

    if((document.getElementById("file").value!="") && (document.getElementById("datepicker2").value!="") && (document.getElementById("datepicker").value!="") && (document.getElementById("register-input").value!="")){
        document.getElementById('bouton').disabled = false;
    }

}

function supprimerFichierCheck(){
    var tabCheck = document.getElementsByClassName("check");
    var tabIdCheck = [];

    for(var i=0;i<tabCheck.length;i++){
        if(tabCheck[i].checked == true){
            tabIdCheck.push(tabCheck[i].id);
        }
    }

    if(confirm('Voulez-vous vraiment supprimer les fichiers?')){
        for(var j=0;j<tabIdCheck.length;j++){
            supprimerFichier(tabIdCheck[j].split("|")[0],tabIdCheck[j].split("|")[1]);
        }
    }

}

function revoquerFichierCheck(){
    var tabCheck = document.getElementsByClassName("check");
    var tabIdCheck = [];

    for(var i=0;i<tabCheck.length;i++){
        if(tabCheck[i].checked == true){
            tabIdCheck.push(tabCheck[i].id);
        }
    }

    if(confirm('Voulez-vous vraiment révoquer les fichiers à la date d\'hier ?')){
        for(var j=0;j<tabIdCheck.length;j++){
            revoquerFichier(tabIdCheck[j].split("|")[0]);
        }
    }
}
