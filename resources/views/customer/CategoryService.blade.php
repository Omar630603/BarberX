@extends('layouts.customer')

@section('hero')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Service</h2>
            </div>
            <div class="col-12">
                <a href="">Home</a>
                <a href="">Category Service</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
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
                        <img src="img/service-1.jpg" alt="Image">
                    </div>
                    <h3>Hair Cut</h3>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non
                    </p>
                    <a class="btn" href="">Learn More</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="service-img">
                        <img src="img/service-2.jpg" alt="Image">
                    </div>
                    <h3>Beard Style</h3>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non
                    </p>
                    <a class="btn" href="">Learn More</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="service-img">
                        <img src="img/service-3.jpg" alt="Image">
                    </div>
                    <h3>Color & Wash</h3>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non
                    </p>
                    <a class="btn" href="">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection