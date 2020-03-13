<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>医衡随机与药物管理系统</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <div id="app" class="app-main"></div>
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="/js/iconfont.js"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>