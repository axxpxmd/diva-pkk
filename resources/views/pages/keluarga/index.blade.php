@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
<section class="section animate__animated animate__fadeInRight">
    <div class="mb-3 text-right">
        <a href="{{ route('keluarga.create') }}" class="btn btn-sm btn-success px-2"><i class="bi bi-plus font-weight-bold fs-16 m-r-5"></i>Tambah Data</a>
    </div>
    <div class="card">  
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table data-table table-hover table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kepala Keluarga</th>
                            <th>Dasawisma</th>
                            <th>Jml Keluarga</th>
                            <th>Alamat</th>
                            <th>Kriteri</th>
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
            url: "{{ route('keluarga.index') }}",
            method: 'GET'
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false},
            {data: 'nm_kpl_klrg', name: 'nm_kpl_klrg'},
            {data: 'dasawisma_id', name: 'dasawisma_id'},
            {data: 'jml_keluarga', name: 'jml_keluarga'},
            {data: 'jml_keluarga', name: 'jml_keluarga'},
            {data: 'kriteria_rmh', name: 'kriteria_rmh'},
            {data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false}
        ]
    });
</script>
@endpush