<footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer-about">
                        <div class="fa-logo">
                            <a href="<?=BASE_URL?>">
                            	<img src="<?=STATIC_FRONT_IMAGE?>logo.png" alt="">
                            </a>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua lacus vel facilisis.</p>
                        <div class="fa-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="editor-choice">
                        <div class="section-title">
                            <h5>Editor's Choice</h5>
                        </div>
                        <div class="ec-item">
                            <div class="ec-pic">
                                <img src="<?=STATIC_FRONT_IMAGE?>trending/editor-1.jpg" alt="">
                            </div>
                            <div class="ec-text">
                                <h6><a href="#">Snooker</a>
                                </h6>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                    <li><i class="fa fa-comment-o"></i> 12</li>
                                </ul>
                            </div>
                        </div>
                        <div class="ec-item">
                            <div class="ec-pic">
                                <img src="<?=STATIC_FRONT_IMAGE?>trending/editor-2.jpg" alt="">
                            </div>
                            <div class="ec-text">
                                <h6><a href="#">Lodo Star</a>
                                </h6>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                    <li><i class="fa fa-comment-o"></i> 12</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="tags-cloud">
                        <div class="section-title">
                            <h5>Tags Cloud</h5>
                        </div>
                        <div class="tag-list">
                            <a href="#"><span>Gaming</span></a>
                            <a href="#"><span>Platform</span></a>
                            <a href="#"><span>Playstation</span></a>
                            <a href="#"><span>Hardware</span></a>
                            <a href="#"><span>Reviews</span></a>
                            <a href="#"><span>Simulation</span></a>
                            <a href="#"><span>Strategy</span></a>
                            <a href="#"><span>Scientific</span></a>
                            <a href="#"><span>References</span></a>
                            <a href="#"><span>Role-playing</span></a>
                            <a href="#"><span>Adventurea</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-area">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ca-text"><p>
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Developed by <a href="https://www.facebook.com/ahmadsiddiquech" target="_blank">Ahmad Siddique</a>
</p></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Sign Up Section Begin -->
    <div class="signup-section">
        <div class="signup-close"><i class="fa fa-close"></i></div>
        <div class="row" style="margin-left: 0px;margin-right: 0px;">
            <div class="col-md-6" style="border-right: 1px solid #9e0303">
            <div class="signup-text">
                <div class="container">
                    <div class="signup-title">
                        <h2>One Click</h2>
                        <p>Fill out the form below to recieve a free and confidential</p>
                    </div>
                    <form action="<?=BASE_URL?>front/register" method="POST" class="signup-form">
                        <div class="sf-input-list">
                            <select name="country">
                                    <option value="pakistan">Pakistan</option>
                                    <option value="china">China</option>
                                    <option value="india">India</option>
                            </select>
                            <select name="currency">
                                <option value="pkr">PKR (Pakistani Rupee)</option>
                                <option value="pkr">Yuan (Chinese Yuan)</option>
                                <option value="pkr">INR (Indian Rupee)</option>
                            </select>
                            <input type="text" placeholder="Promo Code" name="promo_code">
                        </div>
                        <!-- <div class="radio-check">
                            <label for="rc-agree">I agree with the term & conditions
                                <input type="checkbox" id="rc-agree">
                                <span class="checkbox"></span>
                            </label>
                        </div> -->
                        <button type="submit"><span>REGISTER NOW</span></button>
                    </form>
                </div>
            </div>
            </div>
            <div class="col-md-5">
            <div class="signup-text">
                <div class="container">
                    <div class="signup-title">
                        <h2>Login</h2>
                        <p>Fill out the form below to recieve a free and confidential</p>
                    </div>
                    <form action="<?=BASE_URL?>front/login" method="POST" class="signup-form">
                        <div class="sf-input-list">
                            <input type="text" placeholder="Login ID" name="login_id">
                            <input type="password" placeholder="Password" name="password">
                        </div>
                        <button type="submit"><span>Login</span></button>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- Sign Up Section End -->

    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->


    <!-- Js Plugins -->
    <script src="<?=STATIC_FRONT_JS?>jquery-3.3.1.min.js"></script>
    <script src="<?=STATIC_FRONT_JS?>bootstrap.min.js"></script>
    <script src="<?=STATIC_FRONT_JS?>jquery.magnific-popup.min.js"></script>
    <script src="<?=STATIC_FRONT_JS?>circle-progress.min.js"></script>
    <script src="<?=STATIC_FRONT_JS?>jquery.barfiller.js"></script>
    <script src="<?=STATIC_FRONT_JS?>jquery.slicknav.js"></script>
    <script src="<?=STATIC_FRONT_JS?>owl.carousel.min.js"></script>
    <script src="<?=STATIC_FRONT_JS?>main.js"></script>
</body>

</html>