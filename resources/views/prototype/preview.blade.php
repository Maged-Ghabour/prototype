@extends('layouts.public')

@section('content')
    <style>
        /* Prototype-specific styles */
        {!! $prototype->css_code !!}
    </style>

    <div class="prototype-preview-wrapper" style="min-height: 60vh; padding: 40px 20px; max-width: 1200px; margin: 0 auto;">
        {!! $prototype->html_code !!}
    </div>

    <script>
        {!! $prototype->js_code !!}
    </script>
@endsection
