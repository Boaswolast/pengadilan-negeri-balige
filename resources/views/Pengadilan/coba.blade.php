@extends('layouts.pengadilan')
@section('content')
<form action="{{ route('addTemporaryData') }}" method="post">
    @csrf
    <input type="text" name="data" placeholder="Masukkan Data">
    <input type="text" name="data2" placeholder="Masukkan Data">
    <button type="submit">Tambahkan Data</button>
</form>
@endsection