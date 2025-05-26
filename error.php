<?php
    session_start();
    require("database.php");
    $queryBooks = 'SELECT * FROM books';
    $statement1 = $db->prepare($queryBooks);
    $statement1->excecute();
    $books = $statement1->fetchAll();

    $statement1->closeCursor();
?>

<!DOCTYPE html>
<html>
     <head>
       <title>Library Stock - Error</title>
       <link rel="stylesheet" type="txt/css" herf="css/main.css" />
     </head>
     <body>
        <?php include("header.php"); ?>

        <main>
          <h2>Error</h2>

          <p>
            <?php echo $_SESSION["add_error"]; ?> 
          </p>
          <p><a href="add_book_form.php">View Book List</a></p>
          <p><a href="index.php">View Book List</a></p>
        </main> 

        <?php include("footer.php"); ?>   
  
     </body>
</html>