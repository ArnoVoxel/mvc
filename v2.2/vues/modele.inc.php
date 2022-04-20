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
 */
function searchContact(string $filename, string $prenom = "*", string $nom = "*", string $telephone = "*")
{
    $tableauContact = file($filename);
    $resultat = 0;
    echo "
                <table>
                <tr>
                <th>ID</th>
                <th>PRENOM</th>
                <th>NOM</th>
                <th>TELEPHONE</th>
                </tr><br>";

    /* Recherche du contact dans le fichier. */
    foreach ($tableauContact as $key => $contact) {
        if ((stristr($contact, $prenom)) || (stristr($contact, $nom)) || (stristr($contact, $telephone))) {
            $contactTrouve = explode(";", $contact);

            echo "<tr>
                <td>$key</td>
                <td>$contactTrouve[0]</td>
                <td>$contactTrouve[1]</td>
                <td>$contactTrouve[2] </td>
                </tr>";
        } else {
            $resultat++;
        }
    }

    if (($resultat == 8) && strlen($contactTrouve[0]) < 1) {
        echo "inconnu au bataillon.<br><br>";
    }
    echo "</table><br>";
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
