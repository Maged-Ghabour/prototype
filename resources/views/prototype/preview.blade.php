<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- 
        SEO: Use the prototype title for the page title.
        The title is escaped via Blade's {{ }} syntax for safety.
    --}}
    <title>{{ $prototype->title }}</title>
    <meta name="robots" content="noindex, nofollow">

    {{--
        Inject the prototype's CSS code inside a <style> tag.
        Security note: This content is authored by authenticated admins only.
        We use {!! !!} intentionally here to render raw CSS (not user-submitted input).
    --}}
    <style>
        /* ── Reset: ensure prototype renders full-page ── */
        *, *::before, *::after {
            box-sizing: border-box;
        }

        /* Prototype-specific styles */
        {!! $prototype->css_code !!}
    </style>
</head>
<body>

    {{--
        Render the prototype's HTML body content.
        Security note: This is admin-controlled content, not user-submitted.
        We use {!! !!} intentionally to render raw HTML markup.
    --}}
    {!! $prototype->html_code !!}

    {{--
        Inject the prototype's JavaScript at the end of the body.
        Placed after HTML so that DOM elements are available when the script runs.
        Security note: Admin-controlled content only.
    --}}
    <script>
        {!! $prototype->js_code !!}
    </script>

</body>
</html>
