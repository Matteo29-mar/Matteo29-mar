<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $directory = __DIR__; // Directory corrente
    $items = scandir($directory);

    // Filtra solo le cartelle e i file HTML
    $folders = array_filter($items, function ($item) {
        return is_dir($item);
    });
    $htmlFiles = array_filter($items, function ($item) {
        return pathinfo($item, PATHINFO_EXTENSION) === "html";
    });

    // Restituisci l'elenco delle cartelle e dei file HTML come JSON
    header("Content-Type: application/json");
    echo json_encode(["folders" => array_values($folders), "htmlFiles" => array_values($htmlFiles)]);

} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Gestione della richiesta POST
    $folderName = $_POST["folderName"];

    // Crea la cartella se non esiste
    if (!file_exists($folderName)) {
        mkdir($folderName);
    }

    // Crea il file HTML con il contenuto desiderato
    $htmlContent = "<!DOCTYPE html>\n";
$htmlContent .= "<html lang=\"it\">\n";
$htmlContent .= "<head>\n";
$htmlContent .= "    <meta charset=\"UTF-8\">\n";
$htmlContent .= "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
$htmlContent .= "    <title>La Mia Pagina</title>\n";
$htmlContent .= "    <style>\n";
$htmlContent .= "    body {\n";
$htmlContent .= "        background-color: #f5deb3;\n";
$htmlContent .= "        margin: 0;\n";
$htmlContent .= "        padding: 0;\n";
$htmlContent .= "        font-family: 'Arial', sans-serif;\n";
$htmlContent .= "    }\n";
$htmlContent .= "    header {\n";
$htmlContent .= "        background-color: #333;\n";
$htmlContent .= "        color: white;\n";
$htmlContent .= "        text-align: center;\n";
$htmlContent .= "        padding: 20px 0;\n";
$htmlContent .= "        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);\n";
$htmlContent .= "    }\n";
$htmlContent .= "    .logo {\n";
$htmlContent .= "        font-size: 48px;\n";
$htmlContent .= "        font-weight: bold;\n";
$htmlContent .= "        text-transform: uppercase;\n";
$htmlContent .= "    }\n";
$htmlContent .= "    main {\n";
$htmlContent .= "        text-align: center;\n";
$htmlContent .= "        padding: 20px;\n";
$htmlContent .= "        display: flex;\n";
$htmlContent .= "        justify-content: center;\n";
$htmlContent .= "        align-items: center;\n";
$htmlContent .= "        flex: 1;\n";
$htmlContent .= "    }\n";
$htmlContent .= "    button {\n";
$htmlContent .= "        padding: 12px 24px;\n";
$htmlContent .= "        font-size: 20px;\n";
$htmlContent .= "        margin: 15px;\n";
$htmlContent .= "        background-color: #007bff;\n";
$htmlContent .= "        color: white;\n";
$htmlContent .= "        border: none;\n";
$htmlContent .= "        border-radius: 8px;\n";
$htmlContent .= "        cursor: pointer;\n";
$htmlContent .= "        transition: background-color 0.3s, transform 0.2s, box-shadow 0.3s;\n";
$htmlContent .= "    }\n";
$htmlContent .= "    button:hover {\n";
$htmlContent .= "        background-color: #0056b3;\n";
$htmlContent .= "        transform: scale(1.05);\n";
$htmlContent .= "        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);\n";
$htmlContent .= "    }\n";
$htmlContent .= "    #folder-container {\n";
$htmlContent .= "        text-align: center;\n";
$htmlContent .= "        display: flex;\n";
$htmlContent .= "        align-items: center;\n";
$htmlContent .= "    }\n";
$htmlContent .= "    #folder-icon {\n";
$htmlContent .= "        display: none;\n";
$htmlContent .= "        width: 48px;\n";
$htmlContent .= "        height: 48px;\n";
$htmlContent .= "        margin-right: 10px;\n";
$htmlContent .= "    }\n";
$htmlContent .= "    #create-modal {\n";
$htmlContent .= "        display: none;\n";
$htmlContent .= "        position: fixed;\n";
$htmlContent .= "        top: 0;\n";
$htmlContent .= "        left: 0;\n";
$htmlContent .= "        width: 100%;\n";
$htmlContent .= "        height: 100%;\n";
$htmlContent .= "        background-color: rgba(0, 0, 0, 0.5);\n";
$htmlContent .= "        z-index: 1;\n";
$htmlContent .= "    }\n";
$htmlContent .= "    .modal-content {\n";
$htmlContent .= "        background-color: #fff;\n";
$htmlContent .= "        margin: 20% auto;\n";
$htmlContent .= "        padding: 20px;\n";
$htmlContent .= "        border-radius: 5px;\n";
$htmlContent .= "        width: 60%;\n";
$htmlContent .= "        text-align: center;\n";
$htmlContent .= "        position: relative;\n";
$htmlContent .= "    }\n";
$htmlContent .= "    .close {\n";
$htmlContent .= "        position: absolute;\n";
$htmlContent .= "        top: 10px;\n";
$htmlContent .= "        right: 10px;\n";
$htmlContent .= "        font-size: 24px;\n";
$htmlContent .= "        cursor: pointer;\n";
$htmlContent .= "    }\n";
$htmlContent .= "    #folder-input {\n";
$htmlContent .= "        width: 100%;\n";
$htmlContent .= "        padding: 10px;\n";
$htmlContent .= "        margin-bottom: 10px;\n";
$htmlContent .= "        border: 1px solid #ccc;\n";
$htmlContent .= "        border-radius: 5px;\n";
$htmlContent .= "    }\n";
$htmlContent .= "    #save-button {\n";
$htmlContent .= "        background-color: #007bff;\n";
$htmlContent .= "        color: white;\n";
$htmlContent .= "        border: none;\n";
$htmlContent .= "        border-radius: 5px;\n";
$htmlContent .= "        padding: 10px 20px;\n";
$htmlContent .= "        cursor: pointer;\n";
$htmlContent .= "    }\n";
$htmlContent .= "    #save-button:hover {\n";
$htmlContent .= "        background-color: #0056b3;\n";
$htmlContent .= "    }\n";
$htmlContent .= "    #cancel-button {\n";
$htmlContent .= "        background-color: #ccc;\n";
$htmlContent .= "        color: white;\n";
$htmlContent .= "        border: none;\n";
$htmlContent .= "        border-radius: 5px;\n";
$htmlContent .= "        padding: 10px 20px;\n";
$htmlContent .= "        cursor: pointer;\n";
$htmlContent .= "    }\n";
$htmlContent .= "    #cancel-button:hover {\n";
$htmlContent .= "        background-color: #999;\n";
$htmlContent .= "    }\n";
$htmlContent .= "    .popup {\n";
$htmlContent .= "        display: none;\n";
$htmlContent .= "        position: fixed;\n";
$htmlContent .= "        top: 50%;\n";
$htmlContent .= "        left: 50%;\n";
$htmlContent .= "        transform: translate(-50%, -50%);\n";
$htmlContent .= "        background-color: rgba(0, 255, 0, 0.8); /* Verde sfumato per successo */\n";
$htmlContent .= "        color: white;\n";
$htmlContent .= "        padding: 10px;\n";
$htmlContent .= "        border-radius: 5px;\n";
$htmlContent .= "        text-align: center;\n";
$htmlContent .= "        z-index: 2;\n";
$htmlContent .= "    }\n";
$htmlContent .= "    #error-popup {\n";
$htmlContent .= "        background-color: rgba(255, 0, 0, 0.8); /* Rosso sfumato per errore */\n";
$htmlContent .= "    }\n";
$htmlContent .= "    footer {\n";
$htmlContent .= "        background-color: #333;\n";
$htmlContent .= "        color: white;\n";
$htmlContent .= "        text-align: center;\n";
$htmlContent .= "        padding: 20px 0;\n";
$htmlContent .= "        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);\n";
$htmlContent .= "        position: relative;\n";
$htmlContent .= "    }\n";
$htmlContent .= "    .footer-content {\n";
$htmlContent .= "        position: absolute;\n";
$htmlContent .= "        top: 50%;\n";
$htmlContent .= "        left: 50%;\n";
$htmlContent .= "        transform: translate(-50%, -50%);\n";
$htmlContent .= "    }\n";
$htmlContent .= "    h1 {\n";
$htmlContent .= "        font-size: 48px;\n";
$htmlContent .= "        font-weight: bold;\n";
$htmlContent .= "        text-transform: uppercase;\n";
$htmlContent .= "        margin: 0;\n";
$htmlContent .= "        animation: slide-up 1s ease-in-out;\n";
$htmlContent .= "    }\n";
$htmlContent .= "    </style>\n";
$htmlContent .= "</head>\n";
$htmlContent .= "<body>\n";
$htmlContent .= "    <header>\n";
$htmlContent .= "        <div class=\"logo\">Logo</div>\n";
$htmlContent .= "    </header>\n";
$htmlContent .= "    <main>\n";
$htmlContent .= "        <button class=\"rotate\" id=\"create-button\">Crea</button>\n";
$htmlContent .= "        <button class \"rotate\">Upload</button>\n";
$htmlContent .= "        <button class=\"rotate\">Elimina</button>\n";
$htmlContent .= "    </main>\n";
$htmlContent .= "    <div id=\"folder-container\" style=\"display: none;\">\n";
$htmlContent .= "        <img src=\"folder-icon.png\" alt=\"Cartella\" id=\"folder-icon\">\n";
$htmlContent .= "        <span id=\"folder-name\"></span>\n";
$htmlContent .= "    </div>\n";
$htmlContent .= "    <div id=\"create-modal\" class=\"modal\" style=\"display: none;\">\n";
$htmlContent .= "        <div class=\"modal-content\">\n";
$htmlContent .= "            <span class=\"close\" id=\"close-button\">&times;</span>\n";
$htmlContent .= "            <h2>Crea una nuova cartella</h2>\n";
$htmlContent .= "            <input type=\"text\" id=\"folder-input\" placeholder=\"Nome della cartella\">\n";
$htmlContent .= "            <button id=\"save-button\">Salva</button>\n";
$htmlContent .= "        </div>\n";
$htmlContent .= "    </div>\n";
$htmlContent .= "    <footer>\n";
$htmlContent .= "        <div class=\"footer-content\">\n";
$htmlContent .= "            <h1 class=\"slide-up\">Il Titolo della Pagina</h1>\n";
$htmlContent .= "        </div>\n";
$htmlContent .= "    </footer>\n";
$htmlContent .= "    <script src=\"script.js\"></script>\n";
$htmlContent .= "</body>\n";
$htmlContent .= "</html>";


    // Scrivi il contenuto nel file HTML
    $htmlFileName = $folderName . "/index.html";
    file_put_contents($htmlFileName, $htmlContent);

    // Restituisci una risposta appropriata come JSON
    $response = ["message" => "Cartella e file HTML creati con successo"];
    header("Content-Type: application/json");
    echo json_encode($response);
}
