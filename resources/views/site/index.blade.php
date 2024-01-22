@extends('layouts.master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
            <h1>Главная страница</h1>
            <ul>
                @foreach($users as $user)
                    @if ($user->id != \Illuminate\Support\Facades\Auth::user()->id)
                        <li><a href="{{ route('message.chat', $user->id) }}">{{$user->name}}</a></li>
                    @endif
                @endforeach
            </ul>
        @endauth

        @guest
            <h1>Главная страница</h1>
            <p>Чтобы увидеть список пользователей, необходимо зарегистрироваться.</p>
        @endguest
    </div>
@endsection
