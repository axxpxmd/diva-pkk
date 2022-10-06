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
                            <th>Kode</th>
                            <th>Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>Ketua Kelurahan</th>
                            <th>Jumlah</th>
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
            url: "{{ route('kelurahan.index') }}",
            method: 'GET',
            data: function (data) {
                data.kecamatan_filter = $('#kecamatan_filter').val();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false},
            {data: 'kode', name: 'kode'},
            {data: 'n_kelurahan', name: 'n_kelurahan'},
            {data: 'kecamatan_id', name: 'kecamatan_id'},
            {data: 'ketua_kelurahan', name: 'ketua_kelurahan', className: 'text-center'},
            {data: 'jumlah', name: 'jumlah', className: 'text-center'}
        ]
    });

    pressOnChange();
    function pressOnChange(){
        table.api().ajax.reload();
    }
</script>
@endpush