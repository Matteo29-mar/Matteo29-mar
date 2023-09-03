function uploadFile() {
    const fileInput = document.getElementById("fileInput");
    const formData = new FormData();
    formData.append("file", fileInput.files[0]);

    fetch("upload.php", {
        method: "POST",
        body: formData,
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Mostra un messaggio di conferma
    })
    .catch(error => {
        console.error("Errore durante il caricamento del file:", error);
    });
}

function createFolder() {
    const folderName = document.getElementById("folderName").value;

    fetch("create_folder.php", {
        method: "POST",
        body: JSON.stringify({ folderName }),
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Mostra un messaggio di conferma
    })
    .catch(error => {
        console.error("Errore durante la creazione della cartella:", error);
    });
}

function showFolderContent() {
    const folderSelect = document.getElementById("folderSelect");
    const selectedFolder = folderSelect.value;

    if (selectedFolder) {
        const folderContentsDiv = document.getElementById("folderContents");
        folderContentsDiv.innerHTML = ""; // Resetta il contenuto precedente

        fetch(`get_folder_contents.php?folder=${selectedFolder}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                return;
            }

            data.files.forEach(file => {
                const filePreview = document.createElement("iframe");
                filePreview.src = `uploads/${selectedFolder}/${file}`;
                filePreview.title = file;
                folderContentsDiv.appendChild(filePreview);
            });
        })
        .catch(error => {
            console.error("Errore durante il recupero del contenuto della cartella:", error);
        });
    }
}

function loadFolders() {
    const folderSelect = document.getElementById("folderSelect");

    fetch("get_folders.php")
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error(data.error);
            return;
        }

        data.folders.forEach(folder => {
            const option = document.createElement("option");
            option.value = folder;
            option.text = folder;
            folderSelect.appendChild(option);
        });
    })
    .catch(error => {
        console.error("Errore durante il recupero delle cartelle:", error);
    });
}

// Chiamata iniziale per caricare le cartelle disponibili
loadFolders();
