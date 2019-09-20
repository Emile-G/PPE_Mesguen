<?php
/**
 *  Bibliotheque de fonctions AccesDonnees.php  V1.41 Samedi 13 Avril 2019
 *
 *
 *
 * @author Erwan
 * @copyright Estran
 * @version 1.41 Samedi 13 Avril 2019
 *
 * Ajout des commentaires
 * Ajout des fonctions :
 *    AfficheRequete 
 *
 */

/////////VARIABLES DE CONFIGURATION DE L'ACCES AUX DONNEES ////////////////////

// nom du moteur d'acces a la base : mysql - mysqli 
$modeacces = "mysqli";

///////////////////////////////////////////////////////////////////////////////
$mysql_data_type_hash = array(
    1=>'tinyint',
    2=>'smallint',
    3=>'int',
    4=>'float',
    5=>'double',
    7=>'timestamp',
    8=>'bigint',
    9=>'mediumint',
    10=>'date',
    11=>'time',
    12=>'datetime',
    13=>'year',
    16=>'bit',
    //252 is currently mapped to all text and blob types (MySQL 5.0.51a)
    252=>'blob',
    253=>'string',
    254=>'string',
    246=>'decimal'
);

/**
 *
 * Ouvre une connexion a un serveur de base de donnees et selectionne une base.
 *
 * @param string $host Adresse du serveur.
 * @param integer $port Numero du port du serveur.
 * @param string $dbname Nom de la base de donnees.
 * @param string $user Nom de l'utilisateur.
 * @param string $password Mot de passe de l'utilisateur.</p>
 *
 * @return resource - Retourne l'identifiant de connexion en cas de succes
 *         ou <b>FALSE</b> si une erreur survient.
 *
 */
function connexion($host, $port, $dbname, $user, $password) {
    global $modeacces, $connexion;
    
    if ($modeacces=="mysql") {
        @$link = mysql_connect("$host", "$user", "$password")
        or die("Erreur de connexion : ".mysql_error());
        if ($link) {
            @$connexion = mysql_select_db("$dbname")
            or die("Erreur de connexion : ".mysql_error());
        }
    }
    
    if ($modeacces=="mysqli") {
        @$connexion = mysqli_connect("$host", "$user", "$password", "$dbname", $port);
        if (mysqli_connect_errno($connexion)) {
            die("Erreur de connexion (" . mysqli_connect_errno($connexion) . ") ". mysqli_connect_error($connexion));
        }
    }
    
    return $connexion;
    
}


/**
 *
 * Ferme la connexion SQL.
 *
 */
function deconnexion() {
    global $modeacces, $connexion;
    
    if ($modeacces=="mysql") {
        @mysql_close();
    }
    
    if ($modeacces=="mysqli") {
        mysqli_close($connexion);
    }
    
}


/**
 *
 * Envoie une requete a un serveur SQL.
 *
 * @param string $sql Requete SQL.
 *
 * @return resource - Pour les requetes du type SELECT, SHOW, DESCRIBE, EXPLAIN et
 *          les autres requetes retournant un jeu de resultats, <b>executeSQL</b>
 *          retournera une ressource en cas de succes, ou <b>DIE</b> en cas d'erreur.
 *
 *          Pour les autres types de requetes, INSERT, UPDATE, DELETE, DROP, etc.,
 *          <b>executeSQL</b> retourne <b>TRUE</b> en cas de succes ou <b>DIE</b> en cas d'erreur.
 *
 */
function executeSQL($sql) {
    global $modeacces, $connexion;
    
    if ($modeacces=="mysql") {
        @$result = mysql_query($sql)
        or die (afficheErreur($sql));
    }
    
    if ($modeacces=="mysqli") {
        $result = mysqli_query($connexion, $sql)
        or die (afficheErreur($sql));
    }
    
    return $result;
    
}


/**
 *
 *Envoie une requete a un serveur SQL laisse le programmeur Gerer les Erreurs.
 *
 * @param string $sql Requete SQL.
 *
 * @return resource - Pour les requetes du type SELECT, SHOW, DESCRIBE, EXPLAIN et
 *          les autres requetes retournant un jeu de resultats, <b>executeSQL</b>
 *          retournera une ressource en cas de succes, ou <b>FALSE</b> en cas d'erreur.
 *
 *          Pour les autres types de requetes, INSERT, UPDATE, DELETE, DROP, etc.,
 *          <b>executeSQL</b> retourne <b>TRUE</b> en cas de succes ou <b>FALSE</b> en cas d'erreur.
 *
 */
function executeSQL_GE($sql) {
    global $modeacces, $connexion;
    
    if ($modeacces=="mysql") {
        $result = mysql_query($sql);
        
    }
    
    if ($modeacces=="mysqli") {
        $result = mysqli_query($connexion, $sql);
    }
    
    return $result;
}


/**
 *
 * Formate l'erreur de la requete SQL pour afficher les informations :
 * <ul> <li>Nom du serveur</li>
 *      <li>Nom du fichier</li>
 *      <li>Ligne de l'erreur</li>
 *      <li>Erreur SQL</li>
 *      <li><b>Requete SQL (en gras)</b></li></ul>
 *
 * @param string $sql Requete SQL.
 *
 * @return string - Chaine de carateres bien formatee.
 *
 */
function afficheErreur($sql) {
    
    return "Erreur SQL de <b>".$_SERVER["SCRIPT_NAME"].
    "</b>.<br />Dans le fichier : ".__FILE__.
    "<br />".erreurSQL().
    "<br /><br /><b>REQUETE SQL : </b>$sql<br />";
    
}


/**
 *
 * Retourne le texte associe avec l'erreur generee lors de la derniere requete.
 *
 * @return string - Retourne le texte de l'erreur de la derniere fonction MySQL,
 *         ou '' (chaine vide) si aucune erreur survient.
 *
 */
function erreurSQL() {
    global $modeacces, $connexion;
    
    if ($modeacces=="mysql") {
        return mysql_error();
    }
    
    if ($modeacces=="mysqli") {
        return mysqli_error_list($connexion)[0]['error'];
    }
    
    
}


/**
 *
 * Retourne le nombre de lignes d'un resultat SQL.
 *
 * @param string $sql Requete SQL.
 *
 * @return integer - Le nombre de lignes dans le jeu de resultats en cas de succes
 *         ou <b>FALSE</b> si une erreur survient.
 *
 */
function compteSQL($sql) {
    global $modeacces;
    
    $result = executeSQL($sql);
    
    if ($modeacces=="mysql") {
        $num_rows = mysql_num_rows($result);
    }
    
    if ($modeacces=="mysqli") {
        $num_rows = mysqli_num_rows($result);
    }
    
    return $num_rows;
    
}


/**
 *
 * Retourne un tableau resultat d'une requete SQL.
 *
 * @param string $sql Requete SQL.
 *
 * @return array - Tableau indexe et associatif resultat de la requete SQL.
 *
 * @example
 * <code>
 * $sql = "select * from user";             <br />
 * $results = tableSQL($sql);               <br />
 * foreach ($results as $row) {             <br />
 * &nbsp;&nbsp;$login = $row['login'];      <br />
 * &nbsp;&nbsp;$password = $row[3];         <br />
 * &nbsp;&nbsp;echo $login." ".$password;   <br />
 * }                                        <br />
 </code>
 *
 */
function tableSQL($sql) {
    global $modeacces;
    
    $rows=array();
    $result = executeSQL($sql);
    
    if ($modeacces=="mysql") {
        while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
            array_push($rows,$row);
        }
    }
    
    if ($modeacces=="mysqli") {
        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
            array_push($rows,$row);
        }
    }
    
    return $rows;
}


/**
 *
 * Retourne un seul champ resultat d'une requete SQL.
 *
 * @param string $sql Requete SQL.
 *
 * @return string - une chaine resultat de la requete SQL.
 *
 */
function champSQL($sql) {
    
    global $modeacces;
    
    $result = executeSQL($sql);
    
    if ($modeacces=="mysql") {
        $rows = mysql_fetch_array($result, MYSQL_NUM);
    }
    
    if ($modeacces=="mysqli") {
        $rows = mysqli_fetch_array($result, MYSQLI_NUM);
    }
    
    return $rows[0];
}


/**
 *
 * Retourne le nom d'une colonne SQL specifique.
 *
 * @param string $sql Requete SQL.
 * @param integer $field_offset Position numerique du champ. field_offset commence a 0.
 *        Si field_offset n'existe pas, une alerte <b>E_WARNING</b> sera egalement generee.
 *
 * @return string - Retourne le nom du champ d'une colonne specifique.
 *
 */
function nomChamp($sql, $field_offset) {
    
    global $modeacces;
    
    $result = executeSQL($sql);
    
    if ($modeacces=="mysql") {
        return mysql_field_name($result, $field_offset);
    }
 
    
    if ($modeacces=="mysqli") {
        $infos = (array)mysqli_fetch_field_direct($result,$field_offset);
        return $infos["name"];
        /*
        $finfo = $result->fetch_field_direct($field_offset);
        return $finfo->name;
         */    
    }

}


/**
 *
 * Retourne le type d'une colonne SQL specifique.
 *
 * @param string $sql Requete SQL.
 * @param integer $field_offset Position numerique du champ. field_offset commence a 0.
 *        Si field_offset n'existe pas, une alerte <b>E_WARNING</b> sera egalement generee.
 *
 * @return string - Retourne le type du champ il peut etre : "int", "real", "string", "blob"
 *         ou autres, comme detaille dans la documentation MySQL.
 *
 */
function typeChamp($sql, $field_offset) {
    
    global $modeacces, $mysql_data_type_hash;
    
    $result = executeSQL($sql);
    
    if ($modeacces=="mysql") {
        return mysql_field_type($result, $field_offset);
    }
    
    if ($modeacces=="mysqli") {     
        //transforme l'objet renvoye par mysqli_fetch_field_direct en tableau
        $infos = (array)mysqli_fetch_field_direct($result, $field_offset);
        //recherche dans le tableau $mysql_data_type_hash la correspondance en chaine du type 
        return  $mysql_data_type_hash[$infos["type"]];      
        //notation objet 
        // return  $mysql_data_type_hash[$result->fetch_field_direct($field_offset)->type];
    }
    
}


/**
 *
 * Retourne le nombre de champs d'une requete SQL.
 *
 * @param string $sql Requete SQL.
 *
 * @return integer - le nombre de champs d'un jeu de resultat en cas de succes
 *         ou <b>FALSE</b> si une erreur survient.
 *
 */
function nombreChamp($sql) {
    
    global $modeacces;
    
    if ($modeacces=="mysql") {
        $result = executeSQL($sql);
        return mysql_num_fields($result);
    }
    
    if ($modeacces=="mysqli") {
        $result = executeSQL($sql);
        return mysqli_num_fields($result);
    }
    
}


/**
 *
 * Affiche sous forme d'un tableau le resultat d'une requete SQL.
 *
 * @param string $sql Requete SQL.
 *
 */
function afficheRequete($sql) {
    
    $results = tableSQL($sql);
    
    $nbchamps = nombreChamp($sql);
    
    echo "<pre><table style=\"border: 2px solid blue; border-collapse: collapse; \">";
    echo "   <caption style=\"color:green;font-weight:bold\">$sql</caption>
    <tr style=\"border: 2px solid blue; border-collapse: collapse; \" >";
    for ($i=0;$i<$nbchamps;$i++) {
        echo "<th style=\"border: 2px solid blue; border-collapse: collapse; \">".nomChamp($sql,$i)."(".typeChamp($sql,$i).")</th>";
    }
    echo "   </tr>";
    
    foreach ($results as $ligne) {
        echo "<tr style=\"border: 1px solid red; border-collapse: collapse; \">";
        //on extrait chaque valeur de la ligne courante
        for ($i=0;$i<$nbchamps;$i++) {
            echo "<td style=\"border: 1px solid red; border-collapse: collapse; \">".$ligne[$i]."</td>";
        }
        echo "</tr>";
    }
    
    echo "</table></pre>";
}
?>











