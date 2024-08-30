<?php
include 'connection.php';
include 'header.php';
?>

<section id="contact" class="contact">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4" data-aos="fade-right">
                <div class="section-title">
                    <h2>Contact</h2>
                    <p>We are open Monday to Saturday 9 am to 7 pm come visit us!</p>
                </div>
            </div>

            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
                <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d696.2481582431726!2d35.540190152130286!3d33.89137794360045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151f30598f3514db%3A0x36e7ce931af0ae2e!2sCashUnited%20MoneyGram%20-%20Clic%20Cell!5e0!3m2!1sen!2slb!4v1715339315834!5m2!1sen!2slb" frameborder="0" allowfullscreen></iframe>
                <div class="info mt-4">
                    <i class="bi bi-geo-alt"></i>
                    <h4>Location:</h4>
                    <p>Assaf Khoury Street, Ashdjian Building, Bourj Hammoud</p>
                </div>
                <div class="row">
                    <div class="col-lg-6 mt-4">
                        <div class="info">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p><a href="mailto:asdouriann@gmail.com">asdouriann@gmail.com</a></p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info w-100 mt-4">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p><a href="tel:+96176934532">76 934 532</a></p>
                        </div>
                    </div>
                </div>

                <form id="contactForm" action="submit-form.php" method="post" role="form" class="php-email-form mt-4">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                    </div>
                    <div class="form-group mt-3">
                        <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                    </div>
                    <div class="my-3">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div>
                    </div>
                    <div class="text-center"><button type="submit">Send Message</button></div>
                    <div><a href="https://wa.me/12109640619" class="whatsapp-button" target="_blank" aria-label="Chat with us on WhatsApp">
                        <img src="/images/whatsapplogo.png" alt="WhatsApp Logo">
                    </a></div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php 
include 'footer.php';
?>