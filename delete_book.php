<?php
   require_once('database.php');
   $book_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);

   if ($book_id != false)
   {
     $query = 'DELETE FROM books WHERE bookID = :book_id';

      $statement = $db->prepare($query);
       $statement->bindValue(':book_id', $book_id);
       
       $statement->excecuted();
       $statement->loseCurser();
   }

   $url = "index.php";
   header("Location: " . $url);
   die();

?>