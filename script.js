$(document).ready(function () {

    function sortTable(column) {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("contacts-table");
        switching = true;

        while (switching) {
            switching = false;
            rows = table.getElementsByTagName("tr");

            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("td")[column];
                y = rows[i + 1].getElementsByTagName("td")[column];

                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }

            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

    function displayAddContactForm() {
        $('#add-contact-popup').show();
    }

    function displayEditContactForm(contactDetails) {
        $('#edit-nom').val(contactDetails.nom);
        $('#edit-prenom').val(contactDetails.prenom);
        $('#edit-categorie').val(contactDetails.categorie);
        $('#edit-contact-popup').show();
    }

    $('#contacts-table th').click(function() {
        var columnIndex = $(this).index();
        sortTable(columnIndex);
    });

    $('#contacts-table tbody').on('click', 'tr', function() {
        var contactId = $(this).data('contact-id');
        $.ajax({
            url: 'ajax.php',
            method: 'POST',
            data: {
                action: 'getContactDetails',
                contactId: contactId
            },
            success: function (response) {
                $('#contact-details').html(response);
                $('#contact-popup').show();
            }
        });
    });

    $('#close-contact-btn').click(function () {
        $('#contact-popup').hide();
    });

    $('#add-contact-popup, #edit-contact-popup').hide();

    $('#add-contact-btn').click(function () {
        displayAddContactForm();
    });

    $('#cancel-add-contact-btn, #cancel-edit-contact-btn').click(function () {
        $('#add-contact-popup, #edit-contact-popup').hide();
    });

    $('#save-add-contact-btn').click(function () {
        var nom = $('#add-nom').val();
        var prenom = $('#add-prenom').val();
        var categorie = $('#add-categorie').val();

        if (nom && prenom && categorie) {
            $.ajax({
                url: 'ajax.php',
                method: 'POST',
                data: {
                    action: 'addContact',
                    nom: nom,
                    prenom: prenom,
                    categorie: categorie
                },
                success: function (response) {
                    alert(response);
                    loadContacts();
                    $('#add-contact-popup').hide();
                }
            });
        } else {
            alert('Tous les champs sont obligatoires.');
        }
    });

});
