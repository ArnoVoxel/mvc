<?php

?>
<form action="" method="GET">
    <label for="prenom">Entrez le prénom</label>
    <input type="text" name="prenom" id="prenom" placeholder="un prénom" required="require">
    <br />
    <br />
    <label for="nom">Entrez le nom</label>
    <input type="text" name="nom" id="nom" placeholder="un nom" required="require">
    <br />
    <br />
    <label for="telephone">Entrez le telephone</label>
    <input type="text" name="telephone" id="telephone" placeholder="un numéro de  telephone" required="require">
    <br />
    <br />

    <a href="index.php?action=ajoutNouveauContactOK">
        <input type="hidden" name="action" value="ajoutNouveauContactOK">
    </a>
    <input type="submit" value="Ajouter">
    <br />
</form>
<br /><br />