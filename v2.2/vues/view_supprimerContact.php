<form action="" method="GET">
    <label for="identifiant">Entrez l'ID du contact à supprimer</label>
    <br>
    <input type="text" name="identifiant" placeholder="identifiant">
    <br>

    <a href="index.php?action=ajoutNouveauContactOK">
        <input type="hidden" name="action" value="suppressionContactOK">
    </a>
    <input type="submit" value="Supprimer">
    <br />
</form>