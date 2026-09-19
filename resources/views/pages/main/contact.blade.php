@include('commonsection.nav')
    <!-- main nav end -->

    <!-- ==================== CONTACT PAGE ==================== -->
    <section class="py-5 bg-light">
      <div class="container">
        <!-- Page Header -->
        <div class="text-center mb-5">
          <h1 class="display-4 fw-bold text-nex">Contact Us</h1>
          <p class="text-muted fs-5">
            Have questions? We'd love to hear from you. Get in touch with us.
          </p>
          <div
            class="mx-auto"
            style="width: 80px; height: 4px; background: #198754"
          ></div>
        </div>

        <div class="row g-4">
          <!-- ====== LEFT SIDE: CONTACT INFO ====== -->
          <div class="col-lg-5">
            <div class="card border-0 shadow-sm h-100">
              <div class="card-body p-4 p-lg-5">
                <h3 class="fw-bold mb-4">
                  <i class="bi bi-info-circle-fill text-xoom me-2"></i>
                  Get in Touch
                </h3>
                <p class="text-xoom mb-4">
                  We're here to help and answer any question you might have. We
                  look forward to hearing from you.
                </p>

                <!-- Contact Details -->
                <div class="d-flex mb-3">
                  <div
                    class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3"
                    style="width: 50px; height: 50px; flex-shrink: 0"
                  >
                    <i class="bi bi-geo-alt-fill text-xoom fs-4"></i>
                  </div>
                  <div>
                    <h6 class="fw-bold mb-0 text-xoom">Our Address</h6>
                    <p class="text-xoom mb-0">
                      West Shewrapara, Mirpur, Dhaka, 1216
                    </p>
                  </div>
                </div>

                <div class="d-flex mb-3">
                  <div
                    class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3 text-xoom"
                    style="width: 50px; height: 50px; flex-shrink: 0"
                  >
                    <i class="bi bi-envelope-fill text-nexx fs-4"></i>
                  </div>
                  <div>
                    <h6 class="fw-bold mb-0 text-xoom">Email Us</h6>
                    <p class="text-xoom mb-0">info@nexxoom.com</p>
                    <p class="text-xoom mb-0">support@nexxoom.com</p>
                  </div>
                </div>

                <div class="d-flex mb-4">
                  <div
                    class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3"
                    style="width: 50px; height: 50px; flex-shrink: 0"
                  >
                    <i class="bi bi-telephone-fill text-xoom fs-4"></i>
                  </div>
                  <div>
                    <h6 class="fw-bold mb-0 text-xoom">Call Us</h6>
                    <p class="text-xoom mb-0"></p>
                    <p class="text-xoom mb-0">+8801712345678</p>
                  </div>
                </div>

                <!-- Social Links -->
                <hr />
                <div class="d-flex align-items-center gap-2 flex-wrap">
 <a href="{{ $link->whatsApp ?? '#' }}" target="_blank"
                    class="social-icon d-flex align-items-center justify-content-center rounded-circle bg-white text-decoration-none"
                    style="width:22px;height:22px;color:#25D366!important;">

                    <i class="bi bi-whatsapp" style="font-size:12px;"></i>

                </a>


                <a href="{{ $link->facebook}}" target="_blank"
                 
                    class="social-icon d-flex align-items-center justify-content-center rounded-circle bg-white text-decoration-none"
                    style="width:22px;height:22px;color:#1877F2!important;">

                    <i class="bi bi-facebook" style="font-size:12px;"></i>
                     
                </a>


                <a href="{{ $link->youtube ?? '#' }}" target="_blank"
                    class="social-icon d-flex align-items-center justify-content-center rounded-circle bg-white text-decoration-none"
                    style="width:22px;height:22px;color:#FF0000!important;">

                    <i class="bi bi-youtube" style="font-size:12px;"></i>

                </a>


                <a href="{{ $link->linkedin ?? '#' }}" target="_blank"
                    class="social-icon d-flex align-items-center justify-content-center rounded-circle bg-white text-decoration-none"
                    style="width:22px;height:22px;color:#0A66C2!important;">

                    <i class="bi bi-linkedin" style="font-size:12px;"></i>

                </a>


                <a href="{{ $link->email  }}" target="_blank"
                    class="social-icon d-flex align-items-center text-decoration-none">

                    <span class="d-flex align-items-center justify-content-center rounded-circle bg-white"
                        style="width:22px;height:22px;color:#EA4335;">

                        <i class="bi bi-envelope-fill" style="font-size:12px;"></i>

                    </span>

                </a>

                </div>
              </div>
            </div>
          </div>

          <!-- ====== RIGHT SIDE: CONTACT FORM ====== -->
          <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
              <div class="card-body p-4 p-lg-5">
                <h3 class="fw-bold mb-4">
                  <i class="bi bi-send-fill text-xoom me-2"></i>
                  Send Us a Message
                </h3>

                <form action="{{ route('contact.message') }}" method="Post" enctype="multipart/form-data">
                  @csrf
                  @method('POST')
                  <div class="row g-3">
                    <!-- Full Name -->
                    <div class="col-md-6">
                      <label for="fullName" class="form-label fw-semibold">
                        <i class="bi bi-person-fill me-1 text-xoom"></i>
                        Full Name
                      </label>
                      <input
                        type="text"
                        class="form-control form-control-lg"
                        id="fullName" name="fullName"
                        placeholder="John Doe"
                        required
                      />
                    </div>

                    <!-- Email Address -->
                    <div class="col-md-6">
                      <label for="email" class="form-label fw-semibold">
                        <i class="bi bi-envelope-fill me-1 text-xoom"></i>
                        Email Address
                      </label>
                      <input
                        type="email"
                        class="form-control form-control-lg"
                        id="email" name="email"
                        placeholder="john@example.com"
                        required
                      />
                    </div>

                    <!-- Phone Number -->
                    <div class="col-md-6">
                      <label for="phone" class="form-label fw-semibold">
                        <i class="bi bi-telephone-fill me-1 text-xoom"></i>
                        Phone Number
                      </label>
                      <input
                        type="tel"
                        class="form-control form-control-lg"
                        id="phone" name="phone"
                        placeholder="+880 16XX-XXXXXX"
                      />
                    </div>

                    <!-- Subject -->
                    <div class="col-md-6">
                      <label for="address" class="form-label fw-semibold">
                        <i class="bi bi-house-add-fill me-1 text-xoom"></i>
                        Address
                      </label>
                      <input
                        type="tel"
                        class="form-control form-control-lg"
                        id="address" name="address"
                        placeholder="Address"
                      />
                    </div>

                    <!-- Message -->
                    <div class="col-12">
                      <label for="message" class="form-label fw-semibold">
                        <i class="bi bi-chat-dots-fill me-1 text-xoom"></i>
                        Message
                      </label>
                      <textarea
                        class="form-control form-control-lg"
                        id="message" name="message"
                        rows="5"
                        placeholder="Write your message here..."
                        required
                      ></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 mt-4">
                      <button type="submit" class="btn btn-success bg-xoom text-white border-0 hover:bg-nex btn-lg">
                        <i class="bi bi-send-fill me-2"></i>
                        Send Message
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- ====== BOTTOM: MAP SECTION ====== -->
        <div class="mt-5">
          <div class="card border-0 shadow-sm overflow-hidden">
            <div class="ratio ratio-16x9 " style="height: 500px">
              <iframe  
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.123456789012!2d90.4125!3d23.8103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjPCsDQ4JzM3LjEiTiA5MMKwMjQnNDUuMCJF!5e0!3m2!1sen!2sbd!4v1234567890"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              >
              </iframe>
            </div>
          </div>
        </div>
      </div>
    </section>
@include('commonsection.footer')