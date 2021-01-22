 <?php $pageTitle = (isset($_GET['note'])) ? $_GET['note'] . " | Dontpad - ATEC" : "Dontpad - ATEC" ?>
 <?php require_once "Includes/config.php" ?>

 <body>
     <?php
        if (isset($_GET['note'])):
                $note = new Note(new Connection(), $_GET['note']);
                if (!$noteExists = $note->checkIfExists()) {
                    $note->insertNote($note->getIndentifier());
                }
            ?>
     <textarea id="note__text"
         placeholder="Your note here..."><?= $noteExists ? $note->getNoteContent() : null?></textarea>
     <?php else:?>

     <form action="" method="POST">
         <label for="urlNote">
             dontpadatec.com/note=?
         </label>
         <input id="urlNote" type="text" name="urlNote" placeholder="Name of the note" autofocus>
         <button type="submit">
             Create Note
         </button>
     </form>
     <?php endif; ?> <button id="change-theme">
         <i class="fas fa-moon"></i>
     </button>
 </body>