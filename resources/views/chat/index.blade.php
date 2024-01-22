<?php

$connector = new \React\Socket\Connector();

$connector->connect('127.0.0.1:8080')
    ->then(
        function (\React\Socket\ConnectionInterface $connection) use ($output) {
            $connection->on('data', function ($data) {
                //сделать вывод
            });
        }
    );
?>

@extends('layouts.master')


@section('content')
    <h2>Чат с {{$friend_name}}</h2>
    <a href="{{ route('site.index') }}">назад</a>
    <div class="bg-light p-5 rounded">
        <ul class="chat">
            @foreach($messages as $message)
                <li>
                    <b>{{ $message->author_name }}:</b>
                    <p>{{ $message->content }}</p>
                </li>
            @endforeach
        </ul>
        <hr>
        <form id="message_form" method="POST">
            @csrf
            <input type="hidden" name="chat_id" value="{{ $chat_id }}" />
            <input type="hidden" name="author_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}" />
            <textarea name="content" id="message_content" style="width: 100%; height: 50px"></textarea>
            <input type="submit" id="submit" value="Отправить">
        </form>
    </div>

    <script src="https://cdn.socket.io/4.5.0/socket.io.min.js" integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
@endsection
