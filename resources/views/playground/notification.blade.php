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

<button id="button">Enable Notification</button>

<script>

    const button=document.getElementById('button')

    button.addEventListener('click',()=>{
        Notification.requestPermission().then((perm)=>{
            if(perm==='granted'){
                console.log('granted')
                new Notification("granted",{
                  body:"this is notification"
                })
            }
        })
    })



</script>

</body>
</html>
