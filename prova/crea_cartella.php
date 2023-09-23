<?php
$nuovaCartella = '/percorso/della/tua/directory/' . $_POST['folderName'];

if (!file_exists($nuovaCartella)) {
    mkdir($nuovaCartella, 0755, true);
    echo 'Cartella creata con successo.';
} else {
    echo 'La cartella esiste già.';
}
?>
