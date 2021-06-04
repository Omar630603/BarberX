@extends('layouts.customer')

@section('hero')
<!-- Hero Start -->
<div class="hero">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="hero-text">
                    <h1>HTML5 Template for Salon Website</h1>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasell nec pretum mi. Curabi ornare velit non. Aliqua metus
                        tortor auctor quis sem.
                    </p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 d-none d-md-block">
                <div class="hero-image">
                    <img src="{{asset('assets/assetsCustomer/img/hero.png')}}" alt="Hero Image">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

@endsection

@section('content')
<!-- About Start -->
<div class="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-6">
                <div class="about-img">
                    <img src="{{asset('assets/assetsCustomer/img/about.jpg')}}" alt="Image">
                </div>
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="section-header text-left">
                    <p>Learn About Us</p>
                    <h2>25 Years Experience</h2>
                </div>
                <div class="about-text">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur
                        facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum,
                        viverra quis sem.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur
                        facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum,
                        viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus. Aenean consectetur convallis
                        porttitor. Aliquam interdum at lacus non blandit.
                    </p>
                    <a class="btn" href="">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Service Start -->
<div class="service">
    <div class="container">
        <div class="section-header text-center">
            <p>Our Salon Services</p>
            <h2>Best Salon and Barber Services for You</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="service-img">
                        <img src="{{asset('assets/assetsCustomer/img/service-1.jpg')}}" alt="Image">
                    </div>
                    <h3>Hair Cut</h3>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non
                    </p>
                    <a class="btn" href="{{route('serviceCustomer')}}">Learn More</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="service-img">
                        <img src="{{asset('assets/assetsCustomer/img/service-2.jpg')}}" alt="Image">
                    </div>
                    <h3>Beard Style</h3>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non
                    </p>
                    <a class="btn" href="{{route('serviceCustomer')}}">Learn More</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="service-img">
                        <img src="{{asset('assets/assetsCustomer/img/service-3.jpg')}}" alt="Image">
                    </div>
                    <h3>Color & Wash</h3>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non
                    </p>
                    <a class="btn" href="{{route('serviceCustomer')}}">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->


<!-- Pricing Start -->
<div class="price">
    <div class="container">
        <div class="section-header text-center">
            <p>Our Best Pricing</p>
            <h2>We Provide Best Price in the City</h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="price-item">
                    <div class="price-img">
                        <img src="{{asset('assets/assetsCustomer/img/price-1.jpg')}}" alt="Image">
                    </div>
                    <div class="price-text">
                        <h2>Hair Cut</h2>
                        <h3>$9.99</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="price-item">
                    <div class="price-img">
                        <img src="{{asset('assets/assetsCustomer/img/price-2.jpg')}}" alt="Image">
                    </div>
                    <div class="price-text">
                        <h2>Hair Wash</h2>
                        <h3>$10.99</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="price-item">
                    <div class="price-img">
                        <img src="{{asset('assets/assetsCustomer/img/price-3.jpg')}}" alt="Image">
                    </div>
                    <div class="price-text">
                        <h2>Hair Color</h2>
                        <h3>$11.99</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="price-item">
                    <div class="price-img">
                        <img src="{{asset('assets/assetsCustomer/img/price-4.jpg')}}" alt="Image">
                    </div>
                    <div class="price-text">
                        <h2>Hair Shave</h2>
                        <h3>$12.99</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="price-item">
                    <div class="price-img">
                        <img src="{{asset('assets/assetsCustomer/img/price-5.jpg')}}" alt="Image">
                    </div>
                    <div class="price-text">
                        <h2>Hair Straight</h2>
                        <h3>$13.99</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="price-item">
                    <div class="price-img">
                        <img src="{{asset('assets/assetsCustomer/img/price-6.jpg')}}" alt="Image">
                    </div>
                    <div class="price-text">
                        <h2>Facial</h2>
                        <h3>$14.99</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="price-item">
                    <div class="price-img">
                        <img src="{{asset('assets/assetsCustomer/img/price-7.jpg')}}" alt="Image">
                    </div>
                    <div class="price-text">
                        <h2>Shampoo</h2>
                        <h3>$15.99</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="price-item">
                    <div class="price-img">
                        <img src="{{asset('assets/assetsCustomer/img/price-8.jpg')}}" alt="Image">
                    </div>
                    <div class="price-text">
                        <h2>Beard Trim</h2>
                        <h3>$16.99</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="price-item">
                    <div class="price-img">
                        <img src="{{asset('assets/assetsCustomer/img/price-9.jpg')}}" alt="Image">
                    </div>
                    <div class="price-text">
                        <h2>Beard Shave</h2>
                        <h3>$17.99</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="price-item">
                    <div class="price-img">
                        <img src="{{asset('assets/assetsCustomer/img/price-10.jpg')}}" alt="Image">
                    </div>
                    <div class="price-text">
                        <h2>Wedding Cut</h2>
                        <h3>$18.99</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="price-item">
                    <div class="price-img">
                        <img src="{{asset('assets/assetsCustomer/img/price-11.jpg')}}" alt="Image">
                    </div>
                    <div class="price-text">
                        <h2>Clean Up</h2>
                        <h3>$19.99</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="price-item">
                    <div class="price-img">
                        <img src="{{asset('assets/assetsCustomer/img/price-12.jpg')}}" alt="Image">
                    </div>
                    <div class="price-text">
                        <h2>Massage</h2>
                        <h3>$20.99</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pricing End -->


<!-- Testimonial Start -->
<div class="testimonial">
    <div class="container">
        <div style="margin-bottom: 40px">
            <h2 style="color: #fff">Testimonies from Customers</h2>
        </div>
        <div class="owl-carousel testimonials-carousel">
            @if (count($msg)<=0) <center>
                <h2 style="color: #fff">There are no Messages to show</h2>
                </center>
                @else

                @foreach ($msg as $m)
                @if ($m->show)
                <div class="testimonial-item">
                    <h3>{{$m->name}}</h3>
                    <h2>{{$m->title}}</h2>
                    <p>{{$m->messagetext}}</p>
                </div>
                @endif
                @endforeach
                @endif
        </div>
    </div>
</div>
<!-- Testimonial End -->


<!-- Team Start -->
<div class="team">
    <div class="container">
        <div class="section-header text-center">
            <p>Our Barber Team</p>
            <h2>Meet Our Hair Cut Expert Barber</h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="team-item">
                    <div class="team-img">
                        <img src="{{asset('assets/assetsCustomer/img/team-1.jpg')}}" alt="Team Image">
                    </div>
                    <div class="team-text">
                        <h2>Adam Phillips</h2>
                        <p>Master Barber</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="team-item">
                    <div class="team-img">
                        <img src="{{asset('assets/assetsCustomer/img/team-2.jpg')}}" alt="Team Image">
                    </div>
                    <div class="team-text">
                        <h2>Dylan Adams</h2>
                        <p>Hair Expert</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="team-item">
                    <div class="team-img">
                        <img src="{{asset('assets/assetsCustomer/img/team-3.jpg')}}" alt="Team Image">
                    </div>
                    <div class="team-text">
                        <h2>Gloria Edwards</h2>
                        <p>Beard Expert</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="team-item">
                    <div class="team-img">
                        <img src="{{asset('assets/assetsCustomer/img/team-4.jpg')}}" alt="Team Image">
                    </div>
                    <div class="team-text">
                        <h2>Josh Dunn</h2>
                        <p>Color Expert</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->


<!-- Contact Start -->
<div class="contact">
    <div class="container-fluid">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <div class="contact-form">
                        <div id="success"></div>
                        <form name="sentMessage" id="contactForm" novalidate="novalidate">
                            <div class="control-group">
                                <input type="text" class="form-control" id="name" placeholder="Your Name"
                                    required="required" data-validation-required-message="Please enter your name" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="email" class="form-control" id="email" placeholder="Your Email"
                                    required="required" data-validation-required-message="Please enter your email" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control" id="subject" placeholder="Subject"
                                    required="required" data-validation-required-message="Please enter a subject" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control" id="message" placeholder="Message" required="required"
                                    data-validation-required-message="Please enter your message"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div>
                                <button class="btn" type="submit" id="sendMessageButton">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->



@endsection