
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
        <form action="user.php" method="get">
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
           <a href="index.php" style=" text-decoration: none;"> <span>Home</span></a>
          </div>
          <div class="sidebar__category">
            <i class="material-icons">search</i>
            <span><?php  
 //hashtag.php  
 if(isset($_GET["tag"]))  
 {  
      $tag = preg_replace("#[^a-zA-Z0-9_]#", '', $_GET["tag"]);  
      echo '<h1>' . $tag . '</h1>';  
      $connect = mysqli_connect("localhost", "root", "lolita1873", "videos");  
      $query = "SELECT * FROM videos where nombre LIKE '%".$tag."%'";  
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
 ?> </span>
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
            <i class="material-icons">thumb_up</i>
            <span>Liked Videos</span>
          </div>
        </div>
        <hr />
      </div>
      <!-- Sidebar Ends -->
 
      <!-- Videos Section -->
       <div class="videos">
       

        
         

       <?php
    $query = $db->prepare("SELECT * FROM videos  where nombre LIKE '%".$tag."%'");
    $query->execute();
    $data = $query->fetchAll();
        foreach ($data as $row):
		echo"<center><div class='title'>";
           echo "<div class='author'> <span class='material-icons'>
person_2</span>";		 
echo "<a href='user.php?tag=" . $row['usuario'] . "'>" . $row['usuario'] . "</a>";

 echo "<br>"; 		  
		  echo $row['nombre'];
		  echo "</div></div></center>";
            $ubicacion = $row['ubicacion'];
			echo "<div class='videos__container'>";
            echo "<div class='col-md-3'>";
            echo "<video src='videos/".$ubicacion."' controls width='100%' height='200px' >";
             echo "</div></div><br><br><br><br>";
        endforeach;
        ?>
              
         
          
            
         