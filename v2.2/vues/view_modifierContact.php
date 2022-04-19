<?php

?>
<form action="" method="GET">
    <label for="nomRecherche">Entrer un NOM à modifier : </label>
    <input type="text" name="nomRecherche">
    <br>
    <label for="prenomRecherche">Entrer un PRENOM à modifier : </label>
    <input type="text" name="prenomRecherche">
    <br>
    <label for="telephoneRecherche">Entrer un NUMERO de TELEPHONE à modifier : </label>
    <input type="text" name="telephoneRecherche">
    <br>
    <a href="index.php?action=resultatModification">
        <input type="hidden" name="action" value="resultatModification">
        <input type="hidden" name="identifiant" value="<?php echo $_GET['identifiant'] ?>">

    </a>
    <input type="submit" value="modifier">
</form>