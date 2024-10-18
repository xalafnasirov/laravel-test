@extends('layouts.app')

@section('content')
    @livewire('services.single_product', ['id'=>$id])
@endsection
