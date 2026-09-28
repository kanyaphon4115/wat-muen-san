@extends('layouts.site')
@section('title', 'แผนที่วัฒนธรรมชุมชนหมื่นสาร | สถานที่สำคัญ')
@section('body-class', 'places-page')
@push('styles')
<style>{!! str_replace('/images/', asset('images').'/', file_get_contents(resource_path('css/places.css'))) !!}</style>
@endpush
@section('nav-search')
<button class="places-search-button" type="button" aria-label="ค้นหาสถานที่" aria-controls="places-search-dialog"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="10" cy="10" r="6"/><path d="m15 15 6 6"/></svg></button>
@endsection
@section('content')
@php
    $image = function ($file, $fallback = 'wat-muen-san-hero.png', $alt = 'ภาพประกอบบริเวณวัดหมื่นสาร') {
        $exists = is_file(public_path('images/places/'.$file));
        return ['src' => asset('images/'.($exists ? 'places/'.$file : $fallback)), 'alt' => $exists ? $alt : 'ภาพประกอบบริเวณวัดและชุมชน'];
    };
    $temple = $image('wat-muen-san.png');
    $templeThumb = $image('h2-temple.jpg');
    $statue = $image('h2-tiger-statue.jpg', 'tiger-legend/tiger-statue.png', 'รูปปั้นเสือคาบคน');
    $viharn = $image('h2-viharn.jpg');
    $places = [
        'H1' => ['title' => 'รูปปั้นวัวลาย', 'subtitle' => '', 'image' => ['src' => asset('images/วัวลาย.jpg'), 'alt' => 'รูปปั้นวัวลาย'], 'description' => 'จุดแลนด์มาร์กที่สะท้อนสัญลักษณ์และความสัมพันธ์ของพื้นที่กับชุมชนวัวลาย', 'cta' => 'อ่านประวัติชุมชน', 'url' => route('history').'#history-08'],
        'H2' => ['title' => 'เจดีย์วัดหมื่นสาร', 'subtitle' => '', 'image' => ['src' => asset('images/วัดหมื่น.PNG'), 'alt' => 'เจดีย์วัดหมื่นสาร'], 'description' => 'จุดสำคัญของตำนานเสือเย็น และเป็นบริเวณที่พบรูปปั้น “เสือคาบคน” ซึ่งยังคงปรากฏอยู่ในปัจจุบัน และสะท้อนความเชื่อของชุมชนที่ผูกพันกับเรื่องเล่าลี้ลับมายาวนาน', 'cta' => 'อ่านตำนานเสือเย็น', 'url' => route('tiger-legend')],
        'H3' => ['title' => 'พิพิธภัณฑ์ญี่ปุ่น', 'subtitle' => 'อนุสรณ์สถานทหารญี่ปุ่น', 'image' => ['src' => asset('images/ญี่ปุ่น.PNG'), 'alt' => 'พิพิธภัณฑ์ญี่ปุ่น อนุสรณ์สถานทหารญี่ปุ่น'], 'description' => 'พื้นที่เรียนรู้เรื่องราวของวัดหมื่นสารในช่วงสงครามโลกครั้งที่ 2 และความสัมพันธ์ของพื้นที่กับกองทัพญี่ปุ่น', 'cta' => 'อ่านประวัติพิพิธภัณฑ์', 'url' => route('history').'#history-13'],
        'H4' => ['title' => 'หอศิลป์สุทธิรจิตโต', 'subtitle' => '', 'image' => ['src' => asset('images/หอศิลป์.PNG'), 'alt' => 'หอศิลป์สุทธิรจิตโต'], 'description' => 'พื้นที่จัดแสดงงานศิลปะและเรื่องราวทางวัฒนธรรมที่เชื่อมโยงวัดกับชุมชนและงานสร้างสรรค์', 'cta' => 'อ่านประวัติวัดและชุมชน', 'url' => route('history')],
        'H5' => ['title' => 'ศาสตร์เครื่องเงิน', 'subtitle' => '', 'image' => ['src' => asset('images/ศาลา.PNG'), 'alt' => 'ศาสตร์เครื่องเงิน'], 'description' => 'เรียนรู้ภูมิปัญญางานเครื่องเงินของชุมชนวัวลาย หนึ่งในมรดกหัตถกรรมสำคัญของเชียงใหม่', 'cta' => 'อ่านเรื่องเครื่องเงินวัวลาย', 'url' => route('history').'#history-14'],
    ];
    foreach ($places as $id => &$place) {
        $place['thumbnails'] = $id === 'H2' ? [$templeThumb, $statue, $viharn] : [$place['image'], $templeThumb, $viharn];
    }
    unset($place);
    $selected = $places['H2'];
    $sunset = $image('wat-muen-san-sunset.jpg');
    $tiktok = config('places.tiktok_url');
    $tiktok = is_string($tiktok) && filter_var($tiktok, FILTER_VALIDATE_URL) && parse_url($tiktok, PHP_URL_SCHEME) === 'https' ? $tiktok : null;
@endphp
<section class="cultural-map" id="cultural-map" aria-labelledby="map-title">
    <div class="map-canvas">
        <div class="map-heading"><h1 id="map-title">แผนที่วัฒนธรรม<span>ชุมชนหมื่นสาร</span></h1><p>สำรวจสถานที่สำคัญรอบวัดหมื่นสาร<br>และชุมชนวัวลาย คลิกที่แต่ละสถานที่<br>เพื่อดูข้อมูลและภาพประกอบ</p></div>
        <svg class="map-landscape" viewBox="0 0 1045 660" aria-hidden="true"><defs><g id="map-tree"><path d="M0 40V0m0 24-14-14M0 18 14 5" stroke="#a89361" stroke-width="3"/><g fill="#92966d"><circle cx="0" cy="-5" r="17"/><circle cx="-14" cy="4" r="14"/><circle cx="13" cy="1" r="14"/></g></g><g id="map-cloud" fill="none" stroke="#d1aa68"><path d="M0 20h110c10-2 10-10 0-12-1-20-28-24-37-7-4-18-30-20-35-3-12-3-22 6-20 15H0c-7 0-8 7 0 7Z"/><path d="M35 10c10-20 32-9 24 2h25"/></g></defs><g opacity=".27"><path d="M160 594Q200 305 460 178T969 342Q1040 598 777 625T160 594" fill="#d9c8a0"/><path d="M175 610Q170 352 388 202T855 210Q1060 305 978 572" fill="none" stroke="#b8ae86" stroke-width="12"/><use href="#map-cloud" x="800" y="70"/><use href="#map-cloud" x="30" y="280"/><use href="#map-cloud" x="105" y="535"/><use href="#map-tree" x="428" y="193"/><use href="#map-tree" x="463" y="151"/><use href="#map-tree" x="392" y="231"/><use href="#map-tree" x="352" y="302"/><use href="#map-tree" x="348" y="362"/><use href="#map-tree" x="491" y="365"/><use href="#map-tree" x="738" y="140"/><use href="#map-tree" x="760" y="214"/><use href="#map-tree" x="784" y="347"/><use href="#map-tree" x="947" y="209"/><use href="#map-tree" x="1004" y="424"/><use href="#map-tree" x="957" y="514"/><use href="#map-tree" x="742" y="563"/><use href="#map-tree" x="668" y="603"/><use href="#map-tree" x="549" y="575"/><use href="#map-tree" x="238" y="545"/><use href="#map-tree" x="264" y="447"/><use href="#map-tree" x="715" y="45"/></g></svg>
        <svg class="map-paths" viewBox="0 0 1045 660" aria-hidden="true"><g fill="none" stroke="#c9903e" stroke-width="2.5" stroke-dasharray="2 6" stroke-linecap="round" opacity=".85"><path d="M625 390Q620 235 625 145"/><path d="M625 420Q621 559 424 565"/><path d="M672 360Q820 256 910 294"/><path d="M564 368Q365 280 293 328"/><path d="M687 421Q757 472 832 560"/><path d="M297 306Q355 168 600 124T901 252"/><path d="M297 411Q297 545 404 554"/></g></svg>
        <div class="map-temple"><img src="{{ $temple['src'] }}" alt="{{ $temple['alt'] }}"><span>วัดหมื่นสาร</span></div>
        @foreach($places as $id => $place)
            <button type="button" class="location-card location-{{ strtolower($id) }}" data-place="{{ $id }}" aria-controls="place-detail" aria-pressed="{{ $id === 'H2' ? 'true' : 'false' }}"><img src="{{ $place['image']['src'] }}" alt="{{ $place['image']['alt'] }}"><span class="location-label"><span class="map-pin"><span>{{ $id }}</span></span><span>{{ $place['title'] }}@if($place['subtitle'])<small>{{ $place['subtitle'] }}</small>@endif</span></span></button>
        @endforeach
        <x-temple class="map-temple-line" />
    </div>
    <aside id="place-detail" class="place-detail" aria-labelledby="detail-title" tabindex="-1">
        <header><span class="map-pin detail-pin"><span id="detail-id">H2</span></span><h2 id="detail-title">{{ $selected['title'] }}</h2><button class="detail-close" type="button" aria-label="ปิดข้อมูลสถานที่">×</button></header>
        <p id="detail-subtitle" hidden></p>
        <img id="detail-main-image" class="detail-main-image" src="{{ $selected['image']['src'] }}" alt="{{ $selected['image']['alt'] }}">
        <div class="detail-thumbnails" aria-label="ภาพประกอบสถานที่">@foreach($selected['thumbnails'] as $index => $thumbnail)<button type="button" data-thumbnail="{{ $index }}" aria-label="ดูภาพประกอบที่ {{ $index + 1 }}" aria-pressed="false"><img src="{{ $thumbnail['src'] }}" alt="{{ $thumbnail['alt'] }}"></button>@endforeach</div>
        <p id="detail-description">{{ $selected['description'] }}</p>
        <a id="detail-cta" class="detail-cta" href="{{ $selected['url'] }}"><svg viewBox="0 0 40 36" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M20 31C13 26 6 27 2 28V4c6-2 12-1 18 3 6-4 12-5 18-3v24c-4-1-11-2-18 3Zm0 0V7M6 10l9 2m-9 5 9 2m-9 5 9 2m10-14 9-2m-9 9 9-2m-9 9 9-2"/></svg><span>{{ $selected['cta'] }}</span><span aria-hidden="true">→</span></a>
    </aside>
</section>
<section class="places-closing" aria-labelledby="closing-quote">
    <img class="closing-temple" src="{{ $sunset['src'] }}" alt="{{ $sunset['alt'] }}">
    <div class="closing-copy"><h2 id="closing-quote">“ตำนานเสือเย็นอาจเปลี่ยนไปตามกาลเวลา<br>แต่เรื่องราว ยังคงถูกจดจำและส่งต่อผ่านสถานที่และผู้คนในชุมชน”</h2><div class="closing-divider" aria-hidden="true"><span></span>❖<span></span></div><p>แล้วเรื่องราวที่คุณได้ค้นพบ<br>จะกลายเป็นส่วนหนึ่งของความทรงจำนี้เช่นกัน</p><div class="closing-actions"><button id="restart-map" type="button"><span aria-hidden="true">↻</span>สำรวจเรื่องราวอีกครั้ง</button>
    @if($tiktok)<a class="tiktok-button" href="{{ $tiktok }}" target="_blank" rel="noopener noreferrer">@else<button class="tiktok-button" type="button" aria-disabled="true" title="ยังไม่ได้ระบุลิงก์คลิป TikTok">@endif
    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M14 2h4c0 3 2 5 5 5v4a10 10 0 0 1-5-2v8a7 7 0 1 1-8-7v4a3 3 0 1 0 4 3V2Z"/></svg>รับชมคลิป TikTok <span aria-hidden="true">↗</span>@if($tiktok)</a>@else</button>@endif</div><p id="tiktok-status" role="status" hidden>ยังไม่ได้ระบุลิงก์คลิป TikTok</p></div><x-temple class="closing-temple-line" />
</section>
<section class="project-credits" aria-labelledby="credits-title">
    <div class="project-credits-inner">
        <div class="project-team">
            <h2 id="credits-title">จัดทำโดย</h2>
            <ul class="project-members">
                <li><span>เสาวลักษณ์ โรจน์จุฑารักษ์</span><span>68144575</span></li>
                <li><span>จริยา คำมน</span><span>68144511</span></li>
                <li><span>พิริสา กลจักร์</span><span>68144553</span></li>
                <li><span>ระมิดา ชูเดอะ</span><span>68144683</span></li>
                <li><span>ปฐมาวดี อินทร์ไชย</span><span>68144667</span></li>
                <li><span>สรณ์สิริ คำสุ</span><span>68144637</span></li>
                <li><span>ศุภวิชรญ์ วงศ์ยืด</span><span>68144635</span></li>
            </ul>
            <p class="project-affiliation">นักศึกษาสาขานิเทศศาสตร์ คณะวิทยาการจัดการ<br>มหาวิทยาลัยราชภัฏเชียงใหม่</p>
            <h3>ช่องทางการติดต่อผู้จัดทำ</h3>
            <address class="project-contact">Email:
                <a href="mailto:68144575@g.cmru.ac.th">68144575@g.cmru.ac.th</a>
                <a href="mailto:68144553@g.cmru.ac.th">68144553@g.cmru.ac.th</a>
            </address>
        </div>
        <div class="project-purpose">
            <h2>วัตถุประสงค์ของโครงการ</h2>
            <p>เว็บไซต์นี้จัดทำขึ้นเป็นส่วนหนึ่งของการศึกษาในรายวิชา CA 2302-68 การเล่าเรื่องข้ามสื่อ มีวัตถุประสงค์เพื่อศึกษาและนำเสนอเรื่องราวเกี่ยวกับ “ตำนานเสือเยน วัดหมื่นสาร และชุมชนวัวลาย” ผ่านแนวคิดการเล่าเรื่องข้ามสื่อ (Transmedia Storytelling) โดยนำข้อมูลด้านตำนาน ประวัติศาสตร์ ความเชื่อ และวิถีชีวิตของชุมชนมาพัฒนาและนำเสนอในรูปแบบสื่อดิจิทัล เพื่อให้ผู้ชมสามารถเรียนรู้และสำรวจเรื่องราวได้อย่างน่าสนใจ พร้อมทั้งเห็นความเชื่อมโยงระหว่างเรื่องเล่า สถานที่ และความทรงจำของชุมชน</p>
        </div>
    </div>
</section>
<dialog id="places-search-dialog" aria-labelledby="places-search-title"><form id="places-search-form"><h2 id="places-search-title">ค้นหาสถานที่</h2><label for="places-query">ชื่อสถานที่หรือคำค้นหา</label><input id="places-query" type="search" required><button type="submit">ค้นหา</button></form><p id="places-search-status" role="status"></p><ul id="places-search-results"></ul><button id="close-places-search" type="button">ปิด</button></dialog>
@endsection
@push('scripts')
<script>window.culturalPlaces = {{ Illuminate\Support\Js::from($places) }};</script>
<script>{!! file_get_contents(resource_path('js/places.js')) !!}</script>
@endpush
