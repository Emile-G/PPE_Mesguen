<?php

// SE CONNECTER A LA BDD
    include "C:\Program Files (x86)\EasyPHP-DevServer-14.1VC9\data\localweb\my portable files\SI6\AccesDonnees.php";
    $connexion=connexion("127.0.0.1","3306","mlr1","root","");

    if ($connexion) {
        echo "Connexion reussie 127.0.0.1 : 3306 <br />";
        echo "Base mlr1 selectionnee... <br />";
        echo "Mode acces : mysqli <br />";
    }
    echo "<br/><br/><br/><br/>"; 

// GENERER NOMS DE FAMILLE

    //initialisation des compteurs de boucles et du Tableau Noms
    $TabloNoms=array();


    // Importation des Noms et Mise en Tableau
    $nom = 'nom.txt';
    $tablonom = file($nom);

    // Mise en Tableau de 30 Noms choisis aléatoirement
    for($compteur=1;$compteur<31;$compteur++){
        $i=rand(1,94);
        //ici, rtrim suprime le caractère ENTER
        $TabloNoms[]= rtrim($tablonom[$i], '
            ');
    
        }
    print_r($TabloNoms);
    echo "<br/><br/><br/><br/>";
    
// GENERER PRENOMS 

    //initialisation des compteurs de boucles et du Tableau Prenoms
    $TabloPrenoms=array();


    // Importation des prenoms Garcon et Filles et Mises en Tableaux
    $garcon = 'garcon.txt';
    $tablogarcon = file($garcon);

    $fille = 'fille.txt';
    $tablofille = file($fille);

    // Mise en Tableau de 15 Prenoms de Garcons choisis aléatoirement
    for($compteurG=1;$compteurG<16;$compteurG++){
        $i=rand(1,99);
        $TabloPrenoms[]=$tablogarcon[$i];
    
    }

    // Mise en Tableau de 15 Prenoms de Filles choisis aléatoirement
    for($compteurF=1;$compteurF<16;$compteurF++){
        $y=rand(1,99);
        $TabloPrenoms[]=$tablofille[$y];
    }

    print_r($TabloPrenoms);
    echo "<br/><br/><br/><br/>";

// MAIL 

    $email = "email.txt";
    $tabloemail = file($email);
    $tabloemails=array();


// GENERER NUMEROS DE TELEPHONE 

    $taille=1;
    $TabloTel = array();

    while($taille<31){
    
        $numero= rand(611111111,799999999);
        $TabloTel[]= str_pad($numero, 10, "0",STR_PAD_LEFT);
        $taille++;
    }
    print_r($TabloTel);
    echo "<br/><br/><br/><br/>";
    
//REQUETE SQL POUR INSERER LES DONNEES DANS LA TABLE CHAUFFEUR

    for($x=0;$x<sizeof($TabloNoms);$x++) {

        $tabloemails[]=$TabloNoms[$x].$TabloPrenoms[$x].$tabloemail[$x];
        $tabloemails=preg_replace('/\s/', '', $tabloemails); 

                //CHFID
                $tabloTrigramme[] = substr($TabloPrenoms[$x], 0, 1).substr($TabloNoms[$x], 0, 1).substr($TabloNoms[$x], strlen($TabloNoms[$x]) - 1, 1);

                 $sql="INSERT INTO chauffeur(`CHFID`,`CHFNOM`,`CHFPRENOM`,`CHFTEL`,`CHFMAIL`) VALUES ('".$x."','".$TabloNoms[$x]."','".$TabloPrenoms[$x]."','".$TabloTel[$x]."','".$tabloemails[$x]."')";

        echo "Sql : ".$sql."<br />";
        $result = executeSQL($sql);

        
    }

        echo "<pre>";
        print_r($tabloemails);
        echo "</pre>";

        echo "<br>";

        echo "<pre><code>";
        print_r($tabloTrigramme);
        echo "</pre></code>";


?>