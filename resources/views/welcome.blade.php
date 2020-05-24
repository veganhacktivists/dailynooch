@extends('layouts.app')

@section('title', title(__('Welcome')))

@section('content')
  {{ @widget(\App\Widgets\RssFeed::class, ['url' => 'https://nutritionfacts.org/feed']) }}
@endsection
