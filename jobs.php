
 
<?php 
  $title = 'TrademanHub | Jobs';
  include('includes/navbar.php');

if(!isset($_SESSION['logged_in'])){
  header('location: login.php');
  die();
}

$request_url = $_SERVER['REQUEST_URI'];

?>
    <div class="row justify-content-center" style="display:initial;">

      <div class="row" style="margin-top:2rem;">
        <div class="col-sm-12 col-md-3 col-lg-3" style="">
          <nav class="nav flex-column post-tabs-container">
            <a class="nav-link <?php echo (strpos($request_url, 'posts') !== false || empty($_SERVER['QUERY_STRING'])) ? ' card' : ''; ?>" href="?posts">My Job Posts</a>
            <?php if(isset($_SESSION['logged_in'])){  // TODO(set to show when user is a service provider)?>
              <a class="nav-link<?php echo (strpos($request_url, 'requests') !== false) ? ' card' : ''; ?>" href="?requests">Job Requests</a>
              <a class="nav-link<?php echo (strpos($request_url, 'listings') !== false) ? ' card' : ''; ?>" href="?listings">Job Listings</a>
            <?php
            }
            ?>
          </nav>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8">
          <?php            
            $query = $_SERVER['QUERY_STRING'];
            $pages = array(
                'posts' => 'includes/my_posts.php',
                'requests' => 'includes/my_requests.php',
                'listings' => 'includes/job_listings.php' // Adjust the file path accordingly
            );

            // Check if the query parameter value exists in the mapping array
            if (array_key_exists($query, $pages)) {
                // Include the corresponding PHP file
                include($pages[$query]);
            } else {
                // Handle the case when the parameter value is not found (fallback to 'posts' in this example)
                include('includes/my_posts.php');
            }
          ?>
        </div>
      </div>
    </div>


    

<!-- Modal -->
<div class="modal modal-custom fade" id="questionnaireModal" tabindex="-1" role="dialog" aria-labelledby="questionnaireModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-custom" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="questionnaireModalLabel">Become a Service Provider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Connect with new customers and exceed your expected customer base</p>
        <a href="reg-servprov.php" style="color:#fff !important;" class="login-btn">Continue To Questionnaire</a>
      </div>
    </div>
  </div>
</div>



  </body>
</html>
