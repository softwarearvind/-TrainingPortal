@extends('layouts.app')

@section('title', 'Training Portal - Learn. Grow. Succeed.')

@section('content')

    @include('partials.hero')

    @include('partials.stats')

    @include('partials.categories')

    @php
        $homeCourses = \App\Models\Course::with('category')
            ->where('status', true)
            ->latest()
            ->take(6)
            ->get();
    @endphp

    @include('partials.courses')

    @include('partials.about')

    @php
        $homeTrainers = \App\Models\Trainer::where('status', true)
            ->latest()
            ->take(3)
            ->get();
    @endphp

    @include('partials.trainers')

    @include('partials.cta')

    @include('partials.testimonials')

@endsection
