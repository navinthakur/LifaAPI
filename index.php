<?php include("header.php");?>
<div class="back-to-home rounded  d-sm-block">
    <a href="login/" class="text-white title-dark rounded d-inline-block text-center"><i data-feather="user" class="fea icon-sm"></i></a>
</div>
        <!-- COMING SOON PAGE -->
        <section class="bg-home d-flex align-items-center" data-jarallax='{"speed": 0.5}' style="background-image: url('images/comingsoon.jpg');">
            <div class="bg-overlay"></div>

            <div class="container">
                <div class="row justify-content-center">
                    <!-- <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Well done!</strong> You successfully read this important alert message.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true"> × </span>
                      </button>
                    </div> -->
                    <div class="col-lg-8 col-md-12 text-center">
                        <a href="index.php" style="font-size: 40px" class="text-white title-dark logo h5">Law in First Attempt<span class="text-primary"></span></a>
                        <div class="text-uppercase title-dark text-white mt-2 mb-4 coming-soon">We're Coming soon...</div>
                        <p class="text-light para-desc para-dark mx-auto">Law in First Attempt India's Largest learning platform for law students. Prepare for examinations and take any number of courses from various topics.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <div id="countdown"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">  
                        <a href="#" data-toggle="modal" data-target="#LoginForm" class="btn btn-primary mt-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle fea icon-sm icons"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> Contact Us</a>
                    </div>
                </div>
                 <!-- Modal Content Start -->
                <div class="modal fade" id="LoginForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content rounded shadow border-0">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Contact Us </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="">
                                   <div class="p-4">
                                    <div class="alertmsgdiv" role="alert">
                                      
                                    </div>
                                        <form>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group position-relative">
                                                        <label>Your Name <span class="text-danger">*</span></label>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user fea icon-sm icons"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                                        <input name="contactpersonname" id="contactpersonname" type="text" class="form-control pl-5" placeholder="First Name :">
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-md-6">
                                                    <div class="form-group position-relative">
                                                        <label>Mobile Number <span class="text-danger">*</span></label>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail fea icon-sm icons"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                                                        <input name="contactmobileno" id="contactmobileno" type="text" class="form-control pl-5" placeholder="Your Mobile Number :">
                                                    </div> 
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-12">
                                                    <div class="form-group position-relative">
                                                        <label>Your Email</label>
                                                        
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone fea icon-sm icons"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                                        <input name="contactemail" id="contactemail" class="form-control pl-5" placeholder="Your Email :">
                                                    </div>                                                                               
                                                </div><!--end col-->
                                                <div class="col-md-12">
                                                    <div class="form-group position-relative">
                                                        <label>Comments</label>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle fea icon-sm icons"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                                        <textarea name="contactcomments" id="contactcomments" rows="4" class="form-control pl-5" placeholder="Your Message :"></textarea>
                                                    </div>
                                                </div>
                                            </div><!--end row-->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="button" id="btnSubmitContactForm" name="btnSubmitContactForm" class="btn btn-primary" value="Submit Details">
                                                </div><!--end col-->
                                            </div><!--end row-->
                                        </form><!--end form-->
                                    </div>                                                   
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Content End -->
            </div> <!-- end container -->
        </section><!--section end-->
        <!-- COMING SOON PAGE -->

        
<?php include("footer.php");?>