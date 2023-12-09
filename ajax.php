<?php
include_once('contact.class.php');
include_once('connexionDB.php');



$connexionDB = new ConnexionDB("localhost", "test", "root", "");
$db = $connexionDB->getConnexion();
$contact = new Contact($db);


if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'getContacts':
            $contacts = $contact->getContacts();
            echo json_encode($contacts);
            break;
        default:
            break;
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'getContactDetails') {
    if (isset($_POST['contactId'])) {
        $contactId = $_POST['contactId'];
        $contactDetails = $contact->getContactDetails($contactId);

        if ($contactDetails) {
            echo '<h2>' . $contactDetails['prenom'] . ' ' . $contactDetails['nom'] . '</h2>';
            echo '<p>Catégorie: ' . $contactDetails['id_categorie'] . '</p>';
        } else {
            echo '<p>Impossible de trouver les détails du contact.</p>';
        }
    } else {
        echo '<p>ID du contact non spécifié.</p>';
    }
} else {
    echo '<p>Action non valide.</p>';
}

if (isset($_POST['action']) && $_POST['action'] == 'addContact') {
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['categorie'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $categorie = $_POST['categorie'];

        $result = $contact->addContact($nom, $prenom, $categorie);

        if ($result) {
            echo 'Contact ajouté avec succès.';
        } else {
            echo 'Erreur lors de l\'ajout du contact.';
        }
    } else {
        echo 'Veuillez fournir toutes les informations nécessaires.';
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'editContact') {
    if (isset($_POST['contactId'])) {
        $contactId = $_POST['contactId'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $categorie = $_POST['categorie'];

        $result = $contact->editContact($contactId, $nom, $prenom, $categorie);

        if ($result) {
            echo '<p>Modification du contact réussie.</p>';
        } else {
            echo '<p>Échec de la modification du contact.</p>';
        }
    } else {
        echo '<p>ID du contact non spécifié.</p>';
    }
} else {
    echo '<p></p>';
}
?>
