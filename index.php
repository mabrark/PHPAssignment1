<?php
    session_start();
    require("database.php");

    
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
          </table>
        </main> 

        <?php include("footer.php"); ?>   
  
     </body>
</html>