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
    <br>
    <a href="index.php?action=resultatRecherche">
        <input type="hidden" name="action" value="resultatRecherche">
    </a>
    <input type="submit" value="chercher">
    <br>
    <br>
</form>

<?php if (isset($_GET['index'])) {
?>
    <input type="hidden" name="prenomRecherche" value="<?php echo $_GET['prenom'] ?>">
    <input type="hidden" name="nomRecherche" value="<?php echo $_GET['nom'] ?>">
    <input type="hidden" name="telephoneRecherche" value="<?php echo $_GET['telephone'] ?>">
    <input type="submit" name="action" value="modifier">
    <input type="submit" name="action" value="supprimer">
<?php
}
?>