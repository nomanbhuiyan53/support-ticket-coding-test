@extends('backend.layouts.app')
@section('content')
<div class="card">
    <div class="card-body p-3">
        <div class="row">
            <div class="col-md-3">
                <h3>Welcome, {{ auth()->user()->name }}</h3>
            </div>
        </div>
    </div>
</div>
@endSection