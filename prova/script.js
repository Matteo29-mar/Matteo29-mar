document.addEventListener('DOMContentLoaded', function () {
    // Funzione per aprire il modale
    function openCreateModal() {
        document.getElementById('create-modal').style.display = 'block';
    }

    // Funzione per chiudere il modale
    function closeCreateModal() {
        document.getElementById('create-modal').style.display = 'none';
    }

    // Funzione per creare la cartella e aggiornare l'HTML
    function createFolder() {
        var folderName = document.getElementById('folder-input').value;

        if (folderName.trim() !== '') {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'crea_cartella.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response === 'success') {
                        document.getElementById('folder-name').textContent = folderName;
                        document.getElementById('folder-icon').style.display = 'inline';
                    }
                    // Chiudi il modale
                    closeCreateModal();
                    console.log(response);
                }
            };
            xhr.send('folderName=' + encodeURIComponent(folderName));
        }
    }

    // Associa le funzioni ai pulsanti e al pulsante di chiusura
    document.getElementById('create-button').addEventListener('click', openCreateModal);
    document.getElementById('save-button').addEventListener('click', createFolder);
    document.getElementById('close-button').addEventListener('click', closeCreateModal);
});
