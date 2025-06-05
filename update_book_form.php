<?php
  require_once('database.php');
  $book_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);

  $query = 'SELECT * FROM books WHERE bookID = :book_id';

      $statement = $db->prepare($query);
      $statement->bindValue(':book_id', $book_id);     
      $statement->execute();
      $book = $statement->fetch();
      $statement->closeCurser();

      $queryTypes = 'SELECT * FROM types';
      $statement2 = $db->prepare($queryTypes);
      $statement2->execute();
      $types = $statement2->fetchAll();
      $statement2->closeCursor;
   
?>
<!DOCTYPE html>
<html>
     <head>
       <title>Library Stock - Update Book</title>
       <link rel="stylesheet" type="text/css" href="css/main.css" />
     </head>
     <body>
        <?php include("header.php"); ?>

        <main>
          <h2>Update Book</h2>

          <form action="update_book.php" method="post" enctype="multipart/form-data">
                 <input type="hidden" name="book_id" value="<?php echo $book['bookID']; ?>" />

              <div id="data">

              <label>Book Name:</label>
              <input type="text" name="book_name" value="<?php echo $book['bookName']; ?>" /><br />

              <label>Author Name:</label>
              <input type="text" name="author_name" value="<?php echo $book['authorName']; ?>" /><br />

              <label>Publisher:</label>
              <input type="text" name="publisher" value="<?php echo $book['publisher']; ?>"/><br />

              <label>Status:</label>
              <input type="radio" name="status" value="member"
                     <?php echo if ($book['status'] == 'member') echo 'checked' : ''; ?> />Member
              <input type="radio" name="status" value="nonmember" 
                     <?php if ($book['status'] == 'nonmember') echo 'checked' : ''; ?> />Non-Member<br />

              <label>Year:</label>
              <input type="date" name="year" value="<?php echo $book['year']; ?>" /><br />

              <label>Book Type</label>
              <select name="type_id">
                     <?php foreach ($types as $type): ?>
                        <option value="<?php echo $type['typeID']; ?>" <?php if ($type['typeID'] == $book['typeID']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($type['bookType']); ?>
                        </option>  
                     <?php endforeach; ?>     
              </select><br />

              <?php if (!empty($book['imageName'])): ?>
                     <label>Current Image:</label>
                     <img src="images/<?php echo htmlspecialchars($book['imageName']); ?>" height="100"><br />
              <?php endif; ?>
              
              <label>Update Image:</label>
              <input type="file" name="image"><br />
             </div>

             <div id="button">

             <label>&nbsp;</label>
              <input type="submit" value="Update Book" /><br />

             </div>
           </form>

           <p><a href="index.php">View Book List</a></p>
        </main> 
        <?php include("footer.php"); ?>     
     </body>
</html>