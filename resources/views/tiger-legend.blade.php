@extends('layouts.site')
@section('title', 'ตำนานเสือเย็น | วัดหมื่นสาร – ชุมชนวัวลาย')
@section('body-class', 'legend-page')
@push('styles')
    <style>{!! str_replace('/images/', asset('images').'/', file_get_contents(resource_path('css/tiger-legend.css'))) !!}</style>
@endpush
@section('nav-search')
    <button class="legend-search-button" type="button" aria-label="ค้นหาในเรื่องเล่า" aria-controls="legend-search"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="10" cy="10" r="6"/><path d="m15 15 6 6"/></svg></button>
@endsection
@section('content')
    @php
        // Use supplied artwork only. Missing files do not generate broken image requests.
        $art = fn ($file) => is_file(public_path('images/tiger-legend/'.$file))
            ? asset('images/tiger-legend/'.$file) : null;
        $nodes = [
            ['ตำนานเสือเย็น', 'hero-tiger.png', 'legend-intro'],
            ['เรื่องเล่าพ่อค้าวัวต่าง', 'scene-2.png', 'night-call'],
            ['ควายธนู', 'kwai-thanu.png', 'belief'],
            ['เสือเย็นถูกปราบ', 'scene-3.png', 'tiger-battle'],
            ['รูปปั้นเสือคาบคน', 'tiger-statue.png', 'present-trace'],
            ['ร่องรอยของเรื่องเล่าในวัดหมื่นสารปัจจุบัน', 'temple-trace.png', 'present-trace'],
        ];
    @endphp
    <section id="legend-intro" class="legend-hero" aria-labelledby="legend-title" @if($art('hero-tiger.png')) style="--legend-art: url('{{ $art('hero-tiger.png') }}')" @endif>
        <div class="legend-hero-inner">
            <div class="legend-introduction">
                <div class="legend-title-group">
                    <h1 id="legend-title"><span>ตำนาน</span><strong>เสือเย็น</strong></h1>
                    <p>เรื่องเล่าที่ซ่อนอยู่ในวัด</p>
                    <div class="legend-divider" aria-hidden="true">❖<span></span>❖</div>
                </div>
                <p class="legend-lead">ตำนานลี้ลับแห่งล้านนา “เสือเย็น” และวิชาอาคม “ควายธนู”</p>
                <p class="legend-intro-copy">นอกจากประวัติศาสตร์จริงแล้ว วัดหมื่นสารยังมีชื่อเสียงในฐานะฉากหลังของ “ตำนานเสือเย็น” หรือเสือสมิงตามความเชื่อล้านนา ซึ่งเรื่องเล่าถูกถ่ายทอดต่อกันมาเป็น 2 สำนวนหลัก</p>
            </div>
            <blockquote class="legend-quote"><span aria-hidden="true">❖────</span>เรื่องเล่าที่<br>กาลเวลาไม่อาจลบเลือน<br>ยังคงซ่อนอยู่ใน<br>วัดหมื่นสาร...<span aria-hidden="true">❖────</span></blockquote>
        </div>
    </section>

    <div class="legend-paper">
        <x-temple class="legend-paper-temple" />
        <div class="legend-stories">
            <section class="legend-part-one" aria-labelledby="part-one-title">
                <header class="legend-section-header"><span class="part-badge">ส่วนที่ 1</span><h2 id="part-one-title">เรื่องเล่าเสือเย็นแห่งอารามร้าง</h2><span class="section-rule" aria-hidden="true">❖</span></header>
                <div class="legend-card-grid">
                    <article id="abbot" class="legend-card">
                        <div class="legend-scene" @if($art('scene-1.png')) style="--scene-art: url('{{ $art('scene-1.png') }}')" @endif><span class="scene-number" aria-hidden="true">1</span></div>
                        <div class="legend-card-copy"><h3>เจ้าอาวาสผู้แก่กล้าวิชาอาคม</h3>
                            <p>เรื่องเล่าโบราณระบุถึงเจ้าอาวาสผู้แก่กล้าวิชาอาคมรูปหนึ่ง แต่เป็นคนไม่ชอบอาบน้ำ นานวันเข้าเณรและเด็กวัดเริ่มหายตัวไปอย่างลึกลับ จนเหลือเจ้าอาวาสอยู่เพียงรูปเดียว</p>
                            <p>เมื่อมี พ่อค้าวัวต่าง แวะมาพักค้างคืน ก็มักจะหายตัวไป ชาวบ้านจึงต่างเตือนภัยให้ระวังเสือ</p>
                        </div>
                    </article>
                    <article id="night-call" class="legend-card">
                        <div class="legend-scene" @if($art('scene-2.png')) style="--scene-art: url('{{ $art('scene-2.png') }}')" @endif><span class="scene-number" aria-hidden="true">2</span></div>
                        <div class="legend-card-copy"><h3>เสียงเรียกในยามค่ำคืน</h3>
                            <p>คืนหนึ่งมีพ่อค้าวัวต่างผู้มีวิชาแวะมาพัก</p>
                            <p>เมื่อตกดึก เขาได้ยินเสียงเรียกปริศนาว่า</p>
                            <p><strong>“พ่อออก ๆ หลับหรือยัง”</strong></p>
                            <p>เขาจึงตอบไปว่ายังไม่หลับ พร้อมกับนั่งจักสานไม้ไผ่ทำเป็น ควายธนู และปลุกเสกเตรียมไว้</p>
                        </div>
                    </article>
                    <article id="tiger-battle" class="legend-card">
                        <div class="legend-scene" @if($art('scene-3.png')) style="--scene-art: url('{{ $art('scene-3.png') }}')" @endif><span class="scene-number" aria-hidden="true">3</span></div>
                        <div class="legend-card-copy"><h3>ควายธนูปะทะเสือเย็น</h3>
                            <p>เมื่อเข้าตาจน พ่อค้าจึงปล่อยควายธนูออกไปต่อสู้กับเสือเย็นอย่างดุเดือด</p>
                            <p>รุ่งเช้า ชาวบ้านจึงพบเสือนอนตายอยู่ พร้อมเศษซากกระดูกมนุษย์ที่อยู่ด้านหลังวิหาร</p>
                        </div>
                    </article>
                </div>
            </section>
            <section id="second-version" class="legend-part-two" aria-labelledby="part-two-title">
                <header class="legend-section-header"><span class="part-badge">ส่วนที่ 2</span><h2 id="part-two-title">พ่อค้าหมูผู้ปราบเสือ</h2></header>
                <div class="second-version-art" aria-hidden="true" @if($art('pig-merchant.png')) style="--scene-art: url('{{ $art('pig-merchant.png') }}')" @endif></div>
                <ol class="version-events">
                    <li>มีการประกาศหาผู้มีอาคมมาปราบเสือร้าย</li>
                    <li>พ่อค้าหมูคนหนึ่ง อาสาและวางอุบายเข้าไปนอนในโบสถ์</li>
                    <li>เมื่อเสือเย็นเวียนมาถามว่า <strong>“หลับหรือยัง”</strong> ถึง 3 ครั้ง</li>
                    <li>ในครั้งสุดท้าย พ่อค้าแกล้งทำเป็นหลับ เมื่อเสือเปิดประตูเข้ามา เขาจึงปล่อย ควายธนูไม้ไผ่ที่ปลุกเสกไว้ เข้าขวิดเสือเย็นจนถึงแก่ความตาย</li>
                </ol>
            </section>
        </div>

        <div class="legend-culture">
            <section id="belief" class="belief-visual" aria-labelledby="belief-title">
                <h2 id="belief-title">ถอดรหัสความเชื่อ<strong>“ควายธนู”</strong><span aria-hidden="true">──❖──</span></h2>
                <div class="buffalo-art" @if($art('kwai-thanu.png')) style="--scene-art: url('{{ $art('kwai-thanu.png') }}')" @endif aria-hidden="true"></div>
            </section>
            <section class="belief-copy" aria-labelledby="culture-title">
                <span class="rice-ornament" aria-hidden="true">❧</span>
                <h2 id="culture-title">ควายธนูสะท้อนวิถีชีวิต</h2>
                <p>ในทางคติชนวิทยา ความเชื่อเรื่องควายธนู ซึ่งสามารถทำจากไม้ไผ่สาน ดินมวลสาร ขี้ผึ้ง หรือโลหะอาถรรพ์ สะท้อนถึงสังคมเกษตรกรรมล้านนาที่ผูกพันกับวัฒนธรรมข้าวและการเลี้ยงวัวควาย</p>
                <p>ควายธนูจึงทำหน้าที่เป็น หุ่นพยนต์ที่ใช้ปกป้องเจ้าของจากสิ่งเหนือธรรมชาติ</p>
            </section>
            <section id="present-trace" class="present-trace" aria-labelledby="trace-title">
                <div><h2 id="trace-title">ร่องรอยที่ยังปรากฏในปัจจุบัน</h2>
                    <p>แม้เรื่องเสือเย็นจะเป็น ประวัติศาสตร์บอกเล่า (Oral History) แต่ชาวบ้านเชื่อกันว่าวัดในตำนานคือวัดหมื่นสาร</p>
                    <p>ในอดีตเคยมีรูปปั้นเสืออยู่หน้าวัด ซึ่งปัจจุบันถูกรื้อออกแล้ว</p>
                    <p>อย่างไรก็ตาม บริเวณ เจดีย์วัดหมื่นสาร ยังคงมีรูปปั้น “เสือคาบคน” ปรากฏอยู่ เป็นวัตถุพยานที่เชื่อมโยงเรื่องเล่าลี้ลับเข้ากับพื้นที่จริง</p>
                </div>
            </section>
        </div>
    </div>
    <section class="legend-timeline" aria-labelledby="timeline-title">
        <header><h2 id="timeline-title">Timeline</h2><p>จากตำนานสู่สถานที่จริง</p><div class="legend-divider" aria-hidden="true">·<span></span>❖<span></span>·</div></header>
        <ol>
            @foreach($nodes as [$label, $file, $anchor])
                <li><a href="#{{ $anchor }}"><span class="timeline-picture" @if($art($file)) style="--scene-art: url('{{ $art($file) }}')" @endif aria-hidden="true"></span><span>{{ $label }}</span></a></li>
            @endforeach
        </ol>
    </section>
    <dialog id="legend-search" class="legend-search-dialog" aria-labelledby="search-title">
        <form id="legend-search-form"><h2 id="search-title">ค้นหาในเรื่องเล่า</h2><label for="legend-query">คำค้นหา</label><div class="search-fields"><input id="legend-query" type="search" required autocomplete="off"><button type="submit">ค้นหา</button></div></form>
        <p id="search-status" role="status"></p><ul id="search-results"></ul><button class="search-close" type="button">ปิด</button>
    </dialog>
@endsection
@push('scripts')
    <script>{!! file_get_contents(resource_path('js/tiger-legend.js')) !!}</script>
@endpush

