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
    include("config1.php");
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
	<style> 
input {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
 border-radius: 150px;
  

}
.button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

input, label {
    display: block;
}

input[type=file]::-webkit-file-upload-button {
    border: 1px solid grey;
        background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
	{
</style>
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
        <i class="material-icons">apps</i>
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
            <span>Home</span>
			<?php echo htmlspecialchars($_SESSION["username"]); ?>
          </div>
          <div class="sidebar__category">
            <i class="material-icons">local_fire_department</i>
            <span>Trending</span>
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
            <span>Your Videos</span>
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
 
      <!-- Videos Section -->
      

        <?php  
        include("config.php");
		$usuario=$_SESSION["username"]; 
     
        if(isset($_POST['video_upload'])){
            $maxsize = 5242880; // 5MB
            $nombre_file = $_FILES['file_video']['name'];
			
			 //
			$image_info = explode(".", $nombre_file); 
			$nombre =format_uri($image_info[0]);
			$image_type = end($image_info);
			$file_video = $nombre."-".rand(10,999).".".$image_type;
			//
            $target_dir = "videos/";
            $target_file = $target_dir.$file_video;

            // Obtenemos la extension del archivo
            $videoFileType = strtolower(pathinfo($nombre_file,PATHINFO_EXTENSION));

            // extensiones validados
            $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

            // Revisar extension
            if( in_array($videoFileType,$extensions_arr) ){
                
                // Revisar el tamaño del archivo
                if(($_FILES['file_video']['size'] >= $maxsize) || ($_FILES["file_video"]["size"] == 0)) {
                    $error= "Archivo demasiado grande. El archivo debe ser menor que 5MB.";
                }else{
                    // Subir
                    if(move_uploaded_file($_FILES['file_video']['tmp_name'],$target_file)){
                        // Insertar registro
						$nombre = htmlentities($_POST['nombre']);
				        $usuario = htmlentities($_POST['usuario']);
						$query = $db->prepare("INSERT INTO `videos`(`nombre`, `ubicacion`, `usuario`)
						VALUES (:nombre,:ubicacion,:usuario)");
						$query->bindParam(":nombre", $nombre);
						
						$query->bindParam(":ubicacion", $file_video);
						$query->bindParam(":usuario", $usuario);
						$query->execute();
						    if($query->rowCount() > 0){
								header("location: index.php?estado=ok");
							}
                    }
                }

            }else{
                $error= "la extension del archivo es invalido.";
            }
        
        }
        ?>
    </head>
    <body>
    
    <header>
  <!-- Fixed navbar -->
  
          <a  href="index.php">Portada </a>
        </li> 
       
          <a href="ver_videos.php">Ver videos </a>
        </li>
      </ul>
      

<!-- Begin page content -->
<hr>

<h3>Subir videos</h3>
<?php echo htmlspecialchars($_SESSION["username"]); ?>
</div>
  <hr>  
  <?php
  if(isset($error)){
	  echo '<div> '.$error.'</div>';
	}
  ?>
  <?php
  if(isset($_GET["estado"])){
	  echo '<div> Video subido correctamente</div>';
	}
  ?>  
    <div class="row">
    
     <form method="post" action="" enctype='multipart/form-data'>
          <div class="form-group">
            <label for="exampleInputEmail1">Nombre de Video</label>
            <input name="nombre" type="text"  id="exampleInputEmail1" placeholder="Ingrese nombre">
            
			<input type="hidden" size="20" name="usuario"  value="<?php echo htmlspecialchars($_SESSION["username"]); ?>" />
		  </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Video</label>
<!--inicio-->
<div>
  <input class="input" name="file_video" type="file"  id="customFile" required>
  <label  for="customFile"></label>
</div>

<!--End:inicio-->
          </div>
          <button type="submit"name='video_upload' class="button">Subir Video</button>
	</form>

 </div>
 </div>
 </main>
 <footer>
  <div>
    <spanPie de pagina.</span>
  </div>
</footer>
    <!-- Aquí va el contenido de tu web -->
 
    <!-- JavaScript -->
    
    
  </body>
</html>
