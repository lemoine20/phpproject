function popup(){
    var sql;
    var response = confirm("Atention vous allez supprimer la ligne. Voulez vous continuer?");
    if (response==true){
        sql="DELETE FROM `parametre`, `cambrures` WHERE `id` = .id_recover2";
        alert("texte supprimé");
    }else{
        sql="0";
    }
}
