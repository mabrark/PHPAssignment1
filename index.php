<?php
    session_start();

    if (!isset($_SESSION["isLoggedIn"])) {
      header("Location: login_form.php");
      die();
    }

    require("database.php");
    $queryBooks = 'SELECT b.*, t.bookType 
                   FROM books b 
                   LEFT JOIN types t ON b.typeID = t.typeID';
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
              <th> Status</th>
              <th>Year</th>
              <th>Book Type</th>
              <th>Photo</th>
              <th>&nbsp;</th> 
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>

            <?php foreach ($books as $book): ?>
              <tr>
                <td><?php echo htmlspecialchars($book['bookName']); ?></td>
                <td><?php echo htmlspecialchars($book['authorName']); ?></td>
                <td><?php echo htmlspecialchars($book['publisher']); ?></td>
                <td><?php echo htmlspecialchars($book['status']); ?></td>
                <td><?php echo htmlspecialchars($book['year']); ?></td>
                <td><?php echo htmlspecialchars($book['bookType']); ?></td>
                <td>
                    <img src="<?php echo htmlspecialchars('./images/' . $book['imageName']); ?>" 
                         alt="<?php echo htmlspecialchars($book['bookName'] . '' . $book['authorName']); ?>" />
                </td>
                <td>
                    <form action="update_book_form.php" method="post">
                      <input type="hidden" name="book_id"
                          value="<?php echo $book['bookID']; ?>" />
                      <input type="submit" value="Update" />    
                    </form>
                </td>
                <td>
                  <form action="delete_book.php" method="post">
                      <input type="hidden" name="book_id"
                          value="<?php echo $book['bookID']; ?>" />
                      <input type="submit" value="Delete" />    
                    </form>
              
                 </td>
                 <td>
                  <form action="book_details.php" method="post">
                      <input type="hidden" name="book_id"
                          value="<?php echo $book['bookID']; ?>" />
                      <input type="submit" value="View Details" />    
                    </form>
              
                 </td>
                  
              </tr>
            <?php endforeach; ?>  
          </table>
          <p><a href="add_book_form.php">Add Book</a></p>
          <p><a href="logout.php">Logout</a></p>
        </main> 

        <?php include("footer.php"); ?>   
  
     </body>
</html>