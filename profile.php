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
            <a href="index.php" style=" text-decoration: none;">  <span>Home</span></a>
			
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
 //hashtag.php  
 if(isset($_GET["tag"]))  
 {  
      $tag = preg_replace("#[^a-zA-Z0-9_]#", '', $_GET["tag"]);  
      echo '<h1>' . $tag . '</h1>';  
      $connect = mysqli_connect("localhost", "root", "password", "videos");  
      $query = "SELECT * FROM videos where usuario LIKE '%".$tag."%'";  
      $result = mysqli_query($connect, $query);  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                echo '<p>'.$row["blog_title"].'</p><hr>';
                			
           }  
      }  
      else  
      {  
           echo '<p>No Data Found</p>';  
      }  
 }  
 ?> 
         

         <?php
		 $user=$_SESSION["username"];
    $query = $db->prepare("SELECT * FROM videos where usuario='$user'");
    $query->execute();
    $data = $query->fetchAll();
        foreach ($data as $row):
		    
            $ubicacion = $row['ubicacion'];
			echo "<div class='author'> <span class='material-icons'>
person_2</span>";
            echo $row['usuario'];
			echo"<div class='title'>
                <h3>";	  
			echo $row['nombre'];
			echo "</h3><span>179K • 8 Months Ago</span></div>";
			echo "<div class='video'>";
			
            echo "<video src='videos/".$ubicacion."' controls width='100%' height='200px' >";

            echo "</div>";
			
			
        endforeach;
        ?>
              
         
          
            
       
       </div>
     </div>
    </div>
    <script src="index.js"></script>
    <!-- Main Body Ends -->
  </body>
</html>
