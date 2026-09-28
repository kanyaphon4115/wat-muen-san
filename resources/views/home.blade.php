@extends('layouts.site')
@section('content')
    @php
        $cards = [
            ['number' => '01', 'route' => 'tiger-legend', 'class' => 'tiger', 'image' => 'tiger-card.jpg', 'title' => 'ตำนานเสือเย็น', 'description' => ['พาผู้ชมย้อนเข้าสู่เรื่องเล่าปรัมปรา', 'และความเชื่อของชุมชน'], 'button' => 'สำรวจเรื่องเล่า'],
            ['number' => '02', 'route' => 'history', 'class' => 'history', 'image' => 'history-card.jpg', 'title' => 'ประวัติวัดและชุมชน', 'description' => ['สำรวจประวัติศาสตร์ของวัดหมื่นสาร', 'ชุมชนวัวลาย และความเปลี่ยนแปลงของพื้นที่'], 'button' => 'เริ่มสำรวจ'],
            ['number' => '03', 'route' => 'places', 'class' => 'places', 'image' => 'map-card.jpg', 'title' => 'สถานที่สำคัญ', 'description' => ['เปิดแผนที่ Interactive Map', 'เพื่อสำรวจสถานที่สำคัญรอบวัดและชุมชน'], 'button' => 'เปิดแผนที่'],
        ];
    @endphp
    <section class="hero" aria-labelledby="hero-title">
        <div class="hero-inner"><div class="hero-copy">
            <div class="hero-heading">
                <h1 id="hero-title"><span>เปิดตำนาน</span><span>และประวัติศาสตร์</span></h1>
                <p class="hero-subtitle">ณ วัดหมื่นสาร - ชุมชนวัวลาย</p>
                <div class="ornament-divider" aria-hidden="true"><span>❖</span></div>
            </div>
            <blockquote>“ เรื่องเล่าเสือเย็นที่เราได้ยินนั้น<br>มีอะไรซ่อนอยู่ในสถานที่และความทรงจำของชุมชน? ”</blockquote>
            <p class="hero-description">เมื่อเอ่ยถึงชุมชนวัวลาย จังหวัดเชียงใหม่ ภาพจำของใครหลายคนย่อมเป็น<br class="desktop-break">
                ย่านหัตถกรรมเครื่องเงินอันเลื่องชื่อ แต่ในความเป็นจริง พื้นที่แห่งนี้ซ่อนเรื่องราว<br class="desktop-break">
                หลากมิติที่ทับซ้อนกันอยู่ ทั้งประวัติศาสตร์ล้านนา ความศรัทธาต่อพระเกจิผู้ยิ่งใหญ่<br class="desktop-break">
                เรื่องเล่าสงครามโลกครั้งที่ 2 ไปจนถึงตำนานลี้ลับในวรรณชาติ โดยมี<br class="desktop-break">
                “วัดหมื่นสาร” เป็นศูนย์กลางที่ร้อยเรียงความทรงจำเหล่านั้นเข้าด้วยกัน</p>
            <div class="hero-action"><a class="ornate-button primary-button" href="#explore">เริ่มสำรวจ <span aria-hidden="true">⟶</span></a><span class="action-flower" aria-hidden="true">❖</span></div>
        </div></div>
    </section>
    <section id="explore" class="explore" aria-labelledby="explore-title">
        <div class="landscape" aria-hidden="true"></div>
        <x-temple class="background-temple temple-left" /><x-temple class="background-temple temple-right" />
        <div class="explore-container">
            <div class="section-heading">
                <h2 id="explore-title"><x-temple class="heading-icon" />สำรวจเรื่องราว <span class="heading-flower" aria-hidden="true">❖</span></h2>
                <p>เลือกหัวข้อที่คุณสนใจ เพื่อเปิดโลกแห่งเรื่องเล่าของวัดหมื่นสาร - ชุมชนวัวลาย</p>
            </div>
            <div class="story-grid">
                @foreach($cards as $card)
                    <article class="story-card {{ $card['class'] }}" @if(is_file(public_path('images/'.$card['image']))) style="--card-image: url('{{ asset('images/'.$card['image']) }}')" @endif>
                        <span class="number-badge" aria-hidden="true"><span>{{ $card['number'] }}</span></span>
                        <h3>{{ $card['title'] }}</h3>
                        <p>{{ $card['description'][0] }}<br>{{ $card['description'][1] }}</p>
                        <a class="ornate-button card-button" href="{{ route($card['route']) }}" aria-label="{{ $card['button'] }}: {{ $card['title'] }}">{{ $card['button'] }} <span aria-hidden="true">⟶</span></a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
