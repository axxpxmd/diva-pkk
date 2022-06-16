@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
<section class="section animate__animated animate__backInDown">
    <div class="mb-2">
        <a href="#" class="btn btn-sm btn-success bdr-r-7 px-2"><i class="bi bi-plus font-weight-bold fs-16 m-r-5"></i>Tambah Data</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table data-table display nowrap table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>RT</th>
                            <th>RW</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
<script type="text/javascript">
    var table = $('#dataTable').dataTable({
        scrollX: true,
        processing: true,
        serverSide: true,
        order: [ 0, 'asc' ],
        pageLength: 25,
        ajax: {
            url: "{{ route('rt-rw.index') }}",
            method: 'GET'
        },
        columns: [
            {data: 'id', name: 'id', className: 'text-center', orderable: false, searchable: false},
            {data: 'kecamatan_id', name: 'kecamatan_id'},
            {data: 'kelurahan_id', name: 'kelurahan_id'},
            {data: 'rt', name: 'rt'},
            {data: 'rw', name: 'rw'}
        ]
    });
</script>
@endpush