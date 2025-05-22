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
       <title>Library Stock - Home</title>
       <link rel="stylesheet" type="txt/css" herf="css/main.css" />
     </head>
     <body>
        <?php include("header.php"); ?>

        <main>
          <h2>Book List</h2>

          <table>
            <tr>
              <th>Book Name</th>
              <th>Author Name</th>
              <th> Publisher</th>
              <th>Year</th>
              </tr>

              <?php foreach ($books as $book): ?>
                <tr>
                  <td><?php echo $book['bookName']; ?></td>
                  <td><?php echo $book['authorName']; ?></td>
                  <td><?php echo $book['publisher']; ?></td>
                  <td><?php echo $book['year']; ?></td>
                </tr>
              <?php endforeach; ?>  
          </table>
        </main> 

        <?php include("footer.php"); ?>   
  
     </body>
</html>