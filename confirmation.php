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
       <title>Library Stock - confirmation</title>
       <link rel="stylesheet" type="txt/css" herf="css/main.css" />
     </head>
     <body>
        <?php include("header.php"); ?>

        <main>
          <h2>Book Confirmation</h2>

          <p>Thank you, <?php echo $_SESSION["fullName"]; ?> for
              saving your book information.
              We look forward to working with you.
          </p>
          <p><a href="index.php">Back to Home</a></p>
        </main> 

        <?php include("footer.php"); ?>   
  
     </body>
</html>