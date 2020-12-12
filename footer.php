<footer class="main-footer bg-primary text-white">
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-4">
                <p class="mb-0 font-weight-bold mb-1">About Us</p>
                <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati libero fugit vero est, eius totam ad iste officiis veritatis facilis corporis voluptate, et, molestias dignissimos itaque magni rerum! Laboriosam, praesentium.</small>
            </div>
            <div class="col-md-4">
                <p class="mb-0 font-weight-bold mb-1">Sitemap</p>
                <div class="d-md-flex">
                    <ul class="pl-0" style="list-style:none">
                        <li> <a href="#"> <small class="text-white">About Us</small></a></li>
                        <li> <a href="#"> <small class="text-white">Contact Us</small></a></li>
                        <li> <a href="#"> <small class="text-white">Companies</small></a></li>
                        <li> <a href="#"> <small class="text-white">Privacy Policy</small></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <p class="mb-0 font-weight-bold mb-2">Connect with Us</p>
                <div>
                    <a href="https://www.facebook.com/travelhuge/" target="_blank" class="mb-3 d-flex">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/facebook.svg" width="20px" height="20px" class="mr-2" alt="">
                        <small class="text-white">facebook.com/travelhuge</small>
                    </a>
                    <a href="https://www.instagram.com/travelhuge/" target="_blank" class="mb-3 d-flex">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/instagram.svg" width="20px" height="20px" class="mr-2" alt="">
                        <small class="text-white">company/travelhuge-com</small>
                    </a>
                    <a href="https://www.linkedin.com/company/travelhuge-com/" target="_blank" class="mb-2 d-flex">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/linkedin.svg" width="20px" height="20px" class="mr-2" alt="">
                        <small class="text-white">@travelhuge</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-bar d-flex justify-content-between py-1" style="background-color: #1b65b4;">
        <small></small>
        <small>designed and developed by consultancy today, EProductZone</small>
        <small></small>
    </div>
</footer>
<?php wp_footer(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $('.offer-owl-carousel').owlCarousel({
        loop: true,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });
</script>
</body>

</html>