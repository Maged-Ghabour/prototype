@extends('layouts.public')

@section('content')
    <div class="prototype-preview-wrapper" style="min-height: 80vh; padding: 40px 20px; max-width: 1200px; margin: 0 auto; display: flex; flex-direction: column;">
        <div style="background: white; border: 1px solid var(--border); border-radius: 16px; overflow: hidden; box-shadow: var(--ss); flex-grow: 1; display: flex; flex-direction: column;">
            <iframe 
                src="{{ route('prototype.raw', $prototype->slug) }}" 
                frameborder="0"
                style="width: 100%; min-height: 600px; flex-grow: 1;"
                onload="this.style.height = this.contentWindow.document.documentElement.scrollHeight + 'px';"
            ></iframe>
        </div>
    </div>
@endsection
