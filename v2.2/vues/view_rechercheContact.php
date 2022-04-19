<?php

?>
<form action="" method="GET">
    <label for="nomRecherche">Entrer un NOM à chercher : </label>
    <input type="text" name="nomRecherche">
    <br>
    <label for="prenomRecherche">Entrer un PRENOM à chercher : </label>
    <input type="text" name="prenomRecherche">
    <br>
    <label for="telephoneRecherche">Entrer un NUMERO de TELEPHONE à chercher : </label>
    <input type="text" name="telephoneRecherche">
    <br>
    <a href="index.php?action=resultatRecherche">
        <input type="hidden" name="action" value="resultatRecherche">
    </a>
    <input type="submit" value="chercher">
</form>