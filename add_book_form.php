
<!DOCTYPE html>
<html>
     <head>
       <title>Library Stock - Add Book</title>
       <link rel="stylesheet" type="text/css" href="css/main.css" />
     </head>
     <body>
        <?php include("header.php"); ?>

        <main>
          <h2>Add Book</h2>

          <form action="add_book.php" method="post" id="add_book_form"
             enctype="multipart/form-data">

             <div id="data">

              <label>Book Name:</label>
              <input type="text" name="book_name" /><br />

              <label>Author Name:</label>
              <input type="text" name="author_name" /><br />

              <label>Publisher:</label>
              <input type="text" name="publisher" /><br />

              <label>Status:</label>
              <input type="radio" name="status" value="member" />Member<br />
              <input type="radio" name="status" value="nonmember" />Non_Member<br />

              <label>Year:</label>
              <input type="date" name="year" /><br />

              <label>Upload Image:</label>
              <input type="file" name="file1" /><br />

             </div>

             <div id="button">

             <label>&nbsp;</label>
              <input type="submit" value="Save Book" /><br />

             </div>
           </form>

           <p><a href="index.php">View Book List</a></p>
        </main> 

        <?php include("footer.php"); ?>   
  
     </body>
</html>