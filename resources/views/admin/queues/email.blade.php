@extends('admin.layout')

@section('email')

    <form action="{{route('sendEmail')}}" method="post">
        @csrf
        <label for="email">Email</label>
        <input id="email" class="form-control" type="email" name="email">
        <label for="message">Message</label>

        <textarea id="message" class="form-control" name="message"></textarea>
        <button>Send</button>
    </form>
@endsection