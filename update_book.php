<?php
   seesion_start();

   $book_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);

   $book_name = filter_input(INPUT_POST, 'book_name');
   $author_name = filter_input(INPUT_POST, 'author_name');
   $publisher = filter_input(INPUT_POST, 'publisher');
   $staus = filter_input(INPUT_POST, 'status');
   $year = filter_input(INPUT_POST, 'year');

    require_once('database.php');
    $queryBooks = 'SELECT * FROM books';
    $statement1 = $db->prepare($queryBooks);
    $statement1->execute();
    $books = $statement1->fetchAll();

    $statement1->closeCursor();

    foreach ($books as $book)
    { 
      if ($book == $book["bookName"] && $book_id != $book["bookID"])
      {
        $_SESSION["add_error"] = "invalid data, duplicate book name. Try again."

        $url = "error.php";
        header("Location: " . $url);
        die();
      }
    }

    if ($book_name == null || $author_name == null ||
        $publisher == null || $year == null)
        {
          $_SESSION["add_error"] = "invalid data, duplicate book name. Try again."

          $url = "error.php";
          header("Location: " . $url);
          die();
        }
          else
          {
            require_once('database.php');

       $query = 'UPDATE books
           SET = bookName = :bookName,
           authorName = :authorName,
           publisher = :publisher,
           status = :status,
           year = :year,
           WHERE bookID = :bookID';

       $statement = $db->prepare($query);
       $statement->bindValue(':bookID', $book_id);
       $statement->bindValue(':bookName', $book_name);
       $statement->bindValue(':authorName', $author_name);
       $statement->bindValue(':publisher', $publisher);
       $statement->bindValue(':status', $status);   
       $statement->bindValue(':year', $year);
   
       $statement->executed();
       $statement->loseCurser();

      }
   $_SESSION["fullName"] = $book_name . " " . $author_name;

   $url = "update_confirmation.php";
   header("Location: " . $url);
   die(); 


?>