<?php
include 'admin/includes/config.php';
include 'change-password.php';
session_start();
error_reporting(0);
include('includes/config.php');
?>

<!doctype html>
<html lang="en">
<?php include 'include/header.php'; ?>

<head>
   <style>
/* Style for the popup window */
        .popup {
  display: none; /* Hide the popup by default */
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  /* overflow: auto; */
  background-color: rgba(0, 0, 0, 0.5);
}

.popup-content {
  background-color: #ffffff;
  margin: 10px auto;
  padding: 20px;
  max-width: 400px;
  /* border-radius: 30px; */
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
}

h2 {
  margin-top: 0;
}

form {
  margin-top: 20px;
}

label {
  display: block;
  font-weight: bold;
}

input[type="email"],
input[type="password"],
input[type="submit"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 50px;
  background-color: #eee;
}

input[type="submit"] {
  background-color: #008ecf;
  color: white;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #1db8ff;
}

</style>
</head>

<body>
   <div id="page" class="page">
      <!-- ***site header html start*** -->
      <?php include 'include/navbar.php'; ?>
      <main id="content" class="site-main">
         <!-- Inner Banner html start-->
         <section class="confirm-inner-page">
            <!-- ***Inner Banner html start form here*** -->
            <div class="inner-banner-wrap">
               <div class="inner-baner-container" style="background-image: url(assets/images/img7.jpg);">
                  <div class="container">
                     <div class="inner-banner-content">
                        <h1 class="page-title">Your Profile</h1>
                     </div>
                  </div>
               </div>
            </div>
            <!-- ***Inner Banner html end here*** -->
            <div class="confirmation-outer">
               <div class="container">
                  <div class="confirmation-inner">
                     <div class="row">
                        <?php
                        $id = $_SESSION['id'];
                        $sql = "SELECT * from users where id = $id";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                           foreach ($results as $result) {
                              //   print_r($result);

                        ?>
                        <?php }
                        }
                        ?>
                        <div class="col-lg-8 right-sidebar">
                           <div class="confirmation-details">
                              <h3>YOUR DETAILS</h3>
                              <table class="table">
                                 <tbody>
                                    <tr>
                                       <td>Name</td>
                                       <td><?php echo htmlentities($result->name); ?></td>
                                    </tr>

                                    <tr>
                                       <td>Email:</td>
                                       <td><?php echo htmlentities($result->email); ?></td>
                                    </tr>
                                    <tr>
                                       <td>Password:</td>
                                       <td>********</td>
                                    </tr>
                                    <tr>
                                       <td>Status:</td>
                                       <td><?php echo htmlentities($result->status); ?></td>
                                    </tr>
                                    <tr>
                                       <td>Registration Date:</td>
                                       <td><?php echo htmlentities($result->RegDate); ?></td>
                                    </tr>


                                 </tbody>
                              </table>
                              <!-- The popup window -->
                              <div id="popup" class="popup">
                                 <div class="popup-content">
                                    <span class="close" onclick="closePopup()">&times;</span>
                                    <h2>Change Password</h2>

                                    <form method="POST" action="">
                                       <label for="currentPassword">Current Password:</label>
                                       <input type="password" id="currentPassword" name="currentPassword"  required><br><br>

                                       <label for="newPassword">New Password:</label>
                                       <input type="password" id="newPassword" name="newPassword"  required><br><br>

                                       <label for="confirmPassword">Confirm Password:</label>
                                       <input type="password" id="confirmPassword" name="confirmPassword"  required><br><br>

                                       <input type="submit" value="Submit" name="submit">
                                    </form>
                                 </div>
                              </div>
                              <a onclick="openPopup()"><button class="outline-btn outline-btn-blue" >
                                 Change Password</button></a><br><br>
                                 <a href="./logout.php"><button class="outline-btn outline-btn-blue" >
                                 Log Out</button></a>


                           </div>

                        </div>


                        <div class="col-lg-4">
                        <a href="view-your-bookings.php"><div class="price-table-summary">
                              <h4 class="bg-title">
                                 View Your Bookings</h4>
                           </div></a>
                           
                           <div class="widget-bg widget-support-wrap">
                              <div class="icon">
                                 <i class="fas fa-phone-volume"></i>
                              </div>
                              <div class="support-content">
                                 <h5>HELP AND SUPPORT</h5>
                                 <a href="telto:12345678" class="phone">+91 8126XXXXXX</a>
                                 <small>Monday to Friday 9.00am - 7.30pm</small>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
            <div class="bg-img-fullcallback" style="background-image: url(assets/images/img7.jpg);">
               <div class="overlay"></div>
               <div class="container">
                  <div class="row">
                     <div class="col-lg-8 offset-lg-2 text-center">
                        <div class="callback-content">
                           <div class="video-button">
                              <a id="video-container" data-fancybox="video-gallery" href="https://www.youtube.com/watch?v=2OYar8OHEOU">
                                 <i class="fas fa-play"></i>
                              </a>
                           </div>
                           <h2 class="section-title">ARE YOU READY TO TRAVEL? REMEMBER US !!</h2>
                           <p>Traveling allows you to experience different parts of the world and immerse yourself in new cultures. You can try new foods, learn new customs, and see things you've never seen before.</p>
                           <div class="callback-btn">
                              <a href="package.php" class="round-btn">View Packages</a>
                              <a href="about.php" class="outline-btn outline-btn-white">Learn More</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </main>
      <?php include 'include/footer.php'; ?>
      <a id="backTotop" href="#" class="to-top-icon">
         <i class="fas fa-chevron-up"></i>
      </a>
      <!-- ***custom search field html*** -->
      <?php include 'include/custom_search.php'; ?>
      <!-- ***custom search field html*** -->
   </div>
   <!-- JavaScript -->
   <?php
   include 'include/javascript.php';
   ?>
   <script>
      function openPopup() {
         document.getElementById("popup").style.display = "block";
      }

      function closePopup() {
         document.getElementById("popup").style.display = "none";
      }
   </script>
</body>

</html>