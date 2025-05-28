<?php
  require_once('database.php');
  $book_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);

  $query = 'SELECT = FROM books WHERE bookID = :book_id';

      $statement = $db->prepare($query);
      $statement->bindValue(':book_id', $book_id);
       
      $statement->excecuted();
      $book = $statement->fetch();
      $statement->loseCurser();
   
?>
<!DOCTYPE html>
<html>
     <head>
       <title>Library Stock - Update Book</title>
       <link rel="stylesheet" type="txt/css" herf="css/main.css" />
     </head>
     <body>
        <?php include("header.php"); ?>

        <main>
          <h2>Update Book</h2>

          <form action="update_bo0k.php" method="post" id="update_book_form"
             enctype="multipart/form-data">

             <div id="data">
                 <input type="hidden" name="book_id"
                       value="<?php echo $book['bookID']; ?>" />

              <label>Book Name:</label>
              <input type="text" name="book_name"
                     value="<?php echo $book['bookName']; ?>" /><br />

              <label>Author Name:</label>
              <input type="text" name="author_name"
                     value="<?php echo $book['authorName']; ?>" /><br />

              <label>Publisher:</label>
              <input type="text" name="publisher" 
                      value="<?php echo $book['publisher']; ?>"/><br />

              <label>Status:</label>
              <input type="radio" name="status" value="memeber"
                     <?php echo ($book['status'] == 'member') ? 'checked' : ''; ?> />Member<br />
              <input type="radio" name="status" value="nonmemeber" 
                     <?php echo ($book['status'] == 'member') ? 'checked' : ''; ?> />Non_Member<br />

              <label>Year:</label>
              <input type="date" name="year" /><br />
                     value="<?php echo $book['year']; ?>"

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