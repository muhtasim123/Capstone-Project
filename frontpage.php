<?php
session_start();
 ?>
<!DOCTYPE html>
<html>
<title>Ontario Shores</title>
<link rel="stylesheet" href="css/frontpage.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<body>
 <!-- service_area_start  -->
 <div class = "logo">
      <img src="logo100.png" class="image1">
    </div>
    <div class="service_area">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-7 col-md-10">
                    <div class="section_title text-center mb-95">
                        <h3>Dementia Advisor</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
                    </div>
                </div>
            </div>
            
			<div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="single_service">
                         <div class="service_thumb service_icon_bg_1 d-flex align-items-center justify-content-center">
							 <div class="service_icon">
								 <a href="<?php echo "admin/stafflogin.php"; ?>">
								 <img src="img/service/service_icon_1.png" alt="">
								 </a>
                             </div>
                         </div>
                         <div class="service_content text-center">
                            <h3>STAFF</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
                         </div>
                    </div>
					
                </div>
				
				
                <div class="col-lg-4 col-md-6">
                    <div class="single_service active">
                         <div class="service_thumb service_icon_bg_1 d-flex align-items-center justify-content-center">
                             <div class="service_icon">
                                 <a href="<?php echo "adminlogin.php"; ?>">
								 <img src="img/service/service_icon_2.png" alt="">
								 </a>
                             </div>
                         </div>
                         <div class="service_content text-center">
                            <h3>ADMIN</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
                         </div>
                    </div>
                </div>
			
				
                <div class="col-lg-4 col-md-6">
                    <div class="single_service">
                         <div class="service_thumb service_icon_bg_1 d-flex align-items-center justify-content-center">
                             <div class="service_icon">
                                 <a href="<?php echo "caregiverlogin.php"; ?>">
								 <img src="img/service/service_icon_3.png" alt="">
								 </a>
                             </div>
                         </div>
                         <div class="service_content text-center">
                            <h3>CAREGIVER</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service_area_end -->
</body>
</html>
