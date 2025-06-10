<?php
   session_start();
   require_once("database.php");

   $book_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);
   if (!$book_id) {
    header("Location: index.php");
    exit;
   }

   $query = 'SELECT c.*, t.bookType FROM books c LEFT JOIN types t ON c.typeID WHERE bookID = :book_id';
   $statement = $db->prepare($query);
   $statement->bindValue(':book_id', $book_id);
   $statement->execute();
   $book = $statement->fetch();
   $statement->closeCursor();

   if (!$book) {
    echo "book not found.";
    exit;
   }

   $imageName = $book['imageName'];
   $dotPosition = strrpos($imageName, '.');