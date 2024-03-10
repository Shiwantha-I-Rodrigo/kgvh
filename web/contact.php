<?php
session_start();
include 'header.php';
include '../config.php';
?>


<div class="page_title">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="title">
               <h2>Contact Us</h2>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="contact">
   <div class="container">
      <div class="row">
         <div class="col-md-6">
            <form id="contact_us" class="main_form">
               <div class="row">
                  <div class="col-md-12 ">
                     <input class="inputs" placeholder="Name" type="type" name="Name">
                  </div>
                  <div class="col-md-12">
                     <input class="inputs" placeholder="Email" type="type" name="Email">
                  </div>
                  <div class="col-md-12">
                     <input class="inputs" placeholder="Phone Number" type="type" name="Phone Number">
                  </div>
                  <div class="col-md-12">
                     <textarea class="textareas" placeholder="Message" type="type" Message="Name"></textarea>
                  </div>
                  <div class="col-md-12">
                     <button class="sub_btn">Send Message</button>
                  </div>
               </div>
            </form>
         </div>
         <div class="col-md-6">
            <div class="map_main">
               <div class="map-responsive">
                  <iframe src=<?php global $_HOTEL_LOCATION; echo $_HOTEL_LOCATION ?> width="600" height="400" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<?php
include 'footer.php';
?>