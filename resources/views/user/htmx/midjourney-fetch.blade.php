
@if($status==='finished')
    <img src="{{$url}}" alt="">
@else
    <div hx-get="{{route('image.fetch')}}" hx-trigger="load delay:5s"  hx-swap="outerHTML">

    </div>
@endif
