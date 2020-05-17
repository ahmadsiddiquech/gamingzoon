<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Amin Template">
    <meta name="keywords" content="gamingzoon,win big,cash,prize">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gaming Zoon</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cinzel:400,700,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?=STATIC_FRONT_CSS?>bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?=STATIC_FRONT_CSS?>font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?=STATIC_FRONT_CSS?>elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?=STATIC_FRONT_CSS?>owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?=STATIC_FRONT_CSS?>barfiller.css" type="text/css">
    <link rel="stylesheet" href="<?=STATIC_FRONT_CSS?>magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="<?=STATIC_FRONT_CSS?>slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?=STATIC_FRONT_CSS?>style.css" type="text/css">
</head>

<body>

    <!-- Humberger Menu Begin -->
    <div class="humberger-menu-overlay"></div>
    <div class="humberger-menu-wrapper">
        <div class="hw-logo">
            <a href="<?=BASE_URL?>"><img src="<?=STATIC_FRONT_IMAGE?>logo.png" alt=""></a>
        </div>
        <div class="hw-menu mobile-menu">
            <ul>
                <li><a href="<?=BASE_URL?>">Home</a></li>
                <li><a href="<?=BASE_URL?>games">Games</a></li>
                <li><a href="<?=BASE_URL?>upcominggames">Upcoming Events</a></li>
                <li><a href="<?=BASE_URL?>aboutus">About Us</a></li>
                <li><a href="<?=BASE_URL?>contactus">Contact Us</a></li>
                <!-- <li><a href="#">Pages <i class="fa fa-angle-down"></i></a>
                    <ul class="dropdown">
                        <li><a href="./categories-list.html">Categories</a></li>
                        <li><a href="./categories-grid.html">Categories grid</a></li>
                        <li><a href="./typography.html">Typography</a></li>
                        <li><a href="./details-post-default.html">Post default</a></li>
                        <li><a href="./details-post-gallery.html">Post gallery</a></li>
                        <li><a href="./details-post-review.html">Post review</a></li>
                        <li><a href="./contact.html">Contact</a></li>
                    </ul>
                </li> -->
            </ul>
        </div>
        <div id="mobile-menu-wrap"></div>

    </div>
    <!-- Humberger Menu End -->

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="ht-options">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-8">
                        <div class="ht-widget">
                            <ul>
                            	<?php date_default_timezone_set("Asia/Karachi"); ?>
                                <li><i class="fa fa-clock-o"></i><?= date('h:i')?></li>
                                <li><i class="fa fa-calendar-o"></i><?= date('d,M-Y')?></li>
                                <li class="signup-switch signup-open"><i class="fa fa-sign-out"></i> Login / Sign up
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4">
                        <div class="ht-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-envelope-o"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="logo">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                       <a href="<?=BASE_URL?>">
                       	<img src="<?=STATIC_FRONT_IMAGE?>logo.png" alt="">
                       </a>
                    </div>
                </div>
            </div>
        </div> -->
        <?php $controller = $this->uri->segment(1); ?>
        <div class="nav-options">
            <div class="container">
                <div class="humberger-menu humberger-open">
                    <i class="fa fa-bars"></i>
                </div>
                <div class="logo">
                    <img src="<?=STATIC_FRONT_IMAGE?>logo.png" alt="logo">
                </div>
                <div class="nav-search search-switch">
                    <i class="fa fa-search"></i>
                </div>
                <div class="nav-menu">
                    <ul>
                        <li class="<? if($controller=='front' || $controller=='') echo("active")?>"><a href="<?=BASE_URL?>"><span>Home</span></a></li>
                        <li class="mega-menu <? if($controller=='games') echo("active")?>"><a href="<?=BASE_URL?>games"><span>Games <i class="fa fa-angle-down"></i></span></a>
                            <div class="megamenu-wrapper">
                                <div class="mw-post">
                                    <div class="mw-post-item">
                                        <div class="mw-pic">
                                            <img src="<?=STATIC_FRONT_IMAGE?>megamenu/mm-1.jpg" alt="">
                                        </div>
                                        <div class="mw-text">
                                            <h6><a href="#">Ludo Star</a></h6>
                                            <ul>
                                                <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                                <li><i class="fa fa-comment-o"></i> 12</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mw-post-item">
                                        <div class="mw-pic">
                                            <img src="<?=STATIC_FRONT_IMAGE?>megamenu/mm-2.jpg" alt="">
                                        </div>
                                        <div class="mw-text">
                                            <h6><a href="#">Snooker</a>
                                            </h6>
                                            <ul>
                                                <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                                <li><i class="fa fa-comment-o"></i> 12</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mw-post-item">
                                        <div class="mw-pic">
                                            <img src="<?=STATIC_FRONT_IMAGE?>megamenu/mm-3.jpg" alt="">
                                        </div>
                                        <div class="mw-text">
                                            <h6><a href="#">Chess</a>
                                            </h6>
                                            <ul>
                                                <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                                <li><i class="fa fa-comment-o"></i> 12</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mw-post-item">
                                        <div class="mw-pic">
                                            <img src="<?=STATIC_FRONT_IMAGE?>megamenu/mm-4.jpg" alt="">
                                        </div>
                                        <div class="mw-text">
                                            <h6><a href="#">Poker</a></h6>
                                            <ul>
                                                <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                                <li><i class="fa fa-comment-o"></i> 12</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mw-post-item">
                                        <div class="mw-pic">
                                            <img src="<?=STATIC_FRONT_IMAGE?>megamenu/mm-5.jpg" alt="">
                                        </div>
                                        <div class="mw-text">
                                            <h6><a href="#">3 Patti</a>
                                            </h6>
                                            <ul>
                                                <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                                <li><i class="fa fa-comment-o"></i> 12</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- <li>
                            <a href="#"><span>Pages <i class="fa fa-angle-down"></i></span></a>
                            <ul class="dropdown">
                                <li><a href="./categories-list.html">Categories</a></li>
                                <li><a href="./categories-grid.html">Categories grid</a></li>
                                <li><a href="./typography.html">Typography</a></li>
                                <li><a href="./details-post-default.html">Post default</a></li>
                                <li><a href="./details-post-gallery.html">Post gallery</a></li>
                                <li><a href="./details-post-review.html">Post review</a></li>
                                <li><a href="./contact.html">Contact</a></li>
                            </ul>a
                        </li> -->
                        <li class="<? if($controller=='upcomingevents') echo("active")?>"><a href="<?=BASE_URL?>upcomingevents"><span>Upcoming Events</span></a></li>
                        <li class="<? if($controller=='aboutus') echo("active")?>"><a href="<?=BASE_URL?>aboutus"><span>About Us</span></a></li>
                        <li class="<? if($controller=='contactus') echo("active")?>"><a href="<?=BASE_URL?>contactus"><span>Contact Us</span></acontactusli>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Header End -->