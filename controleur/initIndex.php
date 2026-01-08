<?php
    /* Connexion à la bdd */
    $con = mysqli_connect("localhost", "root", "", "scierie");

    if (mysqli_connect_errno()){
        echo "Erreur de connexion: " . mysqli_connect_error();
    }

    mysqli_set_charset($con,"utf8");

    /* Requête SQL */
    $sql = "SELECT home.titre, home.descr, home.img FROM home";
    $requete = $con->query($sql);

    while ($resultat = mysqli_fetch_array($requete))
    {
        $description = "<ul class='main-list'>";
        
        // Protection XSS avec htmlspecialchars sur le titre
        if($resultat['titre']!='') {
            $description .= "<li class='main-item'><p class='titre'>".htmlspecialchars($resultat['titre'], ENT_QUOTES, 'UTF-8')."</p></li>";
        }

        if($resultat['descr']!='' && $resultat['img']!=''){
            $description .= "<li class ='main-item'><ul class ='sub-list'>";
            // Protection XSS sur la description et le nom de l'image
            $description .= "<li class='sub-item'><p class='texte'>".htmlspecialchars($resultat['descr'], ENT_QUOTES, 'UTF-8')."</p></li>";
            $description .= "<li class='sub-item'><img class='image' src='images/".htmlspecialchars($resultat['img'], ENT_QUOTES, 'UTF-8')."'></li>";
            $description .= "</ul></li>";
        } else {
            if($resultat['descr']!=''){
                $description .= "<li class='main-item'><p class='texte'>".htmlspecialchars($resultat['descr'], ENT_QUOTES, 'UTF-8')."</p></li>";
            }
            if($resultat['img']!=''){
                $description .= "<li class='main-item'><img class='image' src='images/".htmlspecialchars($resultat['img'], ENT_QUOTES, 'UTF-8')."'></li>";
            }
        }
        $description .="</ul>";
        echo $description;
    }

    mysqli_close($con);
?>