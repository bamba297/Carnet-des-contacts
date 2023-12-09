<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carnet de Contacts</title>
    <link rel="stylesheet" href="styles.css">    
</head>
<body>

    <div id="contacts-list">
        <?php
        include_once('connexionDB.php');
        include_once('contact.class.php');

        $connexionDB = new ConnexionDB("localhost", "test", "root", "");
        $db = $connexionDB->getConnexion();
        
        $contact = new Contact($db);

        $contacts = $contact->getContacts();

        if (!empty($contacts)) 
        {
            echo '<table id="contacts-table">';
            echo '<thead><tr><th data-column="prenom">Prénom</th><th data-column="nom">Nom</th><th data-column="id_categorie">Catégorie</th></tr></thead>';
            echo '<tbody>';

            foreach ($contacts as $contact) {
                echo '<tr class="contact-id" data-contact-id="'. $contact['id'] .'">';
                echo '<td>' . $contact['prenom'] . '</td>';
                echo '<td>' . $contact['nom'] . '</td>';
                echo '<td>' . $contact['id_categorie'] . '</td>';
                // echo '<td><button id="edit-contact-btn" class="edit-contact-btn" data-edit-contact-btn="'. $contact['id'] .'">Éditer</button></td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';

        } 
        else 
        {
            echo '<p>Aucun contact trouvé.</p>';
        }
        ?>
    </div>
    <button class="bouton" id="add-contact-btn">Ajouter</button>
  

    <dialog id="contact-popup" class="popup">
        <div id="contact-details">
            <h2 id="contact-title"></h2>
            <button class="bouton1" id="close-contact-btn">Fermer</button>
        </div>
    </dialog>


  <dialog id="add-contact-popup" class="popup">
        <div id="add-contact-form">
            <h2 id="add-contact-title">Ajouter un contact</h2>
            <label for="add-nom">Nom:</label><br>
            <input type="text" id="add-nom"><br>

            <label for="add-prenom">Prénom:</label><br>
            <input type="text" id="add-prenom"><br>

            <label for="add-categorie">Catégorie:</label><br>
            <input type="text" id="add-categorie"><br><br>

            <button id="save-add-contact-btn">Enregistrer</button><br>
            <button id="cancel-add-contact-btn">Annuler</button>
        </div>
    </dialog>


</div>

</body>
    <script type="text/javascript" src="jquery.js"></script>
    <script src="script.js"></script>
</html>
