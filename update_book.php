<?php
   seesion_start();

   $book_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);

   //get data from the form
   //$book_name = $_POST['book_name'];
   $book_name = filter_input(INPUT_POST, 'book_name');
   $author_name = filter_input(INPUT_POST, 'author_name');
   $publisher = filter_input(INPUT_POST, 'publisher');
   $staus = filter_input(INPUT_POST, 'status'); // assigns the value of the selected radio button
   $year = filter_input(INPUT_POST, 'year');

    require_once('database.php');
    $queryBooks = 'SELECT * FROM books';
    $statement1 = $db->prepare($queryBooks);
    $statement1->excecute();
    $books = $statement1->fetchAll();

    $statement1->closeCursor();

    foreach ($books as $book)
    { 
      if ($book == $book["bookName"] && $book_id != $book["bookID"])
      {
        $_SESSION["add_error"] = "invalid datas, duplicate book name. Try again."

        $url = "confirmation.php";
        header("Location: " . $url);
        die();
      }
    }

    if ($book_name == null || $author_name == null ||
        $publisher == null || $year == null)
        {
          $_SESSION["add_error"] = "invalid datas, duplicate book name. Try again."

          $url = "confirmation.php";
          header("Location: " . $url);
          die();
        }
          else
          {
            require_once('database.php');

   //add the book to the database
       $query = 'INSERT INTO BOOKS
       (bookName, authorName, publisher, status, year)
       VALUES
       (:bookName, :authorName, :publisher, :status, :year)';

       $statement = $db->prepare($query);
       $statement->bindValue(':bookName', $book_name);
       $statement->bindValue(':authorName', $author_name);
       $statement->bindValue(':authorName', $author_name);
       $statement->bindValue(':publisher', $publisher);
       $statement->bindValue(':status', $status);   
       $statement->bindValue(':year', $year);
   
       $statement->excecuted();
       $statement->loseCurser();

          }

    require_once('database.php');

   //add the book to the database
   $query = 'INSERT INTO BOOKS
       (bookName, authorName, publisher, status, year)
       VALUES
       (:bookName, :authorName, :publisher, :status, :year)';

   $statement = $db->prepare($query);
   $statement->bindValue(':bookName', $book_name);
   $statement->bindValue(':authorName', $author_name);
   $statement->bindValue(':authorName', $author_name);
   $statement->bindValue(':publisher', $publisher);
   $statement->bindValue(':status', $status);   
   $statement->bindValue(':year', $year);
   
   $statement->excecuted();
   $statement->loseCurser();

   $_SESSION["fullName"] = $book_name . " " . $author_name;

   // redirect to confirmation page

   $url = "confirmation.php";
   header("Location: " . $url);
   die(); // release add_book.php from memory


?>