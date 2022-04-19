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
            <td>$tableauInfo[2] </td>";
            //echo "PRENOM : " . $tableauInfo[0] . " NOM : " . $tableauInfo[1] . " TELEPHONE : " . $tableauInfo[2] . "<br />";
        }
        return $tableauContacts;
    } else {
        echo "pas de fichier contacts";
    }

    echo "</table";
}

function addContact(string $filename)
{
    if (isset($_GET['prenom'])) {
        $tableauContacts = file_get_contents($filename);
        $tableauContacts .= "\n" . $_GET['prenom'] . ";" . $_GET['nom'] . ";" . $_GET['telephone'];
        file_put_contents($filename, $tableauContacts);
    } else {
        echo "rien ajouté";
    }
}

function searchContact(string $filename, string $prenom = "*", string $nom = "*", string $telephone = "*")
{
    $tableauContact = file($filename);
    $resultat = 0;
    foreach ($tableauContact as $key => $contact) {
        if ((stristr($contact, $prenom)) || (stristr($contact, $nom)) || (stristr($contact, $telephone))) {
            $contactTrouve = explode(";", $contact);
            echo "
                <table>
                <tr>
                <th>ID</th>
                <th>PRENOM</th>
                <th>NOM</th>
                <th>TELEPHONE</th>
                </tr><br>";
            echo "<tr>
                <td>$key</td>
                <td>$contactTrouve[0]</td>
                <td>$contactTrouve[1]</td>
                <td>$contactTrouve[2] </td>";
        } else {
            $resultat++;
        }
    }
    if ($resultat == 8) {
        echo "inconnu au bataillon.<br><br>";
    }
}

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
