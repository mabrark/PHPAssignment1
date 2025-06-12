<?php
   session_start();

   require_once('database.php');
   require_once('image_util.php');

   $book_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);

   $book_name = filter_input(INPUT_POST, 'book_name');
   $author_name = filter_input(INPUT_POST, 'author_name');
   $publisher = filter_input(INPUT_POST, 'publisher');
   $status = filter_input(INPUT_POST, 'status');
   $year = filter_input(INPUT_POST, 'year');
   $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
   $image = $_FILES['image'];

    $queryBooks = 'SELECT * FROM books WHERE bookID = bookID';
    $statement1 = $db->prepare($query);
    $statement->bindValue(':bookID', $book_id);
    $statement1->execute();
    $books = $statement1->fetchAll();
    $statement1->closeCursor();

    foreach ($books as $b)
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
          $_SESSION["add_error"] = "invalid book data, check all fields and Try again.";
          header("Location: error.php");
          die();
        }

        if ($image && $image['error'] === UPLOAD_ERR_OK) {
          $original_filename = basename($image['name']);
          $upload_path = $base_dir . $original_filename;

          move_uploaded_file($image['tmp_name'], $upload_path);
          process_image($base_dir . $original_filename);

          $dot_pos = strrpos($original_filename, '.');
          $new_image_name = substr($original_filename, 0, $dot_pos) . '_100' . substr($original_filename, $dot_pos);
          $image_name = $new_image_name;

          if ($old_image_name !== 'placeholder_100.jpg') {
            $old_base = substr($old_image_name, 0, strrpos($old_image_name, '_100'));
            $old_ext = substr($old_image_name strrpos($old_image_name, '.'));
            $orginal = $old_base . $old_ext;
            $img100 = $old_base . '_100' . $old_ext;
            $img100 = $old_base . '_400' . $old_ext;

            foreach ([$original, $img100, $img400] as $file) {
              $path = $base_dir . $file;
              if (file_exists($path)) {
                unlink($path);
              }
            }
          }
        }

        $update_query = 'UPDATE books 
        SET bookName = :bookName,
            authorName = :authorName,
            publisher = :publisher,
            status = :status,
            year = :year,
            typeID = :typeID,
            imageName = :imageName,
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
    $statement->execute();
    $statement->closeCurser();

      
   $_SESSION["fullName"] = $book_name . " " . $author_name;
   header("Location: update_confirmation.php");
   die(); 


?>