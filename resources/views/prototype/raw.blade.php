<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $prototype->title }}</title>
    <meta name="robots" content="noindex, nofollow">

    <style>
        /* ── Reset: ensure prototype renders properly ── */
        *, *::before, *::after {
            box-sizing: border-box;
        }
        
        body { margin: 0; padding: 0; }

        /* Prototype-specific styles */
        {!! $prototype->css_code !!}
    </style>
</head>
<body>

    {!! $prototype->html_code !!}

    <script>
        {!! $prototype->js_code !!}
    </script>

</body>
</html>
