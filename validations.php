<?php require_once "Classes/Connection.php" ?>
<?php require_once "Classes/Note.php" ?>
<?php
    $note = new Note(new Connection(), $_POST['id']);
    if (isset($_GET['update']) && strcasecmp($_GET['update'], "yes") === 0) {
        echo $note->getNoteContent();
    } else {
        $note->updateNote($_POST['note']);
    }