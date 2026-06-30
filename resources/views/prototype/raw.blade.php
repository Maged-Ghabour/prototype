@php
    $html = trim($prototype->html_code);
    $isFullHtml = str_contains(strtolower($html), '<html');

    if ($isFullHtml) {
        $css = $prototype->css_code ? "<style>{$prototype->css_code}</style>" : '';
        $js = $prototype->js_code ? "<script>{$prototype->js_code}</script>" : '';

        if ($css && str_contains(strtolower($html), '</head>')) {
            $html = preg_replace('/<\/head>/i', $css . '</head>', $html, 1);
        } else {
            $html = $css . $html;
        }
        
        if ($js && str_contains(strtolower($html), '</body>')) {
            $html = preg_replace('/<\/body>/i', $js . '</body>', $html, 1);
        } else {
            $html = $html . $js;
        }
    }
@endphp

@if ($isFullHtml)
{!! $html !!}
@else
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
@endif
