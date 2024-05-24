@extends('layout.main')

@section('content')
<hr>
<ul>
    <li>Id: {{ $user['id'] }}</li>
    <li>Imię: {{ $user['firstName'] }}</li>
    <li>Nazwisko: {{ $user['lastName'] }}</li>
    <li>Miasto: {{ $user['city'] }}</li>
</ul>
<div>
    {{ $user['html'] }}
</div>
<hr>
@endsection
