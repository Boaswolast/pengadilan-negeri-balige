@extends('layouts.pengadilan')
@section('content')
@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Data</th>
        </tr>
    </thead>
    <tbody>
        @foreach(session('temporary_data') as $data)
            <tr>
                <td>{{ $data['data'] ?? '' }}</td>
                <td>{{ $data['data2'] ?? ''}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('temporaryData') }}">Tambahkan Data Lainnya</a>
<form action="{{ route('saveTemporaryData') }}" method="POST">
    @csrf
    <button type="submit">submit</button>
</form>

@endsection