<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/js/app.js')
    <script src="https://unpkg.com/htmx.org@2.0.3" integrity="sha384-0895/pl2MU10Hqc6jd4RvrthNlDiE9U1tWmX7WRESftEDRosgxNsQG/Ze9YMRzHq" crossorigin="anonymous"></script>

</head>
<body>
<div id="htmxerrors"></div>
<button id="fetch-prompt">Fetch Prompt</button>


<form action="{{route('flux-schnell.prompt')}}" hx-post="{{route('flux-schnell.prompt')}}" hx-target="#target">
    @csrf

    <input type="text" name="prompt" >

    <button>send</button>
</form>

<div id="target"></div>

<script src="{{asset('assets/js/custom-htmx.js')}}"></script>
</body>
</html>