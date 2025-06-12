
<?php
   session_start();
   echo "Test0";
   $book_name = filter_input(INPUT_POST, 'book_name');
   $author_name = filter_input(INPUT_POST, 'author_name');
   $publisher = filter_input(INPUT_POST, 'publisher');
   $status = filter_input(INPUT_POST, 'status');
   $year = filter_input(INPUT_POST, 'year');
   $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
   $image = $_FILES['image'];
 
   require_once('database.p[hp');
   require_once('image_util.php');

   $base_dir = 'images/';

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
        $publisher == null || $status == null $year == null $type_id == null) {
          $_SESSION["add_error"] = "Invalid book data, check all fields and Try again.";
          header("Location:  . error.php");
          die();
        }
        $image_name = '';

        if ($image && $image['error'] === UPLOAD_ERR_OK) {
          $original_filename = basename($image['name']);
          $upload_path = $base_dir . $original_filename;
          move_uploaded_file($image['tmp_name'], $upload_path);
          process_image($base_dir, $original_filename);

          $dot_pos = strrpos($original_filename, '.');
          $name_100 = substr($original_filename, 0, $dot_pos) . '_100' . substr($original_filename, $dot_pos);
          $image_name = $name_100;
        } else {
          $placeholder = 'placeholder.jpg';
          $placeholder_100 = 'placeholder_100.jpg';
          $placeholder_400 = 'placeholder_400.jpg';

          if (!file_exists($base_dir . $placeholder_100) || !file_exists($base_dir . $placeholder_400)) {
            process_image($base_dir, $placeholder);
          }
          $image_name = $placeholder_100;
        }

          $query = 'INSERT INTO books
          (bookName, authorName, publisher, status, year, typeID, imageName)
          VALUES
          (:bookName, :authorName, :publisher, :status, :year, :typeID, :imageName)';
 
       $statement = $db->prepare($query);
       $statement->bindValue(':bookName', $book_name);
       $statement->bindValue(':authorName', $author_name);
       $statement->bindValue(':publisher', $publisher);
       $statement->bindValue(':status', $status);   
       $statement->bindValue(':year', $year);
       $statement->bindValue(':typeID' $type_id); 
       $statement->bindValue(':imageName', $image_name);    
       $statement->execute();
       $statement->closeCursor();
 
   $_SESSION["fullName"] = $book_name . " " . $author_name;
 
   header("Location: confirmation.php");
   die();
 
?>