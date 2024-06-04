@extends('layouts.class-info')

@section('title', 'WindClassRoom')

@section('content')
<div class="mx-auto py-10 px-36">
    <iframe src="{{ $filePath }}" width="100%" height="700">
</div>
@stop