<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo sys_config('title') ?></title>
    <link rel="stylesheet" href="/static/weihu/style.css">
    <script src="/static/weihu/gsap.min.js"></script>
    <style>
        .title {
            text-align: center;
            margin-top: 150px;
            position: absolute;
            left: 42%;
            font-size: 22px;
    </style>
</head>
<body>

<div class="title">
    <div><?php echo $exception->getMessage() ?></div>
</div>

<!-- partial:index.partial.html -->
<canvas id="canvas"></canvas>
<!-- partial -->
<script src='/static/weihu/gsap.min.js'></script>
<script src="/static/weihu/script.js"></script>

<div style="text-align:center;clear:both;">
    <script src="/static/weihu/statics.js" type="text/javascript"></script>
</div>

</body>
</html>
