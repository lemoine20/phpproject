function popup(){
    var sql;
    var response = confirm("Atention vous allez supprimer la ligne. Voulez vous continuer?");
    if (response==true){
        sql="1";
        alert("texte supprimé");
    }else{
        sql="0";
    }
}
