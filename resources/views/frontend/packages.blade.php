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
        --primary-green: #059669;
        --dark-green: #047857;
        --darker-green: #064e3b;
        --light-green: #d1fae5;
        --accent-yellow: #f59e0b;
        --gradient-start: #10b981;
        --gradient-end: #047857;
        --white: #ffffff;
        --light-gray: #f3f4f6;
        --text-dark: #1f2937;
        --text-muted: #6b7280;
    }

    body {
        font-family: 'Inter', 'Noto Sans Bengali', sans-serif;
        background-color: #f9fafb;
        color: var(--text-dark);
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-up {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }

    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }

    /* Hero Section */
    .hero-gradient {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        padding: 120px 0;
        position: relative;
        overflow: hidden;
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
    }

    /* Cards */
    .price-card {
        background: var(--white);
        border-radius: 24px;
        padding: 2rem;
        height: 100%;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.025);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .price-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .price-card.featured {
        background: linear-gradient(145deg, var(--dark-green), var(--darker-green));
        color: white;
        border: none;
        box-shadow: 0 20px 40px -5px rgba(5, 150, 105, 0.4);
    }

    .price-card.featured .text-gray-800,
    .price-card.featured .text-gray-600,
    .price-card.featured .text-gray-500 {
        color: rgba(255, 255, 255, 0.9) !important;
    }

    .price-card.featured .text-green-600 {
        color: #ffffff !important;
    }

    .price-card.featured .icon-container {
        background: rgba(255, 255, 255, 0.15);
        color: white;
    }

    .price-card.featured .icon-container i {
        color: white;
    }

    .price-card.featured .btn-primary {
         background: white;
         color: var(--dark-green);
    }

    .price-card.featured .btn-primary:hover {
         background: var(--light-green);
    }

    .popular-badge {
        background: var(--accent-yellow);
        color: #fff;
        padding: 6px 16px;
        border-radius: 99px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        box-shadow: 0 4px 6px -1px rgba(245, 158, 11, 0.4);
    }

    .icon-container {
        width: 70px;
        height: 70px;
        background: var(--light-green);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        transition: transform 0.3s ease;
    }

    .price-card:hover .icon-container {
        transform: scale(1.1) rotate(5deg);
    }

    .icon-container i {
        font-size: 1.75rem;
        color: var(--dark-green);
    }

    .feature-list li {
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        color: var(--text-muted);
    }

    .price-card.featured .feature-list li {
        color: rgba(255,255,255,0.85);
    }

    .feature-list li i {
        color: var(--primary-green);
        margin-right: 10px;
    }

    .price-card.featured .feature-list li i {
        color: var(--accent-yellow);
    }

    .btn-primary {
        background-color: var(--primary-green);
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-primary:hover {
        background-color: var(--dark-green);
        transform: translateY(-2px);
    }

    .gradient-text {
        background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .section-padding {
        padding: 100px 0;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .hero-gradient { padding: 80px 0; }
        .price-card { padding: 1.5rem; }
    }
</style>

<!-- Hero Section -->
<section class="hero-gradient">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center animate-up">
                <div class="mb-4">
                    <div class="icon-container shadow-sm mx-auto bg-white">
                        <i class="fas fa-leaf text-success"></i>
                    </div>
                </div>
                <h1 class="display-4 fw-bold mb-4 text-dark">
                    গাছের যত্ন নিতে পারছেন না?
                </h1>
                <p class="fs-5 mb-5 lh-lg text-secondary mx-auto" style="max-width: 700px;">
                    বাগান আছে কিন্তু পরিচর্যার সময় নেই? চট্টগ্রাম শহরে এখন ঘরে বসেই পাচ্ছেন নির্ভরযোগ্য মালি সার্ভিস। আপনার শখের বাগানের জন্য আমরা দিচ্ছি পরিপূর্ণ যত্ন।
                </p>

                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                    <a href="#packages" class="btn btn-primary btn-lg px-5 py-3 fw-bold shadow-lg hover-lift">
                        <i class="fas fa-tags me-2"></i>প্যাকেজ দেখুন
                    </a>
                    <a href="https://wa.me/8801886950681" class="btn btn-outline-success btn-lg px-5 py-3 fw-bold hover-lift">
                        <i class="fab fa-whatsapp me-2"></i>হোয়াটসঅ্যাপ
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Monthly Packages -->
<section id="packages" class="section-padding">
    <div class="container">
        <div class="row justify-content-center mb-5 animate-up">
            <div class="col-lg-8 text-center">
                <span class="text-uppercase tracking-wider fw-bold text-success mb-2 d-block">আমাদের সেবা সমূহ</span>
                <h2 class="display-5 fw-bold text-dark mb-3">
                    মাসিক পরিচর্যার <span class="gradient-text">প্যাকেজ</span>
                </h2>
                <p class="text-muted fs-5">আপনার বাগানের ধরণ অনুযায়ী সেরা প্যাকেজটি বেছে নিন</p>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach ($monthlyPackages as $index => $package)
                <div class="col-md-6 col-lg-4 animate-up {{ $index > 0 ? 'delay-'.($index*100) : '' }}">
                    <div class="price-card {{ $package['is_popular'] ? 'featured' : '' }}">
                        @if ($package['is_popular'])
                            <!-- Popular Badge -->
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="popular-badge shadow-sm">
                                    <i class="fas fa-star me-1"></i>জনপ্রিয়
                                </span>
                            </div>
                        @endif

                        <div class="text-center mb-4 mt-2">
                             <div class="icon-container shadow-sm">
                                <i class="fas fa-seedling"></i>
                            </div>
                            <h3 class="h4 fw-bold {{ $package['is_popular'] ? 'text-white' : 'text-gray-800' }} mb-1">
                                {{ $package['title'] }}
                            </h3>
                             <p class="{{ $package['is_popular'] ? 'text-light opacity-75' : 'text-muted' }} small mb-3">{{ $package['subtitle'] }}</p>

                            <div class="d-flex align-items-baseline justify-content-center mb-1">
                                @if(isset($package['old_price']) && $package['old_price'] > 0)
                                    <span class="text-decoration-line-through text-muted fs-6 me-2">{{ $package['old_price'] }}</span>
                                @endif
                                <span class="display-6 fw-bold {{ $package['is_popular'] ? 'text-white' : 'text-green-600' }}">
                                    {{ $package['price'] }}
                                </span>
                                <span class="fs-5 fw-bold {{ $package['is_popular'] ? 'text-white' : 'text-green-600' }}">৳</span>
                            </div>
                            <p class="small {{ $package['is_popular'] ? 'text-light opacity-75' : 'text-muted' }}">{{ $package['frequency'] }}</p>
                        </div>

                        <hr class="{{ $package['is_popular'] ? 'border-light opacity-25' : 'text-muted opacity-10' }} my-4">

                        <ul class="feature-list mb-5 ps-2">
                            @foreach ($package['features'] as $feature)
                                <li><i class="fas fa-check-circle"></i> {{ $feature }}</li>
                            @endforeach
                        </ul>

                        <div class="mt-auto">
                            <button type="button" class="btn btn-primary w-100 py-3 shadow-sm" onclick="openBookingModal('{{ $package['title'] }}')">
                                <i class="fas fa-calendar-check me-2"></i>বুক করুন
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Full-Day Packages -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 animate-up">
            <div class="col-lg-8 text-center">
                 <span class="text-uppercase tracking-wider fw-bold text-success mb-2 d-block">বৃহৎ পরিসর</span>
                <h2 class="display-5 fw-bold text-dark mb-3">
                    গাছের সংখ্যা অনুযায়ী <span class="gradient-text">পূর্ণ দিনের সেবা</span>
                </h2>
                <p class="text-muted fs-5">
                    বড় বাগান বা ছাদ বাগানের জন্য সাশ্রয়ী প্যাকেজ
                </p>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach ($fulldayPackages as $index => $package)
                <div class="col-md-6 col-lg-4 animate-up {{ $index > 0 ? 'delay-'.($index*100) : '' }}">
                    <div class="price-card {{ $package['is_popular'] ? 'featured' : '' }}">
                        @if ($package['is_popular'])
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="popular-badge">
                                    <i class="fas fa-star me-1"></i>জনপ্রিয়
                                </span>
                            </div>
                        @endif

                        <div class="text-center mb-4 mt-2">
                            <div class="icon-container shadow-sm">
                                <i class="fas fa-tree"></i>
                            </div>
                            <h3 class="h4 fw-bold {{ $package['is_popular'] ? 'text-white' : 'text-gray-800' }} mb-1">{{ $package['title'] }}</h3>
                             <p class="{{ $package['is_popular'] ? 'text-light opacity-75' : 'text-muted' }} small mb-3">{{ $package['subtitle'] }}</p>

                             <div class="d-flex align-items-baseline justify-content-center mb-1">
                                @if(isset($package['old_price']) && $package['old_price'] > 0)
                                    <span class="text-decoration-line-through text-muted fs-6 me-2">{{ $package['old_price'] }}</span>
                                @endif
                                <span class="display-6 fw-bold {{ $package['is_popular'] ? 'text-white' : 'text-green-600' }}">
                                    {{ $package['price'] }}
                                </span>
                                <span class="fs-5 fw-bold {{ $package['is_popular'] ? 'text-white' : 'text-green-600' }}">৳</span>
                            </div>
                            <p class="small {{ $package['is_popular'] ? 'text-light opacity-75' : 'text-muted' }}">{{ $package['frequency'] }}</p>
                        </div>

                         <hr class="{{ $package['is_popular'] ? 'border-light opacity-25' : 'text-muted opacity-10' }} my-4">

                        <ul class="feature-list mb-5 ps-2">
                            @foreach ($package['features'] as $feature)
                                <li><i class="fas fa-check-circle"></i> {{ $feature }}</li>
                            @endforeach
                        </ul>

                        <div class="mt-auto">
                            <button type="button" class="btn btn-primary w-100 py-3 shadow-sm" onclick="openBookingModal('{{ $package['title'] }}')">
                                <i class="fas fa-calendar-check me-2"></i>বুক করুন
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Landscaping Services -->
<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center mb-5 animate-up">
            <div class="col-lg-8 text-center">
                <span class="text-uppercase tracking-wider fw-bold text-success mb-2 d-block">বিশেষায়িত সেবা</span>
                <h2 class="display-5 fw-bold text-dark mb-3">
                    <span class="gradient-text">ল্যান্ডস্কেপিং</span> সলিউশন
                </h2>
                <p class="text-muted fs-5">
                    আপনার স্বপ্নের বাগানের সম্পূর্ণ ডিজাইন ও বাস্তবায়ন
                </p>
            </div>
        </div>
        <div class="row justify-content-center animate-up delay-200">
            <div class="col-lg-10">
                <div class="price-card text-center border-0 shadow-lg position-relative overflow-hidden p-5">
                    <!-- Background Decoration -->
                    <div class="position-absolute top-0 end-0 p-5 opacity-10" style="transform: translate(30%, -30%)">
                        <i class="fas fa-leaf fa-10x text-success"></i>
                    </div>

                    <div class="row align-items-center g-5 position-relative z-1">
                        <div class="col-md-6 text-md-start">
                            <div class="icon-container ms-0 mb-4 bg-success bg-opacity-10">
                                <i class="fas fa-ruler-combined text-success"></i>
                            </div>
                            <h3 class="h2 fw-bold text-dark mb-3">স্কয়ার ফিট হিসেবে সেবা</h3>
                            <p class="text-muted mb-4 lh-lg">
                                বড় পরিসরের বাগান, রিসোর্ট, বা ছাদ বাগানের ল্যান্ডস্কেপিং প্রকল্পের জন্য আমাদের রয়েছে অভিজ্ঞ টিম। আমরা আপনার জায়গার সর্বোচ্চ ব্যবহার নিশ্চিত করি।
                            </p>
                            <h5 class="fw-bold text-dark mb-3"><i class="fas fa-layer-group text-success me-2"></i>সেবাসমূহ:</h5>
                            <ul class="feature-list text-start mb-0">
                                <li><i class="fas fa-check-circle"></i> সম্পূর্ণ বাগান ডিজাইন ও থ্রি-ডি প্ল্যান</li>
                                <li><i class="fas fa-check-circle"></i> গাছ রোপণ, হার্ডস্কেপ ও পাথরের কাজ</li>
                                <li><i class="fas fa-check-circle"></i> আধুনিক সেচ ও ড্রেনেজ ব্যবস্থা</li>
                                <li><i class="fas fa-check-circle"></i> গার্ডেন লাইটিং ও ডেকোরেশন</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 border border-light">
                                <h4 class="h5 fw-bold text-dark mb-4 text-center">প্রজেক্ট ওভারভিউ</h4>

                                <div class="vstack gap-3">
                                    <div class="d-flex justify-content-between align-items-center bg-white p-3 rounded-3 shadow-sm">
                                        <span class="text-muted">রেট ক্যালকুলেশন</span>
                                        <span class="fw-bold text-success">স্কয়ার ফিট / চুক্তি</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center bg-white p-3 rounded-3 shadow-sm">
                                        <span class="text-muted">সাইট ভিজিট</span>
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">বিনামূল্যে</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center bg-white p-3 rounded-3 shadow-sm">
                                        <span class="text-muted">ডিজাইন কনসালটেন্সি</span>
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">অন্তর্ভুক্ত</span>
                                    </div>
                                </div>

                                <div class="mt-4 pt-3 border-top text-center">
                                    <p class="small text-muted mb-2">সরাসরি কথা বলুন</p>
                                    <a href="tel:01886950681" class="h4 fw-bold text-dark text-decoration-none">
                                        <i class="fas fa-phone-alt text-success me-2"></i>01886-950681
                                    </a>
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
        <div class="row justify-content-center mb-5 animate-up">
            <div class="col-lg-8 text-center">
                 <span class="text-uppercase tracking-wider fw-bold text-success mb-2 d-block">প্রফেশনাল কেয়ার</span>
                <h2 class="display-5 fw-bold text-dark mb-3">
                    আমাদের সেবার <span class="gradient-text">বৈশিষ্ট্য</span>
                </h2>
                <p class="text-muted fs-5">
                    প্রতিটি কাজেই আমরা বজায় রাখি সর্বোচ্চ মান
                </p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4 animate-up delay-100">
                <div class="price-card h-100 hover-lift text-center">
                    <div class="icon-container bg-primary bg-opacity-10 text-primary mb-4">
                        <i class="fas fa-cut"></i>
                    </div>
                    <h3 class="h5 fw-bold text-dark mb-3">প্রুনিং ও ছাঁটাই</h3>
                    <p class="text-muted">গাছের সঠিক বৃদ্ধি ও সৌন্দর্য বর্ধনের জন্য বৈজ্ঞানিক পদ্ধতিতে ডালপালা ছাঁটাই।</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 animate-up delay-200">
                <div class="price-card h-100 hover-lift text-center">
                    <div class="icon-container bg-warning bg-opacity-10 text-warning mb-4">
                        <i class="fas fa-broom"></i>
                    </div>
                    <h3 class="h5 fw-bold text-dark mb-3">আগাছা দমন</h3>
                    <p class="text-muted">বাগানকে রোগমুক্ত ও পরিচ্ছন্ন রাখতে নিয়মিত আগাছা ও জঞ্জাল পরিষ্কার করা।</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 animate-up delay-300">
                <div class="price-card h-100 hover-lift text-center">
                    <div class="icon-container bg-info bg-opacity-10 text-info mb-4">
                        <i class="fas fa-tint"></i>
                    </div>
                    <h3 class="h5 fw-bold text-dark mb-3">সুষম সার ও সেচ</h3>
                    <p class="text-muted">গাছের পুষ্টি নিশ্চিতে সঠিক মাত্রায় জৈব/রাসায়নিক সার ও পানি প্রয়োগ।</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 animate-up delay-100">
                <div class="price-card h-100 hover-lift text-center">
                    <div class="icon-container bg-danger bg-opacity-10 text-danger mb-4">
                        <i class="fas fa-shield-virus"></i>
                    </div>
                    <h3 class="h5 fw-bold text-dark mb-3">রোগ ও পোকা দমন</h3>
                    <p class="text-muted">আক্রান্ত গাছ সনাক্তকরণ এবং প্রয়োজনীয় বালাইনাশক বা মেডিসিন প্রয়োগ।</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 animate-up delay-200">
                <div class="price-card h-100 hover-lift text-center">
                    <div class="icon-container bg-success bg-opacity-10 text-success mb-4">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="h5 fw-bold text-dark mb-3">রিফ্রেশ ও ক্লিনআপ</h3>
                    <p class="text-muted">পুরানো ও অযত্নে থাকা বাগানকে নতুনের মতো সজীব ও প্রাণবন্ত করে তোলা।</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 animate-up delay-300">
                <div class="price-card h-100 hover-lift text-center">
                    <div class="icon-container bg-dark bg-opacity-10 text-dark mb-4">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3 class="h5 fw-bold text-dark mb-3">নিজস্ব সরঞ্জাম</h3>
                    <p class="text-muted">কাজের জন্য প্রয়োজনীয় সব আধুনিক যন্ত্রপাতি ও টুলস আমরাই বহন করি।</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Useful Info & Contact -->
<section class="section-padding pt-0">
    <div class="container animate-up">

         <div class="alert alert-warning border-0 shadow-sm rounded-4 p-4 mb-5 d-flex align-items-center" role="alert">
            <i class="fas fa-info-circle fa-2x me-3 text-warning"></i>
            <div>
                 <h4 class="alert-heading fw-bold fs-6 mb-1 text-dark">গুরুত্বপূর্ণ নোট:</h4>
                 <p class="mb-0 text-muted">আমরা সেবা ও সরঞ্জাম প্রদান করি। তবে সার, মাটি, টব বা গাছের চারা ক্রয়ের খরচ গ্রাহককে বহন করতে হবে।</p>
            </div>
        </div>

        <div class="bg-dark rounded-5 p-5 text-center text-white position-relative overflow-hidden">
             <!-- Abstract Background -->
             <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at 10% 20%, #10b981 0%, transparent 20%), radial-gradient(circle at 90% 80%, #047857 0%, transparent 20%); opacity: 0.3;"></div>

            <div class="position-relative z-1">
                <h2 class="display-5 fw-bold mb-4">আপনার বাগান সাজাতে প্রস্তুত?</h2>
                <p class="lead mb-5 opacity-75">আমাদের সাথে যোগাযোগ করুন এবং আপনার শখের বাগানের যত্ন নিশ্চিত করুন।</p>

                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                    <a href="tel:01886950681" class="btn btn-light btn-lg px-5 py-3 fw-bold text-success shadow-lg">
                        <i class="fas fa-phone-alt me-2"></i>কল করুন
                    </a>
                    <a href="https://wa.me/8801886950681" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold">
                        <i class="fab fa-whatsapp me-2"></i>হোয়াটসঅ্যাপ
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<a href="https://wa.me/8801886950681" class="whatsapp-float shadow-lg" aria-label="WhatsApp">
    <i class="fab fa-whatsapp fs-2"></i>
</a>

<button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="scroll-top shadow-lg" aria-label="Scroll to top">
    <i class="fas fa-arrow-up"></i>
</button>

@endsection

@push('scripts')
<!-- Booking Modal -->
<div class="modal fade" id="packageBookingModal" tabindex="-1" aria-labelledby="packageBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 bg-success text-white rounded-top-4">
                <h5 class="modal-title fw-bold" id="packageBookingModalLabel">প্যাকেজ বুকিং</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="bookingForm">
                    @csrf
                    <input type="hidden" name="package_name" id="booking_package_name">

                    <div class="mb-3">
                        <label for="booking_name" class="form-label fw-bold">আপনার নাম</label>
                        <input type="text" class="form-control rounded-3" id="booking_name" name="name" placeholder="আপনার পুরো নাম লিখুন" required>
                    </div>

                    <div class="mb-3">
                        <label for="booking_phone" class="form-label fw-bold">মোবাইল নম্বর</label>
                        <input type="tel" class="form-control rounded-3" id="booking_phone" name="phone" placeholder="আপনার মোবাইল নম্বর" required>
                    </div>

                    <div class="mb-3">
                        <label for="booking_address" class="form-label fw-bold">ঠিকানা</label>
                        <textarea class="form-control rounded-3" id="booking_address" name="address" rows="2" placeholder="আপনার ঠিকানা" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="booking_message" class="form-label fw-bold">মেসেজ (ঐচ্ছিক)</label>
                        <textarea class="form-control rounded-3" id="booking_message" name="message" rows="2" placeholder="অন্য কোনো তথ্য থাকলে লিখুন"></textarea>
                    </div>

                    <div id="bookingResponse" class="mb-3"></div>

                    <button type="submit" class="btn btn-success w-100 py-2 fw-bold rounded-3 shadow-sm" id="btnBookSubmit">
                        বুকিং কনফার্ম করুন
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openBookingModal(packageName) {
        document.getElementById('booking_package_name').value = packageName;
        var myModal = new bootstrap.Modal(document.getElementById('packageBookingModal'));
        bookingResponse.innerHTML = '';
        bookingForm.reset();
        document.getElementById('booking_package_name').value = packageName;
        myModal.show();
    }

    $(document).ready(function() {
        $('#bookingForm').on('submit', function(e) {
            e.preventDefault();

            var submitBtn = $('#btnBookSubmit');
            var originalBtnText = submitBtn.html();

            submitBtn.html('<span class="spinner-border spinner-border-sm me-2"></span>অপেক্ষা করুন...');
            submitBtn.prop('disabled', true);

            $.ajax({
                url: "{{ route('frontend.package.book') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if(response.msgType == 'success') {
                        $('#bookingResponse').html('<div class="alert alert-success border-0 bg-success bg-opacity-10 text-success">' + response.msg + '</div>');
                        $('#bookingForm')[0].reset();
                        setTimeout(function() {
                            var myModalEl = document.getElementById('packageBookingModal');
                            var modal = bootstrap.Modal.getInstance(myModalEl);
                            modal.hide();
                            $('#bookingResponse').html('');
                        }, 3000);
                    } else {
                        $('#bookingResponse').html('<div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger">' + response.msg + '</div>');
                    }
                },
                error: function(xhr) {
                    $('#bookingResponse').html('<div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger">Something went wrong! Please try again.</div>');
                },
                complete: function() {
                    submitBtn.html(originalBtnText);
                    submitBtn.prop('disabled', false);
                }
            });
        });
    });
</script>
@endpush