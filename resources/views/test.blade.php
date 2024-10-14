<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://unpkg.com/htmx.org@2.0.2" integrity="sha384-Y7hw+L/jvKeWIRRkqWYfPcvVxHzVzn5REgzbawhxAuQGwX1XWe70vji+VSeHOThJ" crossorigin="anonymous"></script>

</head>
<body>
<div id="htmxerrors"></div>

<div hx-get="{{route('image.fetch')}}" hx-trigger="load delay:5s"  hx-swap="outerHTML">

</div>


<script src="{{asset('assets/js/custom-htmx.js')}}"></script>
</body>
</html>