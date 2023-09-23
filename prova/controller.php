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
    $htmlContent .= "    <link rel=\"stylesheet\" href=\"style.css\">\n";
    $htmlContent .= "    <title>La Mia Pagina</title>\n";
    $htmlContent .= "</head>\n";
    $htmlContent .= "<body>\n";
    $htmlContent .= "    <header>\n";
    $htmlContent .= "        <div class=\"logo\">Logo</div>\n";
    $htmlContent .= "    </header>\n";
    $htmlContent .= "    <main>\n";
    $htmlContent .= "        <button class=\"rotate\" id=\"create-button\">Crea</button>\n";
    $htmlContent .= "        <button class=\"rotate\">Upload</button>\n";
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
