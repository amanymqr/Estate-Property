@extends('frontend.frontend_dashboard')
@section('title', 'Details Property')
@section('content')

    <!--Page Title-->
    <section class="page-title-two bg-color-1 centred">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{ asset('frontendassets/images/shape/shape-9.png') }});">
            </div>
            <div class="pattern-2" style="background-image: url({{ asset('frontendassets/images/shape/shape-10.png') }});">
            </div>
        </div>
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>{{ $property->property_name }}</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="index.html">Home</a></li>
                    <li>{{ $property->property_name }} </li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->


    <!-- property-details -->
    <section class="property-details property-details-one">
        <div class="auto-container">
            <div class="top-details clearfix">
                <div class="left-column pull-left clearfix">
                    <h3>{{ $property->property_name }}</h3>
                    <div class="author-info clearfix">
                        <div class="author-box pull-left">
                            @if ($property->agent_id == null)
                                <figure class="author-thumb"><img src="{{ url('upload/ariyan.jpg') }}" alt="">
                                </figure>
                                <h6>Admin</h6>
                            @else
                                <figure class="author-thumb"><img
                                        src="{{ !empty($property->user->photo) ? url('upload/agent_images/' . $property->user->photo) : url('upload/no_image.jpg') }}"
                                        alt=""></figure>
                                <h6>{{ $property->user->name }}</h6>
                            @endif


                        </div>
                        <ul class="rating clearfix pull-left">
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-40"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="right-column pull-right clearfix">
                    <div class="price-inner clearfix">
                        <ul class="category clearfix pull-left">
                            <li><a href="property-details.html">{{ $property->propertyType->type_name }}</a></li>
                            <li><a href="property-details.html">{{ $property->property_status }}</a></li>
                        </ul>
                        <div class="price-box pull-right">
                            <h3>${{ $property->lowest_price }}</h3>
                        </div>
                    </div>
                    <ul class="other-option pull-right clearfix">
                        <li><a href="property-details.html"><i class="icon-37"></i></a></li>
                        <li><a href="property-details.html"><i class="icon-38"></i></a></li>
                        <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                        <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="similar-content">
            <div class="auto-container">

                <div class="title">
                    <h4>Similar Properties</h4>
                </div>
                <div class="row clearfix">

                    @foreach ($relatedProperty as $item)
                        <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                            <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms"
                                data-wow-duration="1500ms">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset($item->property_thambnail) }}"
                                                alt=""></figure>
                                        <div class="batch"><i class="icon-11"></i></div>
                                        <span class="category">{{ $item->propertyType->type_name }}</span>
                                    </div>
                                    <div class="lower-content">
                                        <div class="author-info clearfix">
                                            <div class="author pull-left">
                                                @if ($item->agent_id == null)
                                                    <figure class="author-thumb"><img src="{{ url('upload/ariyan.jpg') }}"
                                                            alt=""></figure>
                                                    <h6>Admin </h6>
                                                @else
                                                    <figure class="author-thumb"><img
                                                            src="{{ !empty($item->user->photo) ? url('upload/agent_images/' . $item->user->photo) : url('upload/no_image.jpg') }}"
                                                            alt=""></figure>
                                                    <h6>{{ $item->user->name }}</h6>
                                                @endif
                                            </div>
                                            <div class="buy-btn pull-right"><a href="property-details.html">For
                                                    {{ $item->property_status }}</a></div>
                                        </div>
                                        <div class="title-text">
                                            <h4><a
                                                    href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}">{{ $item->property_name }}</a>
                                            </h4>
                                        </div>
                                        <div class="price-box clearfix">
                                            <div class="price-info pull-left">
                                                <h6>Start From</h6>
                                                <h4>${{ $item->lowest_price }}</h4>
                                            </div>
                                            <ul class="other-option pull-right clearfix">
                                                <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                                                <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                                            </ul>
                                        </div>
                                        <p>{{ $item->short_descp }}</p>
                                        <ul class="more-details clearfix">
                                            <li><i class="icon-14"></i>{{ $item->bedrooms }} Beds</li>
                                            <li><i class="icon-15"></i>{{ $item->bathrooms }} Baths</li>
                                            <li><i class="icon-16"></i>{{ $item->property_size }} Sq Ft</li>
                                        </ul>
                                        <div class="btn-box"><a
                                                href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}"
                                                class="theme-btn btn-two">See Details</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>
            </div>
        </div>
        {{--  </div>  --}}
    </section>
    <!-- property-details end -->


    <!-- subscribe-section -->
    <section class="subscribe-section bg-color-3">
        <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-2.png);"></div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                    <div class="text">
                        <span>Subscribe</span>
                        <h2>Sign Up To Our Newsletter To Get The Latest News And Offers.</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 form-column">
                    <div class="form-inner">
                        <form action="contact.html" method="post" class="subscribe-form">
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Enter your email" required="">
                                <button type="submit">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- subscribe-section end -->
@endsection
