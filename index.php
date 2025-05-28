<?php
    session_start();
    require("database.php");
    $queryBooks = 'SELECT * FROM books';
    $statement1 = $db->prepare($queryBooks);
    $statement1->execute();
    $books = $statement1->fetchAll();

    $statement1->closeCursor();
?>

<!DOCTYPE html>
<html>
     <head>
       <title>Library Stock - Home</title>
       <link rel="stylesheet" type="text/css" href="css/main.css" />
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
              <th> status</th>
              <th>Year</th>
              <th>Photo</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              </tr>

              <?php foreach ($books as $book): ?>
                <tr>
                  <td><?php echo $book['bookName']; ?></td>
                  <td><?php echo $book['authorName']; ?></td>
                  <td><?php echo $book['publisher']; ?></td>
                  <td><?php echo $book['status']; ?></td>
                  <td><?php echo $book['year']; ?></td>
                  <td><img src="<?php echo htmlspecialchars('./images/' . $book['imageName']); ?>" alt="<?php echo htmlspecialchars('./images/' . $book['imageName']); ?>" style="width:auto; height: 100px;" /></td>
                  <td>
                    <form action="update_book_form.php" method="post">
                      <input type="hidden"name="book_id"
                          value="<?php echo $book['bookID']; ?>" />
                      <input type="submit" value="update" />    
                    </form>
                  </td>
                  <td>
                    <form action="delete_book_form.php" method="post" onsubmit="return confirm('Are you sure you want to delete this book?');">
                      <input type="hidden"name="book_id"
                          value="<?php echo $book['bookID']; ?>" />
                      <input type="submit" value="delete" />    
                    </form>
                  </td>
                  
                </tr>
              <?php endforeach; ?>  
          </table>
          <p><a href="add_book_form.php">add Book</a></p>
        </main> 

        <?php include("footer.php"); ?>   
  
     </body>
</html>