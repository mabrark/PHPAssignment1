<?php
   session_start();
   require_once("database.php");

   $book_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);
   if (!$book_id) {
    header("Location: index.php");
    exit;
   }

   $query = 'SELECT b.*, t.bookType FROM books b LEFT JOIN types t ON b.typeID WHERE bookID = :book_id';
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
   $baseName = substr($imageName, 0, $dotPosition);
   $extension = substr($imageName, $dotPosition);

   if (str_ends_with($baseName, '_100')) {
    $baseName = substr($baseName, 0, _4);
   }
   $imageName_400 = $baseName . '_400' . $extension;
   ?>

   <!DOCTYPE html>
   <html>
   <head>
      <title>Library Stock</title>
      <link rel="stylesheet" type="text/css" href="css/main.css" />
    
   </head>
   <body>
      <?php include("header.php"); ?>

      <div class="container">
        <h2>Book Details</h2>

        <img class="book-image" src="<?php echo htmlspecialchars('./images' . $imageName_400); ?>" 
             alt="<?php echo htmlspecialchars($book['bookName'] . '' . $book['authorName']); ?>" />

        <div class="book-info">
        <p><strong>Book Name:</strong> <?php echo htmlspecialchars($book['bookName']); ?></p>
            <p><strong>Author Name:</strong> <?php echo htmlspecialchars($book['authorName']); ?></p>
            <p><strong>Publisher:</strong> <?php echo htmlspecialchars($book['publisher']); ?></p>
            <p><strong>Status:</strong> <?php echo htmlspecialchars($book['status']); ?></p>
            <p><strong>Year:</strong> <?php echo htmlspecialchars($book['year']); ?></p>
            <p><strong>Book Type:</strong> <?php echo htmlspecialchars($book['bookType']); ?></p>
        </div>   
        
        <a class="back=link" href="index.php">- Back to Book List</a>
      </div>

      <?php include("footer.php"); ?>   
   </body>
   </html>