document.addEventListener("DOMContentLoaded", function () {
    const createButton = document.getElementById("create-button");
    const createModal = document.getElementById("create-modal");
    const closeButton = document.getElementById("close-button");
    const cancelButton = document.getElementById("cancel-button");
    const saveButton = document.getElementById("save-button");
    const folderInput = document.getElementById("folder-input");
    const successPopup = document.getElementById("success-popup");
    const errorPopup = document.getElementById("error-popup");
    const viewButton = document.getElementById("view-button");
    const fileListContainer = document.getElementById("file-list-container");
    const fileList = document.getElementById("file-list");

    const visualizzaButton = document.getElementById("visualizza-button");

    visualizzaButton.addEventListener("click", function () {
        // Reindirizza l'utente alla pagina "visualizza.html"
        window.location.href = "visualizza.html";
    });
    createButton.addEventListener("click", function () {
        createModal.style.display = "block";
    });

    closeButton.addEventListener("click", function () {
        createModal.style.display = "none";
    });

    cancelButton.addEventListener("click", function () {
        createModal.style.display = "none";
    });

    saveButton.addEventListener("click", function () {
        const folderName = folderInput.value;

        if (folderName.trim() === "") {
            alert("Inserisci un nome per la cartella.");
            return;
        }
        // Effettua una richiesta POST all'API controller.php
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "controller.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        successPopup.style.display = "block";
                    } else {
                        errorPopup.style.display = "block";
                    }
                } else {
                    console.error("Errore nella richiesta API");
                }
            }
        };
        xhr.send(`folderName=${folderName}`);
        createModal.style.display = "none";
    });
    viewButton.addEventListener("click", function () {
        // Effettua una richiesta GET all'API controller.php
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "controller.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const files = JSON.parse(xhr.responseText);

                    // Mostra l'elenco dei file
                    fileList.innerHTML = "";
                    if (files.length > 0) {
                        files.forEach(function (file) {
                            const listItem = document.createElement("li");
                            listItem.textContent = file;
                            fileList.appendChild(listItem);
                        });
                        fileListContainer.style.display = "block";
                    } else {
                        fileListContainer.style.display = "none";
                        alert("Nessun file trovato.");
                    }
                } else {
                    console.error("Errore nella richiesta API GET");
                }
            }
        };
        xhr.send();
    });
});

