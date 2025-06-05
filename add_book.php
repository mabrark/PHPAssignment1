
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
   $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);

   $file_name = $_FILES['file1']['name'];

   $i = strrpos($filename, '.');
   $image_name = substr($filename, 0, $i);
   $ext = substr($filename, $i);

   $image_name_100 = $image_name . '_100' . $ext;
 
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
        $_SESSION["add_error"] = "invalid data, duplicate book name. Try again.";
        header("Location:  error.php");
        die();
      }
    }
 
    if ($book_name == null || $author_name == null ||
        $publisher == null || $status == null $year == null $type == null)
        {
          $_SESSION["add_error"] = "invalid book data, check all fields and Try again.";
          header("Location:  . error.php");
          die();
        }
        else
        {
 
          $query = 'INSERT INTO books
          (bookName, authorName, publisher, status, year, imageName, typeID)
          VALUES
          (:bookName, :authorName, :publisher, :status, :year, :imageName :typeID)';
 
       $statement = $db->prepare($query);
       $statement->bindValue(':bookName', $book_name);
       $statement->bindValue(':authorName', $author_name);
       $statement->bindValue(':publisher', $publisher);
       $statement->bindValue(':status', $status);   
       $statement->bindValue(':year', $year);
       $statement->bindValue(':imageName', $image_name_100);
       $statement->bindValue(':typeID' $type_id);  
       $statement->execute();
       $statement->closeCursor();
 
}
 
   $_SESSION["fullName"] = $book_name . " " . $author_name;
 
   header("Location: confirmation.php");
   die();
 
?>