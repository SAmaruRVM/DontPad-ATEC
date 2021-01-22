<?php
    class Note
    {
        private $connection;
        private $identifier;
        public function __construct(Connection $connectionDB, string $identifier)
        {
            $this->connection = $connectionDB->getConnection();
            $this->identifier = $identifier;
        }
        public function updateNote(string $textNote) : void
        {
            try {
                $stmt = $this->connection->prepare("CALL spNote_UpdateNote(?,?)");
                $stmt->execute([$this->identifier, $textNote]);
            } catch (Error $e) {
                header("Location: " . ERROR_PAGE);
            }
        }
        public function insertNote(string $identifier) : Note
        {
            try {
                $stmt = $this->connection->prepare("CALL spNote_InsertNote(?)");
                $stmt->execute([$identifier]);
                return new Note(new Connection(), $identifier);
            } catch (Error $e) {
                header("Location: " . ERROR_PAGE);
            }
        }
        public function getNoteContent() : string
        {
            try {
                $stmt = $this->connection->prepare("CALL spNote_GetById(?)");
                $stmt->execute([$this->identifier]);
                $note = $stmt->fetch(PDO::FETCH_OBJ);
                return !empty(trim($note->text_note)) ? $note->text_note : "";
            } catch (Exception $e) {
                header("Location: " . ERROR_PAGE);
            }
        }
        public function checkIfExists() : bool
        {
            try {
                $stmt = $this->connection->prepare("CALL spNote_GetById(?)");
                $stmt->execute([$this->identifier]);
                return $stmt->rowCount() > 0;
            } catch (Error $e) {
                header("Location: " . ERROR_PAGE);
            }
        }
        public function getIndentifier() : string
        {
            return $this->identifier;
        }
    }