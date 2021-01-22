<?php require_once "Classes/Connection.php" ?>
<?php require_once "Classes/Note.php" ?>
<?php
    if (!isset($_POST["id"])) {
        header("Location: index.php");
    }
    $note = new Note(new Connection(), $_POST['id']);
    if (isset($_GET['update']) && strcasecmp($_GET['update'], "yes") === 0) {
        echo $note->getNoteContent();
    } else {
        $note->updateNote(htmlentities($_POST['note']));
    }