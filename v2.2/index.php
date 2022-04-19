<?php
require("vues/modele.inc.php");

$titre = "Bienvenue sur la page d'accès aux contacts";
$titrePage = "ACCEUIL";

$action = 'accueil';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

//récupère l'emplacement de la liste de contact et le nom du fichier issue du param.ini
$cheminListeContact = parse_ini_file("param/param.ini");

$listeContact = $cheminListeContact['chemin'] . $cheminListeContact['fichierContacts'];

switch ($action) {
    case 'accueil':
        /* Définition du titre de la page. */
        $titre = "Bienvenue sur la page d'accès aux contacts";
        $titrePage = "ACCEUIL";
        require("vues/view_header.php");
        require("vues/view_accueil.php");
        break;
    case 'liste':
        $titre = "Liste des contacts";
        $titrePage = "LISTE";
        require("vues/view_header.php");
        require("vues/view_listeContacts.php");
        require("vues/view_footer.html");
        break;
    case 'ajouter':
        $titre = "Ajouter un nouveau contact";
        $titrePage = "AJOUT";
        require("vues/view_header.php");
        require("vues/view_formulaire.php");
        require("vues/view_footer.html");
        break;
    case 'ajoutNouveauContactOK':
        $titre = "Bienvenue sur la page d'accès aux contacts";
        $titrePage = "ACCUEIL";
        addContact($listeContact);
        echo "nouveau contact ajouté";
        echo "\n" . $_GET['prenom'] . ";" . $_GET['nom'] . ";" . $_GET['telephone'];
        require("vues/view_header.php");
        require("vues/view_accueil.php");
        break;
    case 'chercher':
        $titre = "Ici vous pouvez rechercher un contact";
        $titrePage = "RECHERCHE";
        require("vues/view_header.php");
        require("vues/view_rechercheContact.php");
        require("vues/view_footer.html");
        break;
    case 'resultatRecherche':
        $titre = "résultat de recherche";
        $titrePage = "RESULTAT";
        require("vues/view_header.php");
        if (strlen($_GET['nomRecherche']) > 1) {
            $nomRecherche = $_GET['nomRecherche'];
        } else {
            $nomRecherche = " ";
        }
        if (strlen($_GET['prenomRecherche']) > 1) {
            $prenomRecherche = $_GET['prenomRecherche'];
        } else {
            $prenomRecherche = " ";
        }
        if (strlen($_GET['telephoneRecherche']) > 1) {
            $telephoneRecherche = $_GET['telephoneRecherche'];
        } else {
            $telephoneRecherche = " ";
        }
        searchContact($listeContact, $prenomRecherche, $nomRecherche, $telephoneRecherche);
        require("vues/view_rechercheContact.php");
        require("vues/view_footer.html");
        break;
    case 'supprimer':
        $titre = "Quel contact voulez-vous supprimer ?";
        $titrePage = "SUPPRESSION";
        require("vues/view_header.php");
        getListContacts($listeContact);
        require("vues/view_supprimerContact.php");
        require("vues/view_footer.html");
        break;
    case 'suppressionContactOK':
        $titre = "Bienvenue sur la page d'accès aux contacts";
        $titrePage = "ACCUEIL";
        if (isset($_GET['identifiant'])) {
            $identifiant = $_GET['identifiant'];
        } else {
            $identifiant = "";
        }
        removeContact($listeContact, $identifiant);
        require("vues/view_header.php");
        require("vues/view_accueil.php");
        break;
}
