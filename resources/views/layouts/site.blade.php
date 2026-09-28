<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0c2b22">
    <meta name="description" content="เปิดตำนานและประวัติศาสตร์ ณ วัดหมื่นสาร – ชุมชนวัวลาย สำรวจเรื่องเล่า ความทรงจำ และสถานที่สำคัญของชุมชน">
    <title>@yield('title', 'เปิดตำนานและประวัติศาสตร์ ณ วัดหมื่นสาร – ชุมชนวัวลาย')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;500;600&family=Noto+Serif+Thai:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>{!! str_replace('/images/', asset('images').'/', file_get_contents(resource_path('css/home.css'))) !!}</style>
    @stack('styles')
</head>
<body class="@yield('body-class')">
    <a class="skip-link" href="#main">ข้ามไปเนื้อหา</a>
    <header class="site-header">
        <div class="nav-container">
            <a class="brand" href="{{ route('home') }}" aria-label="วัดหมื่นสาร – หน้าแรก">
                <x-temple class="brand-icon" />
                <span><strong>เปิดตำนานและประวัติศาสตร์</strong><small>ณ วัดหมื่นสาร - ชุมชนวัวลาย</small></span>
            </a>
            <button class="menu-toggle" type="button" aria-controls="main-navigation" aria-expanded="false" aria-label="เปิดเมนู"><span></span><span></span><span></span></button>
            <nav id="main-navigation" class="main-navigation" aria-label="เมนูหลัก">
                @foreach (['home' => 'หน้าแรก', 'tiger-legend' => 'ตำนานเสือเย็น', 'history' => 'ประวัติวัดและชุมชน', 'places' => 'สถานที่สำคัญ'] as $name => $label)
                    <a href="{{ route($name) }}" @if(request()->routeIs($name)) aria-current="page" @endif>{{ $label }}</a>
                @endforeach
            </nav>
            @yield('nav-search')
        </div>
    </header>
    <main id="main">@yield('content')</main>
    <script>{!! file_get_contents(resource_path('js/home.js')) !!}</script>
    @stack('scripts')
</body>
</html>
