<?php


/**
 * Il obtient la liste des contacts à partir d'un fichier.
 * 
 * @param string filename L'emplacement et le nom du fichier à lire.
 */
function getListContacts(string $filename)
{
    echo "
    <table>
    <tr>
    <th>ID</th>
    <th>PRENOM</th>
    <th>NOM</th>
    <th>TELEPHONE</th>
    </tr><br>";
    if (file_exists($filename)) {
        $tableauContacts = file($filename);
        foreach ($tableauContacts as $key => $info) {
            $tableauInfo = explode(";", $info);
            echo "<tr>
            <td>$key</td>
            <td>$tableauInfo[0]</td>
            <td>$tableauInfo[1]</td>
            <td>$tableauInfo[2] </td>
            </tr>";
            //echo "PRENOM : " . $tableauInfo[0] . " NOM : " . $tableauInfo[1] . " TELEPHONE : " . $tableauInfo[2] . "<br />";
        }
    } else {
        echo "pas de fichier contacts";
    }

    echo "</table>";
}

/**
 * Si le prenom est défini, récupérez le contenu du fichier, ajoutez le nouveau contact à la fin du
 * fichier et écrivez le nouveau contenu dans le fichier.
 * 
 * @param string filename Le nom du fichier dans lequel écrire.
 */
function addContact(string $filename)
{
    if (isset($_GET['prenom'])) {

        $tableauContacts = $_GET['prenom'] . ";" . $_GET['nom'] . ";" . $_GET['telephone'] . "\n";
        file_put_contents($filename, $tableauContacts, FILE_APPEND);
    } else {
        echo "rien ajouté";
    }
}

/**
 * Il prend un nom de fichier, un prénom, un nom et un numéro de téléphone comme arguments, et renvoie
 * une table des contacts correspondants
 * 
 * @param string filename Le nom du fichier à rechercher.
 * @param string prenom Le prénom du contact.
 * @param string nom Le nom du fichier à rechercher.
 * @param string telephone le numéro de téléphone du contact
 * 
 * @return arrayt tableau contenant les index des valeurs de la recherche
 */
function searchContact(string $filename): array
{
    $tableauContact = file($filename);
    $index = [];
    $curseur = 0;

    if (strlen($_GET['nomRecherche']) == 0) {
        $nomRecherche = " ";
    } else {
        $nomRecherche = $_GET['nomRecherche'];
    }
    if (strlen($_GET['prenomRecherche']) == 0) {
        $prenomRecherche = " ";
    } else {
        $prenomRecherche = $_GET['prenomRecherche'];
    }
    if (strlen($_GET['telephoneRecherche']) == 0) {
        $telephoneRecherche = " ";
    } else {
        $telephoneRecherche = $_GET['telephoneRecherche'];
    }


    /* Recherche du contact dans le fichier. */
    foreach ($tableauContact as $key => $contact) {
        if ((stristr($contact, $prenomRecherche)) || (stristr($contact, $nomRecherche)) || (stristr($contact, $telephoneRecherche))) {
            $index[] = $key;
        } else {
            $curseur++;
        }
    }
    $_GET['index'] = (count($tableauContact) - $curseur);
    return $index;
}

/**
 * Il affiche le résultat de la recherche.
 * 
 * @param string filename le nom du fichier à rechercher
 * @param array tableauIndex tableau des index des contacts trouvés
 */
function displayResult(string $filename, array $tableauIndex)
{
    if (count($tableauIndex) > 0) {
        $tableauContact = file($filename);
        //entête du tableau de résultat
        echo "
        <table>
        <tr>
        <th>ID</th>
        <th>PRENOM</th>
        <th>NOM</th>
        <th>TELEPHONE</th>
        </tr><br>";

        foreach ($tableauIndex as $keyIndice => $indice) {
            foreach ($tableauContact as $key => $contact) {
                $contactTrouve = explode(";", $contact);
                if ($key == $indice) {
                    echo "<tr>
                    <td>$key</td>
                    <td>$contactTrouve[0]</td>
                    <td>$contactTrouve[1]</td>
                    <td>$contactTrouve[2] </td>
                    </tr>";
                }
            }
        }


        echo "</table><br>";
    } else {
        echo "inconnu au bataillon<br><br>";
    }
}

/**
 * Il supprime un contact d'un fichier.
 * 
 * @param string filename le nom du fichier à lire
 * @param string identifiant l'identifiant unique du contact
 */
function removeContact(string $filename, string $identifiant)
{
    $tableauContacts = getListContacts($filename);
    if (isset($tableauContacts[$identifiant]))
        unset($tableauContacts[$identifiant]);
    file_put_contents($filename, "");
    foreach ($tableauContacts as $key => $contact) {
        file_put_contents($filename, "$contact", FILE_APPEND);
    }
}

function updateContact(string $filename, string $identifiant, string $nouveauPrenom, string $nouveauNom, string $nouveauTelephone)
{
    //récupère la liste de contact sous forme de tableau
    $tableauContact = file($filename);
    $tableauContact[$identifiant] = $nouveauPrenom . ";" . $nouveauNom . ";" . $nouveauTelephone;
    file_put_contents($filename, "");
    foreach ($tableauContact as $key => $contact) {
        file_put_contents($filename, "$contact", FILE_APPEND);
    }
}
