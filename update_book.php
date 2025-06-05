<?php
   seesion_start();

   $book_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);

   $book_name = filter_input(INPUT_POST, 'book_name');
   $author_name = filter_input(INPUT_POST, 'author_name');
   $publisher = filter_input(INPUT_POST, 'publisher');
   $staus = filter_input(INPUT_POST, 'status');
   $year = filter_input(INPUT_POST, 'year');
   $type_id = filter_input(INPUT_POST, 'type_id' FILTER_VALIDATE_INT);
   $image = $_FILES['image'];

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
        header("Location:  error.php");
        die();
      }
    }

    if ($book_name == null || $author_name == null ||
        $publisher == null || $status == null || $year == null || $type_id == null)
        {
          $_SESSION["add_error"] = "invalid data, duplicate book name. Try again.";
          header("Location: error.php");
          die();
        }
        require_once('image_util.php');
        $query = 'SELECT imageName FROM books WHERE bookID = bookID';
        $statement = $db->prepare($query);
        $statement->bindValue(':bookID', $book_id);
        $staement->execute();
        $current = $staement->fetch();
        $current_image_name = $current['imageName'];
        $staement->closeCursor();

          $image_name = $current_image_name;

          if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $base_dir = 'images/';
            if ($current_image_name) {
                $dot = strrpos($current_image_name, '_100.');
                if ($dot !== false) {
                    $original_name = substr($current_image_name, 0, $dot) . substr($current_image_name, $dot + 4);
                    $original = $base_dir . $original_name;
                    $img_100 = $base_dir . $current_image_name;
                    $img_400 = $base_dir . substr($current_image_name, 0, $dot) . '_400' . substr($current_image_name, $dot + 4);
        
                    if (file_exists($original)) unlink($original);
                    if (file_exists($img_100)) unlink($img_100);
                    if (file_exists($img_400)) unlink($img_400);
                }
            }
    $original_filename = basename($image['name']);
    $upload_path = $base_dir . $original_filename;
    move_uploaded_file($image['tmp_name'], $upload_path);
    process_image($base_dir, $original_filename);

    // Save new _100 filename for database
    $dot_position = strrpos($original_filename, '.');
    $name_without_ext = substr($original_filename, 0, $dot_position);
    $extension = substr($original_filename, $dot_position);
    $image_name = $name_without_ext . '_100' . $extension;
}

$query = 'UPDATE books
    SET bookName = :bookName,
        authorName = :authorName,
        publisher = :publisher,
        status = :status,
        year = :year,
        typeID = :typeID,
        imageName = :imageName
    WHERE bookID = :bookID';

    $statement = $db->prepare($query);
    $statement->bindValue(':bookID', $book_id);
    $statement->bindValue(':bookName', $book_name);
    $statement->bindValue(':authorName', $author_name);
    $statement->bindValue(':publisher', $publisher);
    $statement->bindValue(':status', $status);   
    $statement->bindValue(':year', $year);
    $statement->bindValue(':typeID', $type_id);
    $statement->bindValue(':imageName', $image_name);
    $statement->bindValue(':bookID', $book_id);  
    $statement->executed();
    $statement->loseCurser();

      
   $_SESSION["fullName"] = $book_name . " " . $author_name;
   header("Location: update_confirmation.php");
   die(); 


?>