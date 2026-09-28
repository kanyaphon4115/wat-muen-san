@extends('layouts.site')
@section('title', 'ประวัติวัดหมื่นสาร — จากอารามเก่าสู่ศูนย์กลางชุมชน')
@section('body-class', 'history-page')
@push('styles')
    <style>{!! str_replace('/images/', asset('images').'/', file_get_contents(resource_path('css/history.css'))) !!}</style>
@endpush
@section('nav-search')
    <form class="history-search" role="search" aria-label="ค้นหาประวัติในหน้านี้">
        <button type="submit" aria-label="ค้นหา"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="10" cy="10" r="6"/><path d="m15 15 6 6"/></svg></button>
        <input id="history-query" type="search" aria-label="คำค้นหา" placeholder="ค้นหาข้อมูล..." autocomplete="off" required>
        <div class="history-search-results" hidden><p role="status"></p><ul></ul><button class="history-search-close" type="button">ปิดผลการค้นหา</button></div>
    </form>
@endsection
@section('content')
    @php
        $chapters = ['07' => 'จุดเริ่มต้นของวัดหมื่นสาร', '08' => 'การก่อเกิดของชุมชน', '09' => 'คลังความรู้ใบลาน', '10' => 'สูปวิสุทธิราษฎร์วิชัย', '11' => 'สงครามโลกครั้งที่ 2', '12' => 'โรงพยาบาลทหารญี่ปุ่น', '13' => 'พิพิธภัณฑ์ทหารญี่ปุ่น', '14' => 'เครื่องเงินวัวลาย'];
    @endphp
    <section class="history-hero" aria-labelledby="history-title">
        <div class="history-hero-old" aria-hidden="true" style="background-image: url('{{ asset('images/รูป1.png') }}')"></div>
        <div class="history-hero-temple" aria-hidden="true" style="background-image: url('{{ asset(is_file(public_path('images/history/history-hero-temple.jpg')) ? 'images/history/history-hero-temple.jpg' : 'images/wat-muen-san-hero.png') }}')"></div>
        <div class="history-hero-copy">
            <h1 id="history-title">ประวัติวัดหมื่นสาร</h1>
            <p class="history-subtitle">จากอารามเก่าสู่ศูนย์กลางชุมชน</p>
            <div class="history-gold-divider" aria-hidden="true">⋄<span></span>⋄</div>
            <p class="history-intro">เรื่องราวของวัดหมื่นสารและชุมชนวัวลาย ที่สะท้อนความเปลี่ยนแปลงของเชียงใหม่<br class="history-desktop-break">ตั้งแต่อดีตจนถึงปัจจุบัน ผ่านศาสนา ผู้คน สงคราม และภูมิปัญญาท้องถิ่น</p>
        </div>
    </section>
    <div class="history-main-grid">
        <aside class="history-sidebar">
            <nav aria-label="หัวข้อประวัติศาสตร์" class="history-chapter-nav">
                @foreach($chapters as $number => $label)
                    <a href="#history-{{ $number }}" @if($loop->first) aria-current="location" @endif><span class="chapter-marker" aria-hidden="true"></span><span class="chapter-number">{{ $number }}</span>{{ $label }}</a>
                @endforeach
            </nav>
            <x-temple class="history-sidebar-temple" />
        </aside>
        <div class="history-paper">
            <div class="history-top-row">
                <section id="history-07" class="history-origin" data-history-section aria-labelledby="history-heading-07">
                    <div class="history-origin-heading"><x-history-badge number="07" /><div><h2 id="history-heading-07">จุดเริ่มต้นของวัดหมื่นสาร</h2>
                        <p>วัดหมื่นสาร เป็นวัดเก่าแก่ที่มีความเป็นมายาวนานตั้งแต่สมัยราชวงศ์มังราย</p>
                        <p>สันนิษฐานว่าสร้างขึ้นในรัชสมัยของ พญาสามฝั่งแกน กษัตริย์องค์ที่ 8 แห่งราชวงศ์มังราย</p>
                        <p>ในช่วงแรก วัดหมื่นสารนับถือพระพุทธศาสนานิกายลังกาวงศ์ และมีความสัมพันธ์อันดีกับวัดสวนดอก</p>
                    </div></div>
                    <ol class="history-era-timeline">
                        <li><x-history-art file="history-1981.jpg" alt="ภาพประกอบสมัยพญาสามฝั่งแกน" /><div><h3>พ.ศ. 1981</h3><h4>สมัยพญาสามฝั่งแกน</h4><p>สันนิษฐานว่าสร้างวัดหมื่นสารในรัชสมัยของพญาสามฝั่งแกน กษัตริย์องค์ที่ 8 แห่งราชวงศ์มังราย</p></div></li>
                        <li><x-history-art file="history-tilokaraj.jpg" alt="ภาพประกอบสมัยพระเจ้าติโลกราช" /><div><h3>สมัยพระเจ้าติโลกราช</h3><p>มีบันทึกในตำนานมูลศาสนาว่า ได้มีการสร้างวิหารขึ้น พร้อมอัญเชิญ “พระศิลาเจ้า” จากวัดป่าแดง มาประดิษฐานเพื่อความเจริญรุ่งเรือง</p></div></li>
                        <li><x-history-art file="history-2031.jpg" alt="ภาพประกอบสมัยพญายอดเชียงเมือง" /><div><h3>พ.ศ. 2031</h3><h4>สมัยพญายอดเชียงเมือง</h4><p>นิมนต์พระมหาพุทธญาณเถรฯ มาดำรงตำแหน่งเจ้าอาวาส</p></div></li>
                        <li><x-history-art file="history-2065.jpg" alt="เอกสารประวัติศาสตร์สมัยพระเมืองแก้ว" /><div><h3>พ.ศ. 2065</h3><h4>สมัยพระเมืองแก้ว</h4><p>มีหลักฐานกล่าวถึงการสร้างวิหารขึ้นเป็นครั้งแรก</p></div></li>
                    </ol>
                </section>
                <aside class="history-learning" aria-labelledby="learning-title">
                    <h2 id="learning-title"><svg viewBox="0 0 40 36" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 32C13 27 6 28 2 29V4c6-2 12-1 18 3 6-4 12-5 18-3v25c-4-1-11-2-18 3Zm0 0V7M6 6v19c5-1 9 0 11 2"/></svg>วัดหมื่นสารในฐานะแหล่งเรียนรู้</h2>
                    <div class="history-gold-divider" aria-hidden="true"><span></span>❖</div>
                    <ul><li>แหล่งเรียนรู้อักษรล้านนา</li><li>ศูนย์กลางการแปลราชสาส์นจากต่างเมือง</li><li>แหล่งเก็บรักษาความรู้และเอกสารของชุมชน</li></ul>
                    <p>สะท้อนถึงบทบาทของวัดต่อการศึกษาและ<br>วิถีชีวิตของคนเชียงใหม่มาตั้งแต่อดีต</p>
                </aside>
            </div>
            <div class="history-card-row">
                <section id="history-08" class="history-card history-community" data-history-section aria-labelledby="history-heading-08">
                    <header><x-history-badge number="08" /><h2 id="history-heading-08">การก่อเกิดของชุมชนหมื่นสารและบ้านวัวลาย</h2></header>
                    <div class="community-eras">
                        <article><x-history-art file="history-community-chedi.jpg" alt="เจดีย์เก่า" /><div><h3>พ.ศ. 2101 – 2317</h3><h4>ยุคพม่าปกครอง</h4><p>แม้หลักฐานในยุคนี้จะค่อนข้างน้อย แต่พบร่องรอยศิลปะพม่าปรากฏบนเจดีย์ของวัด จึงเชื่อได้ว่าวัดยังคงได้รับการบำรุงรักษาอย่างต่อเนื่อง</p></div></article>
                        <article><img class="history-art" src="{{ asset('images/ยุคฟื้นฟูบ้านเมือง.jpg') }}" alt="ยุคฟื้นฟูบ้านเมือง พ.ศ. 2342" loading="lazy" decoding="async"><div><h3>พ.ศ. 2342</h3><h4>ยุคฟื้นฟูบ้านเมือง</h4><p>ในสมัยรัตนโกสินทร์ มีการกวาดต้อนผู้คนที่มีฝีมือเครื่องเงินจากหมู่บ้านคง พื้นที่ลุ่มน้ำสาละวิน ให้มาตั้งถิ่นฐานรอบวัดหมื่นสาร จึงเกิดเป็นชุมชน “บ้านวัวลาย” หรือ “บ้านงัวลาย” และทำให้วัดหมื่นสารกลายเป็นศูนย์กลางของชุมชน</p></div></article>
                    </div>
                </section>
                <section id="history-09" class="history-card history-manuscripts" data-history-section aria-labelledby="history-heading-09">
                    <header><x-history-badge number="09" /><h2 id="history-heading-09">คลังความรู้ใบลาน</h2></header>
                    <div class="history-card-body"><x-history-art file="history-palm-leaf.jpg" alt="คัมภีร์ใบลานเก่าแก่" /><div><h3>พ.ศ. 2520</h3><p>สถาบันวิจัยสังคม มหาวิทยาลัยเชียงใหม่ สำรวจพบคัมภีร์ใบลานเก่าแก่ของวัดถึง</p><div class="manuscript-stats"><div><strong>163</strong><span>รายการ</span></div><div><strong>815</strong><span>ผูก</span></div></div><p>โดยมีเอกสารบางชิ้นระบุปี จ.ศ. 1187 หรือ พ.ศ. 2368 มีอายุกว่า 200 ปี สิ่งเหล่านี้ช่วยยืนยันบทบาทของวัดหมื่นสารในฐานะแหล่งเก็บรักษาประวัติศาสตร์และความรู้ของชุมชน</p></div></div>
                </section>
                <section id="history-10" class="history-card history-stupa" data-history-section aria-labelledby="history-heading-10">
                    <header><x-history-badge number="10" /><h2 id="history-heading-10">สูปวิสุทธิราษฎร์วิชัย</h2></header>
                    <div class="history-card-body"><x-history-art file="history-stupa.jpg" alt="สถูปสีขาวภายในวัด" /><div><p>วัดหมื่นสารมีความเกี่ยวพันกับ <strong>ครูบาศรีวิชัย คนบุญแห่งล้านนา</strong> หลังจากท่านมรณภาพในปี พ.ศ. 2481 อัฐิธาตุของท่านได้ถูกแบ่งออกเป็น 7 ส่วน สำหรับวัดหมื่นสาร มีการสร้างสถูปบรรจุอัฐิครูบาศรีวิชัย และทำพิธีบรรจุอย่างเป็นทางการเมื่อวันที่ <strong>28 พฤษภาคม พ.ศ. 2496</strong> กลายเป็นสิ่งศักดิ์สิทธิ์คู่ชุมชนมาจนถึงปัจจุบัน</p></div></div>
                </section>
            </div>
        </div>
    </div>
    <div class="history-dark-band">
        <section id="history-11" class="history-dark-story" data-history-section aria-labelledby="history-heading-11"><header><x-history-badge number="11" /><h2 id="history-heading-11">หน้าประวัติศาสตร์สงครามโลกครั้งที่ 2</h2></header><div class="dark-story-body"><x-history-art file="history-japanese-field-hospital.jpg" alt="ภาพเก่าโรงพยาบาลสนามทหารญี่ปุ่น" /><div><h3>โรงพยาบาลสนามทหารญี่ปุ่น</h3><p>ในช่วงปลายสงครามโลกครั้งที่ 2 พ.ศ. 2482–2488 วัดหมื่นสารได้กลายเป็นพื้นที่สำคัญ เมื่อกองทัพญี่ปุ่นเข้ายึดพื้นที่วัดเพื่อใช้เป็น <strong>สถานพยาบาลสนามและโรงเก็บศพ</strong></p></div></div></section>
        <section id="history-12" class="history-dark-story history-hospital" data-history-section aria-labelledby="history-heading-12"><header><x-history-badge number="12" /><h2 id="history-heading-12">โรงพยาบาลทหารญี่ปุ่น และเส้นทางสายสุดท้าย</h2></header><div class="dark-story-body"><x-history-art file="history-japanese-hospital.jpg" alt="อาคารโรงพยาบาลทหารญี่ปุ่นในอดีต" /><div><h3>การเป็นที่ตั้งของ “โรงพยาบาลทหารญี่ปุ่น”</h3><p>จากไม้ไผ่มุงใบตองตึง ภายในมีแคร่ไม้ไผ่สำหรับทหารที่บาดเจ็บและป่วย พร้อมหมอและพยาบาลทหารประมาณ 20–30 คน เมื่อมีทหารเสียชีวิต ศพจะถูกนำใส่เปลไว้ที่โรงเก็บศพ ก่อนหามด้วยรถเข็นไม้ไผ่สองล้อ ไปยังสุสานช้างคลาน</p></div></div></section>
        <aside class="history-route" aria-label="เส้นทางสายสุดท้าย"><h3>เส้นทาง</h3><ol><li>ถนนวัวลาย</li><li>ถนนราชเชียงแสน</li><li>ถนนระแกง</li><li>สามแยกหล่าย</li><li>สถานที่ฌาปนกิจ</li></ol></aside>
        <section id="history-13" class="history-dark-story" data-history-section aria-labelledby="history-heading-13"><header><x-history-badge number="13" /><h2 id="history-heading-13">อนุสรณ์สถานและพิพิธภัณฑ์ทหารญี่ปุ่น</h2></header><div class="dark-story-body"><x-history-art file="history-japanese-museum.jpg" alt="อนุสรณ์สถานและพิพิธภัณฑ์ทหารญี่ปุ่น" /><div><p>หลังสงครามสิ้นสุดลง ทายาทของทหารญี่ปุ่นได้เดินทางมาเคารพดวงวิญญาณของบิดา จึงเกิดการจัดทำรูปปั้นวิญญาณ และมีสถานที่เก็บคำจารึกให้เป็นพิพิธภัณฑ์ทหารญี่ปุ่นช่วงสงครามโลกครั้งที่ 2 จัดแสดงสิ่งของเครื่องใช้ อาหาร และจดหมายเหตุในยุคสงคราม</p></div></div></section>
        <section id="history-14" class="history-dark-story" data-history-section aria-labelledby="history-heading-14"><header><x-history-badge number="14" /><h2 id="history-heading-14">เครื่องเงินวัวลาย – ภูมิปัญญาที่ไม่มีวันตาย</h2></header><div class="dark-story-body"><x-history-art file="history-silverware.jpg" alt="มือช่างกำลังทำเครื่องเงินวัวลาย" /><div><p>หากเดินออกจากวัดหมื่นสารเข้าสู่ชุมชนวัวลาย จะพบว่างานเครื่องเงินคือวิถีชีวิตและภูมิปัญญาของคนในชุมชนหมื่นสาร – วัวลาย</p><h3>เส้นทางท่องเที่ยวเชิงวิถีชีวิต</h3><p>ถนนวัวลาย ซอย 1, 3 และ 4 พบร้านและบ้านของช่างเครื่องเงิน เช่น สล่าเครื่องเงินแม่บัว, สุภาพ, นิลศิลป์, อ้ายพร, อ้ายจันทร์, คุณเล็ก กลายเป็นพื้นที่เรียนรู้เกี่ยวกับศิลปะหัตถกรรม</p></div></div></section>
    </div>
@endsection
@push('scripts')
    <script>{!! file_get_contents(resource_path('js/history.js')) !!}</script>
@endpush
