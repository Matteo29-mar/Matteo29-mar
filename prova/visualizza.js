document.addEventListener("DOMContentLoaded", function () {
    const folderList = document.getElementById("folder-list");
    const htmlFileList = document.getElementById("html-file-list");

    // Effettua una richiesta GET all'API controller.php
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "controller.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                const folders = data.folders;
                const htmlFiles = data.htmlFiles;

                // Mostra l'elenco delle cartelle
                if (folders.length > 0) {
                    folders.forEach(function (folder) {
                        const listItem = document.createElement("li");
                        const link = document.createElement("a");
                        link.href = folder;
                        link.textContent = folder;
                        listItem.appendChild(link);
                        folderList.appendChild(listItem);
                    });
                } else {
                    folderList.innerHTML = "Nessuna cartella trovata.";
                }

                // Mostra l'elenco dei link ai file HTML
                if (htmlFiles.length > 0) {
                    htmlFiles.forEach(function (file) {
                        const listItem = document.createElement("li");
                        const link = document.createElement("a");
                        link.href = file;
                        link.textContent = file;
                        listItem.appendChild(link);
                        htmlFileList.appendChild(listItem);
                    });
                } else {
                    htmlFileList.innerHTML = "Nessun file HTML trovato.";
                }
            } else {
                console.error("Errore nella richiesta API GET");
            }
        }
    };
    xhr.send();
});
