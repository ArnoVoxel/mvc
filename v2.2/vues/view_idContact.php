<form action="" method="GET">
    <label for="identifiant">Entrez l'ID du contact</label>
    <br>
    <input type="text" name="identifiant" placeholder="identifiant">
    <br>

    <a href="index.php?action=suppressionContactOK">
        <input type="hidden" name="action" value=<?php echo $_GET['action'] . "OK" ?>>
    </a>
    <input type="submit" value="Supprimer">
    <br />
</form>