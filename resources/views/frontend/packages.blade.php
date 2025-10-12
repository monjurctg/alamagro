@extends('layouts.frontend')

@section('title', __('Packages'))
@php
$PageVariation = PageVariation();
$gtext = gtext();
@endphp

@section('meta-content')
    <meta name="keywords" content="{{ $gtext['og_keywords'] }}" />
    <meta name="description" content="{{ $gtext['og_description'] }}" />
    <meta property="og:title" content="{{ $gtext['og_title'] }}" />
    <meta property="og:site_name" content="{{ $gtext['site_name'] }}" />
    <meta property="og:description" content="{{ $gtext['og_description'] }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('public/media/'.$gtext['og_image']) }}" />
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    @if($gtext['fb_publish'] == 1)
    <meta name="fb:app_id" property="fb:app_id" content="{{ $gtext['fb_app_id'] }}" />
    @endif
    <meta name="twitter:card" content="summary_large_image">
    @if($gtext['twitter_publish'] == 1)
    <meta name="twitter:site" content="{{ $gtext['twitter_id'] }}">
    <meta name="twitter:creator" content="{{ $gtext['twitter_id'] }}">
    @endif
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $gtext['og_title'] }}">
    <meta name="twitter:description" content="{{ $gtext['og_description'] }}">
    <meta name="twitter:image" content="{{ asset('public/media/'.$gtext['og_image']) }}">
    <title>তরুলতা - বাগান পরিচর্যা সেবা | চট্টগ্রাম</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Sans+Bengali:wght@300;400;500;600;700&display=swap" rel="stylesheet">
@endsection

@section('header')
@include('frontend.partials.header')
@endsection

@section('content')
<style>
    :root {
        --primary-green: #10b981;
        --dark-green: #059669;
        --darker-green: #065f46;
        --light-green: #ecfdf5;
        --gradient-start: #0f766e;
        --gradient-end: #25a573;
        --white: #ffffff;
        --light-gray: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        --amber: #f59e0b;
        --amber-bg: #fffbeb;
    }

    body {
        font-family: 'Inter', 'Noto Sans Bengali', sans-serif;
        line-height: 1.65;
        background-color: var(--light-gray);
        color: var(--gray-800);
        scroll-behavior: smooth;
    }

    .hero-gradient {
        background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }

    .hero-gradient::before {
        content: "";
        position: absolute;
        top: -40%;
        right: -10%;
        width: 800px;
        height: 800px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.06);
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 20px;
    }

    .hover-lift {
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        will-change: transform;
    }

    .hover-lift:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
    }

    .gradient-text {
        background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: inline-block;
    }

    .price-card {
        background: var(--white);
        border-radius: 20px;
        padding: 40px 30px;
        height: 100%;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid var(--gray-200);
        position: relative;
    
    }

    .price-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        border-radius: 20px;
        
        background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
        transform: scaleX(0);

        transition: transform 0.3s ease;
    }

    .price-card:hover::before {
        transform: scaleX(1);
    }

    .price-card.featured {
        background: linear-gradient(145deg, var(--darker-green), var(--dark-green));
        color: white;
        border: none;
        box-shadow: 0 10px 35px rgba(6, 95, 70, 0.35);
        transform: scale(1.03);
    }

    .price-card.featured .text-gray-800,
    .price-card.featured .text-gray-700,
    .price-card.featured .text-gray-600 {
        color: white !important;
    }

    .popular-badge {
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        color: var(--gray-900);
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }

    .icon-container {
        width: 80px;
        height: 80px;
        background: rgba(16, 185, 129, 0.1);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
    }

    .icon-container i {
        color: var(--primary-green);
        font-size: 2rem;
    }

    .feature-list {
        list-style: none;
        padding-left: 0;
    }

    .feature-list li {
        margin-bottom: 12px;
        display: flex;
        align-items: flex-start;
    }

    .feature-list li i {
        color: var(--primary-green);
        min-width: 20px;
        margin-right: 12px;
        margin-top: 4px;
        font-size: 0.9rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        padding: 12px 28px;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        transition: all 0.25s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--dark-green), var(--darker-green));
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }

    .btn-secondary {
        background: white;
        color: var(--primary-green);
        border: 2px solid var(--primary-green);
        border-radius: 12px;
        font-weight: 600;
        padding: 12px 28px;
        transition: all 0.25s ease;
    }

    .btn-secondary:hover {
        background: var(--primary-green);
        color: white;
        transform: translateY(-2px);
    }

    .section-padding {
        padding: 100px 0;
    }

    .important-note {
        background: var(--amber-bg);
        border-left: 6px solid var(--amber);
        border-radius: 0 16px 16px 0;
        padding: 40px;
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.1);
    }

    .whatsapp-float {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: #25D366;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
        z-index: 1050;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .whatsapp-float:hover {
        transform: scale(1.15) rotate(8deg);
        background: #128C7E;
    }

    .scroll-top {
        position: fixed;
        bottom: 30px;
        left: 30px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--gray-800);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        z-index: 1050;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .scroll-top:hover {
        transform: scale(1.15);
        background: var(--darker-green);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .section-padding { padding: 80px 0; }
        .hero-gradient { padding: 80px 0; }
    }

    @media (max-width: 768px) {
        h1 { font-size: 2.3rem !important; }
        h2 { font-size: 1.9rem !important; }
        .price-card.featured { transform: scale(1); }
    }

    @media (max-width: 576px) {
        .btn { width: 100%; margin-bottom: 12px; }
        .btn:last-child { margin-bottom: 0; }
        .whatsapp-float { width: 60px; height: 60px; bottom: 20px; right: 20px; }
        .scroll-top { width: 50px; height: 50px; bottom: 20px; left: 20px; }
    }
</style>

<!-- Hero Section -->
<section class="hero-gradient">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center text-white">
                <div class="mb-4">
                    <i class="fas fa-leaf fa-4x text-light mb-4"></i>
                </div>
                <h1 class="display-4 fw-bold mb-4 text-light">
                    গাছের যত্ন নিতে পারছেন না?
                </h1>
                <p class="fs-5 mb-5 lh-lg text-light">
                    বাগান আছে কিন্তু পরিচর্যার সময় নেই, তাই বাগানের গাছের অবস্থা খারাপ?
                    চট্টগ্রাম শহরে এখন ঘরে বসেই পাচ্ছেন নির্ভরযোগ্য মালি সার্ভিস—আপনার গাছের জন্য ঠিক ততটা যত্ন, যতটা
                    আপনার নিজের জন্য চান।
                </p>
                <div class="glass-effect rounded-4 p-4 p-md-5 mb-5 hover-lift">
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-center mb-3">
                        <i class="fas fa-home fa-2x me-0 me-md-3 mb-2 mb-md-0"></i>
                        <h3 class="fs-2 fw-semibold text-center text-md-start">ঘরে বসেই পেশাদার সেবা</h3>
                    </div>
                    <p class="fs-5 text-light mb-0">বিশেষজ্ঞ মালি দিয়ে আপনার বাগানকে জীবন্ত করুন</p>
                </div>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                    <a href="#packages" class="btn btn-warning btn-lg px-4 py-3 fw-semibold hover-lift">
                        <i class="fas fa-tags me-2"></i>প্যাকেজ দেখুন
                    </a>
                    <a href="https://wa.me/8801886950681" class="btn btn-outline-light btn-lg px-4 py-3 fw-semibold hover-lift">
                        <i class="fab fa-whatsapp me-2"></i>হোয়াটসঅ্যাপ
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Monthly Packages -->
<section id="packages" class="section-padding bg-white">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="display-4 fw-bold text-gray-800 mb-3">
                    মাসিক পরিচর্যার <span class="gradient-text">প্যাকেজ</span>
                </h2>
                <p class="fs-4 text-gray-600">আপনার বাগানের জন্য উপযুক্ত প্যাকেজ বেছে নিন</p>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach ($monthlyPackages as $package)
                <div class="col-md-6 col-lg-4">
                    <div class="price-card hover-lift {{ $package['is_popular'] ? 'featured position-relative' : '' }}">
                        @if ($package['is_popular'])
                            <div class="position-absolute top-0 start-50 translate-middle-x" style="margin-top: -20px;">
                                <span class="popular-badge">
                                    <i class="fas fa-star"></i> সবচেয়ে জনপ্রিয়
                                </span>
                            </div>
                        @endif
                        <div class="text-center mb-4">
                            <div class="icon-container">
                                <i class="fas fa-seedling"></i>
                            </div>
                            <h3 class="fs-2 fw-bold {{ $package['is_popular'] ? 'text-white' : 'text-gray-800' }} mb-2">
                                {{ $package['title'] }}
                            </h3>
                            <div class="fs-1 fw-bold {{ $package['is_popular'] ? 'text-white' : 'text-green-600' }} mb-2">
                                {{ $package['price'] }} টাকা
                            </div>
                            <p class="{{ $package['is_popular'] ? 'text-light' : 'text-gray-600' }} mb-1">{{ $package['subtitle'] }}</p>
                            <p class="text-sm {{ $package['is_popular'] ? 'text-green-100' : 'text-gray-500' }}">{{ $package['frequency'] }}</p>
                        </div>
                        <ul class="feature-list mb-4">
                            @foreach ($package['features'] as $feature)
                                <li><i class="fas fa-check"></i> {{ $feature }}</li>
                            @endforeach
                        </ul>
                        <a href="tel:01886950681" class="btn btn-primary w-100 py-3 fw-semibold">
                            <i class="fas fa-phone me-2"></i>বুক করুন
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Full-Day Packages -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="display-4 fw-bold text-gray-800 mb-3">
                    গাছের সংখ্যা অনুযায়ী <span class="gradient-text">পূর্ণ দিনের সেবা</span>
                </h2>
                <p class="fs-4 text-gray-600">
                    বড় বাগানের জন্য গাছের সংখ্যা অনুযায়ী পূর্ণ দিনের সেবা
                </p>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach ($fulldayPackages as $package)
                <div class="col-md-6 col-lg-4">
                    <div class="price-card hover-lift {{ $package['is_popular'] ? 'featured position-relative' : '' }}">
                        @if ($package['is_popular'])
                            <div class="position-absolute top-0 start-50 translate-middle-x" style="margin-top: -20px;">
                                <span class="popular-badge">
                                    <i class="fas fa-star me-1"></i>জনপ্রিয়
                                </span>
                            </div>
                        @endif
                        <div class="text-center mb-4">
                            <div class="icon-container">
                                <i class="fas fa-tree"></i>
                            </div>
                            <h3 class="fs-2 fw-bold {{ $package['is_popular'] ? 'text-white' : 'text-gray-800' }} mb-2">{{ $package['title'] }}</h3>
                            <div class="fs-1 fw-bold {{ $package['is_popular'] ? 'text-white' : 'text-green-600' }} mb-2">{{ $package['price'] }} টাকা</div>
                            <p class="{{ $package['is_popular'] ? 'text-light' : 'text-gray-600' }} mb-1">{{ $package['subtitle'] }}</p>
                            <p class="text-sm {{ $package['is_popular'] ? 'text-green-100' : 'text-gray-500' }}">{{ $package['frequency'] }}</p>
                        </div>
                        <ul class="feature-list mb-4">
                            @foreach ($package['features'] as $feature)
                                <li><i class="fas fa-check"></i> {{ $feature }}</li>
                            @endforeach
                        </ul>
                        <a href="tel:01886950681" class="btn btn-primary w-100 py-3 fw-semibold">
                            <i class="fas fa-phone me-2"></i>বুক করুন
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Landscaping Services -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="display-4 fw-bold text-gray-800 mb-3">
                    <span class="gradient-text">ল্যান্ডস্কেপিং</span> সেবা
                </h2>
                <p class="fs-4 text-gray-600">
                    বড় বাগানের জন্য স্কয়ার ফিট অনুযায়ী সেবা
                </p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="price-card hover-lift text-center">
                    <div class="icon-container mb-4">
                        <i class="fas fa-ruler-combined"></i>
                    </div>
                    <h3 class="fs-2 fw-bold text-gray-800 mb-3">স্কয়ার ফিট অনুযায়ী সেবা</h3>
                    <p class="fs-5 text-gray-600 mb-4">
                        বড় বাগান বা ল্যান্ডস্কেপিং প্রকল্পের জন্য আমাদের বিশেষ সেবা
                    </p>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h4 class="fs-4 fw-semibold text-gray-800 mb-3">সেবার অন্তর্ভুক্ত:</h4>
                            <ul class="feature-list text-start">
                                <li><i class="fas fa-check"></i> সম্পূর্ণ বাগান ডিজাইন</li>
                                <li><i class="fas fa-check"></i> গাছ রোপণ ও ব্যবস্থাপনা</li>
                                <li><i class="fas fa-check"></i> সেচ ব্যবস্থা স্থাপন</li>
                                <li><i class="fas fa-check"></i> পাথর ও পাথুরে সাজসজ্জা</li>
                                <li><i class="fas fa-check"></i> আলোকসজ্জা</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-3 p-4 h-100">
                                <h4 class="fs-4 fw-semibold text-gray-800 mb-3">মূল্য নির্ধারণ:</h4>
                                <div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-white rounded-2">
                                    <span class="text-gray-700">স্কয়ার ফিট অনুযায়ী</span>
                                    <span class="fw-bold text-green-600">চুক্তি ভিত্তিক</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-white rounded-2">
                                    <span class="text-gray-700">মূল্যায়ন</span>
                                    <span class="fw-bold text-green-600">বিনামূল্যে</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white rounded-2">
                                    <span class="text-gray-700">ডিজাইন পরিকল্পনা</span>
                                    <span class="fw-bold text-green-600">অন্তর্ভুক্ত</span>
                                </div>
                                <div class="mt-3 p-3 bg-white rounded-2">
                                    <p class="text-sm text-gray-600 text-center mb-0">
                                        <i class="fas fa-phone text-green-500 me-2"></i>
                                        বিস্তারিত জানতে কল করুন: <strong>01886-950681</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="display-4 fw-bold text-gray-800 mb-3">
                    যা যা <span class="gradient-text">থাকছে</span>
                </h2>
                <p class="fs-4 text-gray-600">
                    আমাদের পেশাদার সেবার বিস্তারিত
                </p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="service-card hover-lift">
                    <div class="icon-container">
                        <i class="fas fa-cut"></i>
                    </div>
                    <h3 class="fs-4 fw-bold text-gray-800 mb-3">গাছ ছাঁটাই</h3>
                    <p class="text-gray-600">পেশাদার উপায়ে গাছের ছাঁটাই করে সুন্দর আকৃতি দেওয়া</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="service-card hover-lift">
                    <div class="icon-container">
                        <i class="fas fa-broom"></i>
                    </div>
                    <h3 class="fs-4 fw-bold text-gray-800 mb-3">আগাছা পরিষ্কার</h3>
                    <p class="text-gray-600">বাগান থেকে সব ধরনের আগাছা পরিষ্কার করা</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="service-card hover-lift">
                    <div class="icon-container">
                        <i class="fas fa-tint"></i>
                    </div>
                    <h3 class="fs-4 fw-bold text-gray-800 mb-3">সার-পানি দেওয়া</h3>
                    <p class="text-gray-600">গাছের জন্য প্রয়োজনীয় সার ও পানি সরবরাহ</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="service-card hover-lift">
                    <div class="icon-container">
                        <i class="fas fa-pills"></i>
                    </div>
                    <h3 class="fs-4 fw-bold text-gray-800 mb-3">মেডিসিন দেওয়া</h3>
                    <p class="text-gray-600">গাছের রোগ-বালাই থেকে রক্ষার জন্য প্রয়োজনীয় ওষুধ</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="service-card hover-lift">
                    <div class="icon-container">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="fs-4 fw-bold text-gray-800 mb-3">সবুজ প্রাণবন্ত করা</h3>
                    <p class="text-gray-600">আপনার বাগানটাকে আবার সবুজ প্রাণবন্ত করে তোলা</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="service-card hover-lift">
                    <div class="icon-container">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3 class="fs-4 fw-bold text-gray-800 mb-3">সরঞ্জাম প্রদান</h3>
                    <p class="text-gray-600">সব কাজের সরঞ্জাম তরুলতা থেকে প্রদান করা হবে</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Important Note -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="important-note hover-lift">
                    <div class="d-flex">
                        <div class="flex-shrink-0 mt-1">
                            <i class="fas fa-exclamation-triangle text-warning fs-4"></i>
                        </div>
                        <div class="ms-4">
                            <h3 class="fs-4 fw-bold text-gray-800 mb-3">গুরুত্বপূর্ণ তথ্য</h3>
                            <p class="text-gray-700 fs-5">
                                শুধুমাত্র কাজের সরঞ্জামসমূহ প্রদান করা হবে তরুলতা থেকে।
                                সার কিংবা অন্য সকল জিনিস গ্রাহক থেকে সরবরাহ করতে হবে।
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="section-padding hero-gradient">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="display-4 fw-bold text-white mb-3">
                    বুকিং করুন <span class="text-warning">এখনই</span>
                </h2>
                <p class="fs-4 text-green-100">
                    আমাদের সাথে যোগাযোগ করে আপনার বাগানের যত্ন শুরু করুন
                </p>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="glass-effect contact-card hover-lift">
                    <div class="icon-container mb-4">
                        <i class="fas fa-phone text-white"></i>
                    </div>
                    <h3 class="fs-2 fw-bold text-white mb-3">ফোন করুন</h3>
                    <a href="tel:01886950681" class="fs-1 fw-bold text-warning text-decoration-none d-block mb-3">
                        01886-950681
                    </a>
                    <p class="text-green-100">সরাসরি কল করে কথা বলুন</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-5">
                <div class="glass-effect contact-card hover-lift">
                    <div class="icon-container mb-4">
                        <i class="fab fa-whatsapp text-white"></i>
                    </div>
                    <h3 class="fs-2 fw-bold text-white mb-3">হোয়াটসঅ্যাপ</h3>
                    <a href="https://wa.me/8801886950681" class="fs-1 fw-bold text-warning text-decoration-none d-block mb-3">
                        01886-950681
                    </a>
                    <p class="text-green-100">হোয়াটসঅ্যাপে বিস্তারিত আলোচনা করুন</p>
                </div>
            </div>
        </div>
    </div>
</section>

<a href="https://wa.me/8801886950681" class="whatsapp-float" aria-label="WhatsApp">
    <i class="fab fa-whatsapp fs-2"></i>
</a>

<button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="scroll-top" aria-label="Scroll to top">
    <i class="fas fa-arrow-up"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection