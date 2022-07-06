@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
<section class="section animate__animated animate__fadeInRight">
    <div class="mb-3 text-right">
        <a href="{{ route('anggota-keluarga.create', 'status=1') }}" class="btn btn-sm btn-success px-2 mb-5-m"><i class="bi bi-plus font-weight-bold fs-16 m-r-5"></i>Tambah Data | Hidup</a>
        <a href="{{ route('anggota-keluarga.create', 'status=0') }}" class="btn btn-sm btn-danger px-2"><i class="bi bi-plus font-weight-bold fs-16 m-r-5"></i>Tambah Data | Meninggal</a>
    </div>
    <div class="card">  
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table data-table table-hover table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Aksi</th>
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
            url: "{{ route('anggota-keluarga.index') }}",
            method: 'GET'
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false},
            {data: 'nama', name: 'nama'},
            {data: 'nik', name: 'nik'},
            {data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false}
        ]
    });
</script>
@endpush