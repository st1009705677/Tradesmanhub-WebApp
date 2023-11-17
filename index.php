<?php 
include('includes/navbar.php'); 
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
  header('location: search.php');
  die();
}
?>
     
  <div class="row" style="background-color:#E09F3E; align-items:center; flexl-direction:row;">  
    <img src="images/dash-01.png" style="width:50%;" alt=""/>    
    <div class="welcome-text" style="text-align:start; padding:3rem; display:flex; flex-direction:column; align-items:center; justify-content:center; height:100%; width:50%;">
      <h2 class="display-3" style="width:100%; color:#fff; font-weight:bold;">Hire <br>A ServProv <br><span style="font-weight:300 !important;">Anytime Now</span></h2>
      <p class="lead" style="color:#fff; font-weight:normal; width:100%;">
        Make an appointment for the <br>service you need. 
      </p>
      <form method="get" action="search.php" class="w-100 h-100">
        <div class="search_bar" style="justify-content:start; width:100%;">
          <input class="form-control col-sm-8" name="query" type="text" placeholder="Search for a service" style="height:3rem; border-radius:1rem 0 0 1rem;">
          <button type="submit" class="btn search-btn"  style="height:3rem !important; border-radius:0 1.2rem 1.2rem 0;"><i class="ri-search-line"></i></button>
        </div>
      </form>      
    </div>     

  </div>       
      <?php include('includes/footer.php'); ?> 
</body>
</html>
