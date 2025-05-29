
<?php
   session_start();

   require_once 'image_util.php'; 

    $image_dir = 'images';
    $image_dir_path = getcwd() . DIRECTORY_SEPARATOR . $image_dir;

    if (isset($_FILES['file1']))
    {
        $filename = $_FILES['file1']['name'];

        if (!empty($filename))
        {
            $source = $_FILES['file1']['tmp_name'];
            $target = $image_dir_path . DIRECTORY_SEPARATOR . $filename;

            move_uploaded_file($source, $target);

            process_image($image_dir_path, $filename);
        }
    }

   $book_name = filter_input(INPUT_POST, 'book_name');
   $author_name = filter_input(INPUT_POST, 'author_name');
   $publisher = filter_input(INPUT_POST, 'publisher');
   $status = filter_input(INPUT_POST, 'status'); // assigns the value of the selected radio button
   $year = filter_input(INPUT_POST, 'year');
   $image_name = $_FILES['file1']['name'];

    require_once('database.php');
    $queryBooks = 'SELECT * FROM books';
    $statement1 = $db->prepare($queryBooks);
    $statement1->execute();
    $books = $statement1->fetchAll();

    $statement1->closeCursor();

    foreach ($books as $book)
    { 
      if ($book_name == $book["bookName"])
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
          $_SESSION["add_error"] = "invalid book data, check all fields and Try again."

          $url = "error.php";
          header("Location: " . $url);
          die();
        }
        else
        {
          require_once('database.php');

       $query = 'INSERT INTO BOOKS
       (bookName, authorName, publisher, status, year, imageName)
       VALUES
       (:bookName, :authorName, :publisher, :status, :year, :imageName)';

       $statement = $db->prepare($query);
       $statement->bindValue(':bookName', $book_name);
       $statement->bindValue(':authorName', $author_name);
       $statement->bindValue(':publisher', $publisher);
       $statement->bindValue(':status', $status);   
       $statement->bindValue(':year', $year);
       $statement->bindValue(':imageName', $image_name);
   
       $statement->executed();
       $statement->loseCurser();

 }

   $_SESSION["fullName"] = $book_name . " " . $author_name;

   $url = "confirmation.php";
   header("Location: " . $url);
   die(); 

?>