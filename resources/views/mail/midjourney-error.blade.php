<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<p>User: {{ $user->id }}</p>
<p>Midjourney task id: {{ $task_id }}</p>

<pre><code class="language-JSON">{!! json_encode($apiresponse, JSON_PRETTY_PRINT) !!}</code></pre>


</body>
</html>