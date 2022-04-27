@extends('layouts.main')

@section('container')
<h1>Welcome to @{{ title }}</h1>
<router-view></router-view>
@endsection