@extends('layouts.master')

@section('content')
    <form action="{{ route('contacts-import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Import Users</button>
    </form>
@endsection

