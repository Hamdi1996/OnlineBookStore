<?php 
require "../Admin/helpers/helpers.php";
require "../Admin/helpers/dbConnection.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $name          = CleanInputs($_POST['name']);
    $email         = CleanInputs($_POST['email']);
    $subject       = CleanInputs($_POST['subject']);
    $msg           = CleanInputs($_POST['msg']);


    $errors = [];

    if(!validate($name,1)){
        $errors['Name'] = "Name : Requierd Field";
      }elseif(!validate($name,2)){
       $errors['Name'] = "Name : Invalid Data";
      }
  
    if(!validate($email,1)){
        $errors['email'] = " Email : Requierd Field";
      }elseif(!validate($email,3)){
          $errors['email'] = "Email : Invalid Email";
      }

      if(!validate($subject,1)){
        $errors['subject'] = "subject : Requierd Field";
      }elseif(!validate($subject,2)){
          $errors['subject'] = "subject : Invalid Data";
        }  

      if(!validate($msg,1)){
        $errors['msg'] = "Msg : Requierd Field";
      }elseif(!validate($msg,2)){
          $errors['msg'] = "Msg : Invalid Data";
        }  


        if(count($errors) > 0){
            $_SESSION['Errors'] = $errors;
        }else{
             // login code .... 
          $sql = "INSERT INTO `contactus`(`name`, `email`, `subject`, `message`) VALUES ('$name','$email','$subject','$msg')";
          $op  = mysqli_query($con,$sql);
        //   echo mysqli_error($con);
        
          if($op){
           echo "<script> alert('Message Sent Successfully')</script>";
          }else{

            $_SESSION['Errors'] = ['Error in Your Credentials try Again .... '];
          }
        }}

?>



<?php require "./Layouts/header.php" ?>

 

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
	  
	  
      <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light site-navbar-target" id="ftco-navbar">
          <div class="container">
            <a class="navbar-brand" href="#">Books<span>.</span></a>
            <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="oi oi-menu"></span> Menu
            </button>
  
            <div class="collapse navbar-collapse" id="ftco-nav">
              <ul class="navbar-nav nav ml-auto">
                <li class="nav-item"><a href="#home-section" class="nav-link"><span>Home</span></a></li>
                <li class="nav-item"><a href="#about-section" class="nav-link"><span>About</span></a></li>
                <li class="nav-item"><a href="#testimonial-section" class="nav-link"><span>Reviews</span></a></li>
                <li class="nav-item"><a href="#projects-section" class="nav-link"><span>Books</span></a></li>
                <li class="nav-item"><a href="#contact-section" class="nav-link"><span>Contact</span></a></li>
                <?php if(isset($_SESSION['user'])) { ?>
                  <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user"></i> <?php echo $_SESSION['user']['name']; ?></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?php echo Furl('profile/profile.php') ?>">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo Furl('profile/index.php') ?>">Cart</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo Furl('logout.php');?>">Logout</a>
                    </div>
                </li>
            </ul>
                <?php }else {?>
                
                <li class="nav-item"><a href="signup.php" class="nav-link"><span>Register</span></a></li>
                <li class="nav-item"><a href="login.php" class="nav-link"><span>Login</span></a></li>
                <?php }?>
              </ul>
            </div>
          </div>
        </nav>
  
        <section class="hero-wrap js-fullheight">
        <div class="overlay"></div>
        <div class="container-fluid px-0">
            <div class="row d-md-flex no-gutters slider-text align-items-center js-fullheight justify-content-end">
                <img class="one-third js-fullheight align-self-end order-md-last img-fluid" src="<?php echo Furl('assets/images/undraw_book_lover_mkck.svg') ?>" alt="">
              <div class="one-forth d-flex align-items-center ftco-animate js-fullheight">
                  <div class="text mt-5">
                      <span class="subheading">Best Seller Book Of The Week</span>
                            <h1>Clue Of The Wooden Cottage</h1>
                            <p>A small river named Duden flows by their place and supplies it with the necessary
                                regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                            <p><a href="#" class="btn btn-primary py-3 px-4">Buy Now For $22.78</a></p>
                </div>
              </div>
              </div>
        </div>
      </section>
  
      <section class="ftco-section ftco-no-pb ftco-partner">
          <div class="container">
              <div class="row">
                  <div class="col-md-12 col-lg ftco-animate">
                      <a href="#" class="partner d-flex justify-content-center"><img src="<?php echo Furl('assets/images/partner-1.png'); ?>" class="img-fluid" alt="Colorlib Template"></a>
                  </div>
                  <div class="col-md-12 col-lg ftco-animate">
                      <a href="#" class="partner d-flex justify-content-center"><img src="<?php echo Furl('assets/images/partner-2.png') ?>" class="img-fluid" alt="Colorlib Template"></a>
                  </div>
                  <div class="col-md-12 col-lg ftco-animate">
                      <a href="#" class="partner d-flex justify-content-center"><img src="<?php echo Furl('assets/images/partner-3.png') ?>" class="img-fluid" alt="Colorlib Template"></a>
                  </div>
                  <div class="col-md-12 col-lg ftco-animate">
                      <a href="#" class="partner d-flex justify-content-center"><img src="<?php echo Furl('assets/images/partner-4.png') ?>" class="img-fluid" alt="Colorlib Template"></a>
                  </div>
                  <div class="col-md-12 col-lg ftco-animate">
                      <a href="#" class="partner d-flex justify-content-center"><img src="<?php echo Furl('assets/images/partner-5.png') ?>" class="img-fluid" alt="Colorlib Template"></a>
                  </div>
              </div>
          </div>
      </section>
  
      <section class="ftco-about img ftco-section" id="about-section">
          <div class="container">
              <div class="row d-flex no-gutters">
                  <div class="col-md-6 col-lg-6 d-flex">
                      <div class="img-about img d-flex align-items-stretch">
                          <div class="overlay"></div>
                          <div class="img d-flex align-self-stretch align-items-center" style="background-image:url(<?php echo Furl('assets/images/bg_1.jpg')?>);">
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6 col-lg-6 pl-md-5">
                      <div class="row justify-content-start pb-3">
                    <div class="col-md-12 heading-section ftco-animate">
                      <h2 class="mb-4">About The Book</h2>
                      <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                      <div class="text-about">
                          <h4>Award achievements</h4>
                          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                          <h4>Read On Any Devices</h4>
                          <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                          <h4>Very High Resolution</h4>
                          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
          </div>
      </section>
  
      <section class="ftco-section ftco-no-pt ftco-no-pb ftco-counter img" id="section-counter">
          <div class="container">
                  <div class="row d-md-flex align-items-center align-items-stretch">
            <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
              <div class="block-18 bg-light">
                <div class="text">
                  <strong class="number" data-number="1100">0</strong>
                  <span>Copies Sold</span>
                </div>
              </div>
            </div>
            <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
              <div class="block-18 bg-light">
                <div class="text">
                  <strong class="number" data-number="1200">0</strong>
                  <span>Copies Released</span>
                </div>
              </div>
            </div>
            <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
              <div class="block-18 bg-light">
                <div class="text">
                  <strong class="number" data-number="340">0</strong>
                  <span>Cup Of Coffee</span>
                </div>
              </div>
            </div>
            <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
              <div class="block-18 bg-light">
                <div class="text">
                  <strong class="number" data-number="12000">0</strong>
                  <span>Happy Readers</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <section class="ftco-section ftco-no-pt">
          <div class="container">
              <div class="row justify-content-center py-5 mt-5">
            <div class="col-md-5 heading-section text-center ftco-animate">
                <span class="subheading">Services</span>
              <h2 class="mb-4">Services</h2>
            </div>
          </div>
              <div class="row">
                      <div class="col-md-4 text-center d-flex ftco-animate">
                          <div class="services-1 bg-light">
                              <span class="icon">
                                  <i class="flaticon-user-experience"></i>
                              </span>
                              <div class="desc">
                                  <h3 class="mb-5">Experience</h3>
                                  <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4 text-center d-flex ftco-animate">
                          <div class="services-1 bg-light">
                              <span class="icon">
                                  <i class="flaticon-network"></i>
                              </span>
                              <div class="desc">
                                  <h3 class="mb-5">Marketing Goals</h3>
                                  <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4 text-center d-flex ftco-animate">
                          <div class="services-1 bg-light">
                              <span class="icon">
                                  <i class="flaticon-innovation"></i>
                              </span>
                              <div class="desc">
                                  <h3 class="mb-5">Targetting Vission</h3>
                                  <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                              </div>
                          </div>
                      </div>
                  </div>
          </div>
      </section>
  
      <section class="ftco-section testimony-section ftco-no-pb" id="testimonial-section">
          <div class="img img-bg border" style="background-image: url(images/bg_4.jpg);"></div>
          <div class="overlay"></div>
        <div class="container">
          <div class="row justify-content-center mb-5">
            <div class="col-md-12 text-center heading-section heading-section-white ftco-animate">
                <span class="subheading">Testimonial</span>
              <h2 class="mb-3">Kinds Words From Customers</h2>
            </div>
          </div>
          <div class="row ftco-animate">
            <div class="col-md-12">
              <div class="carousel-testimony owl-carousel ftco-owl">
                <div class="item">
                  <div class="testimony-wrap py-4">
                      <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                    <div class="text">
                      <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                      <div class="d-flex align-items-center">
                          <div class="user-img" style="background-image: url(<?php echo Furl('assets/images/person_1.jpg') ?>)"></div>
                          <div class="pl-3">
                              <p class="name">Roger Scott</p>
                              <span class="position">Marketing Manager</span>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="testimony-wrap py-4">
                      <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                    <div class="text">
                      <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                      <div class="d-flex align-items-center">
                          <div class="user-img" style="background-image: url(<?php echo Furl('assets/images/person_2.jpg') ?>)"></div>
                          <div class="pl-3">
                              <p class="name">Roger Scott</p>
                              <span class="position">Marketing Manager</span>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="testimony-wrap py-4">
                      <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                    <div class="text">
                      <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                      <div class="d-flex align-items-center">
                          <div class="user-img" style="background-image: url(<?php echo Furl('assets/images/person_3.jpg') ?>)"></div>
                          <div class="pl-3">
                              <p class="name">Roger Scott</p>
                              <span class="position">Marketing Manager</span>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="testimony-wrap py-4">
                      <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                    <div class="text">
                      <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                      <div class="d-flex align-items-center">
                          <div class="user-img" style="background-image: url(<?php echo Furl('assets/images/person_1.jpg') ?>)"></div>
                          <div class="pl-3">
                              <p class="name">Roger Scott</p>
                              <span class="position">Marketing Manager</span>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="testimony-wrap py-4">
                      <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                    <div class="text">
                      <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                      <div class="d-flex align-items-center">
                          <div class="user-img" style="background-image: url(<?php echo Furl('assets/images/person_2.jpg') ?>)"></div>
                          <div class="pl-3">
                              <p class="name">Roger Scott</p>
                              <span class="position">Marketing Manager</span>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
   
  
      <section class="ftco-section ftco-project" id="projects-section">
          <div class="container">
              <div class="row no-gutters justify-content-center pb-5">
            <div class="col-md-12 heading-section text-center ftco-animate">

              <h2 class="mb-4">Books</h2>
            </div>
          </div>
              <div class="row">

              <?php
                     

                     $sql = "select books.id as bookID, books.book_cover,books.book_name,books.price,category.* , author.name from books join
                           category on category.id = books.category_id join author on author.id=books.author_id";
                     $data = mysqli_query($con,$sql);


                     while($FData = mysqli_fetch_assoc($data)){
            
                        ?>
            <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1">
                <div class="card"> <img class="card-img-top " 
                src="<?php echo url('Books/uploads/'.$FData['book_cover']);?>" height="300">
                    <div class="card-body">
                        <h5><b><?php echo $FData['book_name']  ?></b> </h5>
                        <span> Category : <?php echo $FData['category_name'] ?></span><br>
                        <span>Author : <?php echo $FData['name'] ?></span>
                        <div class="d-flex flex-row my-2">
                            <span>Price : </span><div class="text-muted">₹<?php echo $FData['price'] ?>/loaf</div>
                        </div> 
                        <?php  if(isset($_SESSION['user'])){?>
                        <form  method="POST" action="<?php echo Furl('profile/index.php?id=')?><?php echo $FData['bookID'];?>">
                        <button type="submit" name="cart" class="btn w-100 rounded my-2">Add to cart</button> </form>
                        <?php }; ?>
                    </div>
                </div>
            </div>

            <?php }
                
            
            
            ?>
                
          </div>
      </section>


      
<!-- products section -->
<section id="products">
    <div class="container">

        <div class="row">
       
        </div>
    </div>
</section>






      <section class="ftco-section contact-section ftco-no-pb" id="contact-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
              <h2 class="mb-4">Contact Me</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
            </div>
          </div>
  
          <div class="row d-flex contact-info mb-5">
            <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                <div class="align-self-stretch box text-center p-4 bg-light">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-map-marker"></span>
                    </div>
                    <div>
                        <h3 class="mb-4">Address</h3>
                      <p>198 West 21th Street, Suite 721 New York NY 10016</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                <div class="align-self-stretch box text-center p-4 bg-light">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-phone"></span>
                    </div>
                    <div>
                        <h3 class="mb-4">Contact Number</h3>
                      <p><a href="tel://1234567920">+ 1235 2355 98</a></p>
                  </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                <div class="align-self-stretch box text-center p-4 bg-light">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-paper-plane"></span>
                    </div>
                    <div>
                        <h3 class="mb-4">Email Address</h3>
                      <p><a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                <div class="align-self-stretch box text-center p-4 bg-light">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-globe"></span>
                    </div>
                    <div>
                        <h3 class="mb-4">Website</h3>
                      <p><a href="#">yoursite.com</a></p>
                  </div>
                </div>
            </div>
          </div>
          <?php if(isset($_SESSION['Errors'])){echo printMessages();}else{echo " ";}?>
          <div class="row no-gutters block-9">
          
            <div class="col-md-12 order-md-last d-flex">

           
              <form  method="POST"  class="bg-light p-4 p-md-5 contact-form">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" placeholder="Your Name">
                </div>
                <div class="form-group">
                  <input type="email"  name="email" class="form-control" placeholder="Your Email">
                </div>
                <div class="form-group">
                  <input type="text"  name="subject" class="form-control" placeholder="Subject">
                </div>
                <div class="form-group">
                  <textarea  id="" name="msg" cols="5" rows="4" class="form-control" placeholder="Message"></textarea>
                </div>
                <div class="form-group">
                  <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                </div>
              </form>
            
            </div>
  
         
          </div>
        </div>
      </section>
          
  
        <?php require "./Layouts/footer.php" ?>