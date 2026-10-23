<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500</title>
    <style>
        body { font-family: sans-serif; text-align: center; margin-top: 15vh; color: #333; }
        .code { font-size: 72px; margin: 0; color: #b33; }
        a { color: #06c; }
    </style>
</head>
<body>
    <p class="code">500</p>
    <p>{{ __('Something went wrong. We are already working on it.') }}</p>
    <p><a href="/">{{ __('← To home') }}</a></p>
</body>
</html>