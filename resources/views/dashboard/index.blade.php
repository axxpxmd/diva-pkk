@extends('layouts.app')
@section('content')
<div class="page-heading">
    <h3>{{ $title }}</h3>
</div>
<section class="section">
    <div class="row" id="table-inverse">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Inverse table</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <p>You can also invert the colors—with light text on dark backgrounds—with <code class="highlighter-rouge">.table-dark</code>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
