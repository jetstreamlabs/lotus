<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('storage/img/favicon.png') }}">

    <title>{{ $meta['title'] }}</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

  </head>

  <body id="page-top">
    <div id="app">
    <!-- Navigation -->
    <a class="menu-toggle rounded" href="#">
      <i class="fa fa-bars"></i>
    </a>
    <nav id="sidebar-wrapper" class="bg-secondary">
      <ul class="sidebar-nav">
        <li class="sidebar-brand">
          <a class="js-scroll-trigger" disabled>Learn More</a>
        </li>
        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="#about">About ADCM</a>
        </li>
        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="#included">What's Included</a>
        </li>
        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="#details">More Details</a>
        </li>
        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="{{ route('login.show') }}">Login</a>
        </li>
        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="{{ route('register.show') }}">Register</a>
        </li>
        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="#contact">Contact</a>
        </li>
      </ul>
    </nav>

    <!-- Header -->
    <header class="masthead d-flex">
      <div class="container text-center my-auto">
        <h1 class="mb-1 text-white">Hi. I'm Serenity</h1>
        <h3 class="mb-5 text-white">
          <em>An ADCM Implementation of Laravel</em>
        </h3>
        <a class="btn btn-outline-light btn-xl js-scroll-trigger" href="#about">What Is ADCM?</a>
      </div>
      <div class="overlay"></div>
    </header>

    <!-- About -->
    <section class="content-section bg-light" id="about">
      <div class="container text-center">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h2>Action Domain Component/Markdown ... What Is It?</h2>
            <p class="lead mb-5">Teach the people about ADCM here ... </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Services -->
    <section class="content-section bg-info text-white text-center" id="included">
      <div class="container">
        <div class="content-section-heading">
          <h3 class="text-faded mb-0">Included</h3>
          <h2 class="mb-5">Here's What's New</h2>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
            <span class="service-icon rounded-circle mx-auto mb-3 text-info">
              <i class="icon-screen-smartphone"></i>
            </span>
            <h4>
              <strong>Responsive</strong>
            </h4>
            <p class="text-faded mb-0">Looks great on any screen size!</p>
          </div>
          <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
            <span class="service-icon rounded-circle mx-auto mb-3 text-info">
              <i class="icon-pencil"></i>
            </span>
            <h4>
              <strong>Redesigned</strong>
            </h4>
            <p class="text-faded mb-0">Freshly redesigned for Bootstrap 4.</p>
          </div>
          <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
            <span class="service-icon rounded-circle mx-auto mb-3 text-info">
              <i class="icon-like"></i>
            </span>
            <h4>
              <strong>Favorited</strong>
            </h4>
            <p class="text-faded mb-0">Millions of users
              <i class="fa fa-heart"></i>
              Start Bootstrap!</p>
          </div>
          <div class="col-lg-3 col-md-6">
            <span class="service-icon rounded-circle mx-auto mb-3 text-info">
              <i class="icon-mustache"></i>
            </span>
            <h4>
              <strong>Question</strong>
            </h4>
            <p class="text-faded mb-0">I mustache you a question...</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Callout -->
    <section class="callout">
      <div class="container text-center">
        <h2 class="mx-auto mb-5 text-white">Welcome to <em>your</em> next website!</h2>
        <a class="btn btn-outline-light btn-xl" href="#">Download Now!</a>
      </div>
    </section>

    <!-- Portfolio -->
    <section class="content-section" id="details">
      <div class="container">
        <div class="content-section-heading text-center">
          <h3 class="text-secondary mb-0">Details</h3>
          <h2 class="mb-5">More Information</h2>
        </div>
        <div class="row no-gutters">
          <div class="col-lg-6">
            <a class="detail-item" href="#">
              <span class="caption">
                <span class="caption-content">
                  <h2>Stationary</h2>
                  <p class="mb-0">A yellow pencil with envelopes on a clean, blue backdrop!</p>
                </span>
              </span>
              <img class="img-fluid" src="{{ asset('storage/img/top-left.jpg') }}" alt="">
            </a>
          </div>
          <div class="col-lg-6">
            <a class="detail-item" href="#">
              <span class="caption">
                <span class="caption-content">
                  <h2>Ice Cream</h2>
                  <p class="mb-0">A dark blue background with a colored pencil, a clip, and a tiny ice cream cone!</p>
                </span>
              </span>
              <img class="img-fluid" src="{{ asset('storage/img/top-right.jpg') }}" alt="">
            </a>
          </div>
          <div class="col-lg-6">
            <a class="detail-item" href="#">
              <span class="caption">
                <span class="caption-content">
                  <h2>Strawberries</h2>
                  <p class="mb-0">Strawberries are such a tasty snack, especially with a little sugar on top!</p>
                </span>
              </span>
              <img class="img-fluid" src="{{ asset('storage/img/bottom-left.jpg') }}" alt="">
            </a>
          </div>
          <div class="col-lg-6">
            <a class="detail-item" href="#">
              <span class="caption">
                <span class="caption-content">
                  <h2>Workspace</h2>
                  <p class="mb-0">A yellow workspace with some scissors, pencils, and other objects.</p>
                </span>
              </span>
              <img class="img-fluid" src="{{ asset('storage/img/bottom-right.jpg') }}" alt="">
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Call to Action -->
    <section class="content-section bg-success text-white">
      <div class="container text-center">
        <h2 class="mb-4">The buttons below are impossible to resist...</h2>
        <a href="#" class="btn btn-xl btn-light mr-4">Click Me!</a>
        <a href="#" class="btn btn-xl btn-outline-dark">Look at Me!</a>
      </div>
    </section>

    <!-- Map -->
    <section id="contact" class="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3334.817923254561!2d-111.7410641!3d33.2974261!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x872bac6748376ed7%3A0xc31fd23f07639d4c!2s2910+S+Greenfield+Rd%2C+Gilbert%2C+AZ+85295!5e0!3m2!1sen!2sus!4v1529580688955" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
    </section>

    <!-- Footer -->
    <footer class="footer text-center">
      <div class="container">
        <ul class="list-inline mb-5">
          <li class="list-inline-item">
            <a class="social-link rounded-circle text-white bg-primary mr-3" href="#">
              <i class="icon-social-facebook"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="social-link rounded-circle text-white bg-primary mr-3" href="#">
              <i class="icon-social-twitter"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="social-link rounded-circle bg-primary text-white" href="#">
              <i class="icon-social-github"></i>
            </a>
          </li>
        </ul>
        <p class="text-muted small mb-0">&copy; <?= date('Y'); ?>. Codemafia, LLC. All Rights Reserved.</p>
      </div>
    </footer>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
  </div>

  <script src="{{ mix('js/app.js') }}"></script>

  </body>
</html>
