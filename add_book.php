
<?php
   seesion_start();

   //get data from the form
   //$book_name = $_POST['book_name'];
   $book_name = filter_input(INPUT_POST, 'book_name');
   $author_name = filter_input(INPUT_POST, 'author_name');
   $publisher = filter_input(INPUT_POST, 'publisher');
   $staus = filter_input(INPUT_POST, 'status');
   $year = filter_input(INPUT_POST, 'year');

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