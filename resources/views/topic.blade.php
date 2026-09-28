@extends('layouts.site')
@section('title', $title.' | วัดหมื่นสาร – ชุมชนวัวลาย')
@section('content')
    <section class="topic-page">
        <x-temple class="topic-icon" />
        <h1>{{ $title }}</h1>
        <div class="ornament-divider" aria-hidden="true"><span>❖</span></div>
        <p>กำลังเตรียมเนื้อหา{{ $title }}</p>
        <a class="ornate-button primary-button" href="{{ route('home') }}#explore">กลับไปสำรวจเรื่องราว <span aria-hidden="true">⟶</span></a>
    </section>
@endsection
