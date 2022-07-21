
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php
    include("config.php");
?>



    
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Material Icons -->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- CSS File -->
    <link rel="stylesheet" href="styles.css" />
    <title>GoolVideo</title>
  </head>
  <body>
    <!-- Header Starts -->
    <div class="header">
      <div class="header__left">
        <i id="menu" class="material-icons">menu</i>
        
         <span class="material-icons"> slideshow</span>
      </div>

      <div class="header__search">
        <form action="search.php" method="get">
          <input type="text" name="tag" placeholder="Search" />
          <button type="submit"><i class="material-icons">search</i></button>
        </form>
      </div>

      <div class="header__icons">
        <i class="material-icons display-this">search</i>
       <a href="subir.php" style=" text-decoration: none;">  <i class="material-icons">videocam</i></a>
      <a href="index.php" style=" text-decoration: none;">   <i class="material-icons">apps</i></a>
        <i class="material-icons">notifications</i>
        <i class="material-icons display-this">account_circle</i>
      </div>
    </div>
    <!-- Header Ends -->

    <!-- Main Body Starts -->
    <div class="mainBody">
      <!-- Sidebar Starts -->

      <div class="sidebar">
        <div class="sidebar__categories">
          <div class="sidebar__category">
            <i class="material-icons">home</i>
           <a href="chat.php" style=" text-decoration: none;">    <span>Home</span></a>
			
          </div>
		   <div class="sidebar__category">
            <i class="material-icons">account_circle</i>
            <span><?php echo htmlspecialchars($_SESSION["username"]); ?></span>
			
          </div>
          <div class="sidebar__category">
            <i class="material-icons">message</i>
           <a href="chat.php" style=" text-decoration: none;">   <span>Message</span></a>
          </div>
          <div class="sidebar__category">
            <i class="material-icons">subscriptions</i>
            <span>Subcriptions</span>
          </div>
        </div>
        <hr />
        <div class="sidebar__categories">
          <div class="sidebar__category">
            <i class="material-icons">library_add_check</i>
            <span>Library</span>
          </div>
          <div class="sidebar__category">
            <i class="material-icons">history</i>
            <span>History</span>
          </div>
          <div class="sidebar__category">
            <i class="material-icons">play_arrow</i>
          <a href="profile.php" style=" text-decoration: none;">  <span>Your Videos</span></a>
          </div>
          <div class="sidebar__category">
            <i class="material-icons">watch_later</i>
            <span>Watch Later</span>
          </div>
          <div class="sidebar__category">
            <i class="material-icons">logout</i>
           <a href="logout.php" style=" text-decoration: none;"> <span>Logout</span></a>
          </div>
        </div>
        <hr />
      </div>
      <!-- Sidebar Ends -->
	  <div class="videos">
      
	  <div class="videos__container">
 
      
 
  
    <form action="enviar.php" method="post">
            <center><table border="0">
            <tr><div id="contactArea">
                <td><strong></strong></td><td> <textarea  name="comentario" value=""  rows="10" cols="40" id="text"></textarea></td>
            </tr>
			<td><input name="usuario" type="hidden" size="42" maxlength="15" value="<?php echo htmlspecialchars($_SESSION["username"]); ?>"/></td>
            <tr>
            <td><strong></strong></td>  <td></td>
            
			</tr>
            <tr>
            <td colspan="2" align="center" >
			<div id="Sharer_btns">

			
			<button type="submit" type="button" name="enviar" class="button">Post</button></td>
            </div>
			</tr>
            </center></table>
        </form>
<hr>
<?php 
  // Se conecta al SGBD 
  if(!($conexion = mysql_connect("localhost", "root", "password"))) 
    die("Error: No se pudo conectar");
 
  // Selecciona la base de datos 
  if(!mysql_select_db("videos", $conexion)) 
    die("Error: No existe la base de datos");
 
  // Sentencia SQL: muestra todo el contenido de la tabla "books" 
  $sentencia = "SELECT * FROM comentarios  ORDER BY fecha DESC"; 
  // Ejecuta la sentencia SQL 
  $resultado = mysql_query($sentencia, $conexion); 
  if(!$resultado) 
    die("Error: no se pudo realizar la consulta");

 
  while($fila = mysql_fetch_assoc($resultado)) 
  { 
  
 
echo"<div class='tabHeader'>";	  
   echo "<a href='user.php?tag=" . $fila['usuario'] . "'>" . $fila['usuario'] . "</a><br/> <div class='tiempo'>" . $fila['fecha'] . "</div>";
  
       
   echo "<p>";
    echo $fila['comentario'] . '</p><br/></div>';
   echo "<hr>";
  
        
  } 
 echo "</div>";
  // Libera la memoria del resultado
  mysql_free_result($resultado);
  
  // Cierra la conexión con la base de datos 
  mysql_close($conexion); 
?> 
		
        </div>
     </div>
    </div>
    <script src="index.js"></script>
    <!-- Main Body Ends -->
  </body>
</html>
 

	
 
     
      
        
     
           
     
      
              

	  
	  
      

  
       
    

 <script src="index.js"></script>
    <!-- Main Body Ends -->
  </body>
</html>
