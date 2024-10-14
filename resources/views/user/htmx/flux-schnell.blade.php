
@vite('resources/js/app.js')

<script>

    fal.config({
        credentials: "{{$key}}"
    });

    prompt='{{$prompt}}';
    callFalAi2(prompt);
</script>