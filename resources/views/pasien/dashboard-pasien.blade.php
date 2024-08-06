@extends('layouts.app')
@section('title', 'Halaman Utama Pasien')
@section('setAktifHalamanUtama', 'active')


@section('customCSS')
    <link href="/home-pasien-assets/css/style.css" rel="stylesheet">
@endsection

@section('content')

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <h1>Welcome to Our Hospital</h1>
            <h2>We are a team of talented doctors and healthcare staffs</h2>
        </div>
    </section><!-- End Hero -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="content">
                        <h3>Why Choose Our Hospital?</h3>
                        <p>At our hospital, we prioritize your health and well-being with a team of skilled professionals
                            dedicated to your care. Our state-of-the-art facilities and compassionate approach ensure the
                            best possible outcomes. Trust us for innovative treatments and a comfortable, supportive
                            environment.</p>
                    </div>
                </div>
                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-receipt"></i>
                                    <h4>Customer Focus</h4>
                                    <p>We are committed to meeting your needs with exceptional service and attention.</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-cube-alt"></i>
                                    <h4>Strive for Excellence</h4>
                                    <p>We are dedicated to achieving the highest standards in all we do.</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-cube-alt"></i>
                                    <h4>Integrity</h4>
                                    <p>We uphold the highest ethical standards in all our actions.</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .content-->
                </div>
            </div>
        </div>
    </section><!-- End Why Us Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="row">
            <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative">
                <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox play-btn mb-4"></a>
            </div>
            <div
                class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
                <h3>Exceptional Care and Services</h3>
                <p>We provide comprehensive and compassionate care tailored to your needs. Our dedicated team ensures that
                    each patient receives personalized attention, ensuring comfort and the highest quality of service.
                    Experience excellence with our state-of-the-art facilities and committed staff.</p>
                <div class="icon-box">
                    <div class="icon"><i class="bx bx-fingerprint"></i></div>
                    <h4 class="title">Our Team</h4>
                    <p class="description">Our skilled professionals are dedicated to providing exceptional care, working
                        collaboratively to ensure the best outcomes for our patients.</p>
                </div>
                <div class="icon-box">
                    <div class="icon"><i class="bx bx-gift"></i></div>
                    <h4 class="title">Facilities</h4>
                    <p class="description">We offer state-of-the-art facilities equipped with the latest technology to
                        provide top-notch medical care in a comfortable environment.</p>
                </div>
                <div class="icon-box">
                    <div class="icon"><i class="bx bx-atom"></i></div>
                    <h4 class="title">Procedure</h4>
                    <p class="description">Our streamlined procedures ensure efficiency and effectiveness, minimizing wait
                        times while maximizing the quality of care.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
