@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
<section class="section animate__animated animate__fadeInRight">
    <div class="card my-2">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 px-0">
                    @include('layouts.alamat_filter')
                    <div class="row mb-4">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-8">
                            <button class="btn btn-success btn-sm mr-2" onclick="pressOnChange()"><i class="bi bi-filter m-r-8"></i>Filter</button>
                        </div> 
                    </div>
                </div>
                <div class="col-md-6 px-0">
                </div>
            </div>
        </div>
    </div> 
    <div class="card">
        <div class="card-body">
             <div class="table-responsive">
                <table id="dataTable" class="table data-table display nowrap table-hover table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>Jumlah Perihal</th>
                            <th>Surat</th>
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
            url: "{{ route('pengajuan.index') }}",
            method: 'GET',
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false},
            {data: 'nama', name: 'nama'},
            {data: 'tgl_pengajuan', name: 'tgl_pengajuan'},
            {data: 'status', name: 'status', className: 'text-center'},
            {data: 'jml_perihal', name: 'jml_perihal', className: 'text-center'},
            {data: 'surat', name: 'surat', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'}
        ]
    });

    pressOnChange();
    function pressOnChange(){
        table.api().ajax.reload();
    }
</script>
@endpush