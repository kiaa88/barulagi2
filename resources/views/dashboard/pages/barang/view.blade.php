@extends('dashboard.layouts.app')
@section('pageTitle')
    Barang
@endsection

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css" rel="stylesheet">
    <style>
        .iti {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .filepond--drop-label {
            color: #4c4e53;
        }

        .filepond--label-action {
            text-decoration-color: #babdc0;
        }

        .filepond--panel-root {
            background-color: #edf0f4;
        }


        .filepond--root {
            width: 170px;
            margin: 0 auto;
        }

        .img-profile {
            width: 280px;
            height: 280px;
            border-radius: 50%;
            border: 1px solid #fafafa;
            margin-top: 60%;
        }
    </style>
@endpush

@section('content')
    @include('sweetalert::alert')
    <!-- Start::page-header -->
    <div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h2 class="main-content-title fs-24 mb-1">Data Barang</h2>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Barang</li>
            </ol>
        </div>

    </div>
    <!-- End::page-header -->
    <div class="row row-sm">
        <!-- Start::row-1 -->
        <div class="row row-sm">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-lg-flex justify-content-between">
                            <div class="mt-lg-0 mt-3">
                                <button class="btn btn-sm mx-1 btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <i class="fa-solid fa-plus text-white mb-1 me-2"></i>Tambah Barang
                                </button>
                                <a class="btn btn-sm mx-1 btn-danger" href="{{ route('dashboard.barang.export') }}">
                                    <i class="fa-solid fa-file-export text-white mb-1 me-2"></i>Export
                                </a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-body responsive-DataTable table-responsive">
                        <table id="responsiveDataTable" class="table table-bordered text-nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Stock</th>
                                    <th>Foto</th>
                                    <th>Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End::row-1 -->

       <!-- Modal Tambah Barang -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel1">Tambah Barang</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('dashboard.barang.insert')}}" id="formBarang" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <!-- Kode Barang -->
                        <div class="col-lg-12 mb-1">
                            <div class="form-floating">
                                <input type="text" class="form-control" style="background-color:#fafafa;" id="kode_barang" name="kode_barang" placeholder="Kode Barang" required value="{{ old('kode_barang') }}">
                                <label class="label-form" for="kode_barang">Kode Barang *</label>
                            </div>
                        </div>
                    
                        <!-- Nama Barang -->
                        <div class="col-lg-12 mb-1">
                            <div class="form-floating">
                                <input type="text" class="form-control" style="background-color:#fafafa;" id="nama_barang" name="nama_barang" placeholder="Nama Barang" required value="{{ old('nama_barang') }}">
                                <label class="label-form" for="nama_barang">Nama Barang *</label>
                            </div>
                        </div>
                    
                        <!-- Stock -->
                        <div class="col-lg-12 mb-1">
                            <div class="form-floating">
                                <input type="number" class="form-control" style="background-color:#fafafa;" id="stock" name="stock" placeholder="Stock" required value="{{ old('stock') }}">
                                <label class="label-form" for="stock">Stock *</label>
                            </div>
                        </div>
                    
                        <!-- Gambar -->
                        <div class="col-lg-12 mb-1">
                            <div class="form-floating">
                                <input type="file" class="form-control" style="background-color:#fafafa;" id="gambar" name="gambar" accept="image/*" required>
                                <label class="label-form" for="gambar">Pilih Gambar *</label>
                            </div>
                        </div>
                    
                        <!-- Kategori -->
                        <div class="col-lg-12 mb-1">
                            <div class="form-floating">
                                <select class="form-select" style="background-color:#fafafa;" id="kategori" name="kategori" required="">
                                    <option value="">Tidak ada Kategori yang dipilih</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->nama }}">{{ $category->nama }}</option>
                                    @endforeach
                                </select>
                                <label class="label-form" for="kategori">Kategori *</label>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

        <!-- End Modal Tambah Peserta -->

        <!-- Modal Edit Bunga -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="editModalLabel1">Edit Barang</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="" id="formedit"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <input type="hidden" name="id" id="id_edit" value="{{ old('id', $barang->id ?? '') }}">
                                <div class="col-lg-12 mb-1">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" style="background-color:#fafafa;" id="kode_edit" name="kode_barang" 
                                            placeholder="kode Barang" required="" value="{{ old('kode_barang', $barang->kode_barang ?? '') }}">
                                        <label class="label-form" for="kode_edit">Kode Barang *</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-1">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" style="background-color:#fafafa;" id="nama_edit" name="nama_barang" 
                                            placeholder="Nama Barang" required="" value="{{ old('nama_barang', $barang->nama_barang ?? '') }}">
                                        <label class="label-form" for="name_edit">Nama Barang *</label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 mb-1">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" style="background-color:#fafafa;" id="stock_edit" name="stock" 
                                            placeholder="Stock" required="" value="{{ old('stock', $barang->stock ?? '') }}">
                                        <label class="label-form" for="stock_edit">Stock *</label>
                                    </div>
                                </div>

                                
                                <!-- Gambar -->
                                <div class="col-lg-12 mb-1">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" id="gambar_edit" name="gambar" 
                                            value="{{ old('gambar', $barang->gambar ?? '') }}">
                                        <label class="label-form" for="gambar_edit">Gambar *</label>
                                    </div>
                                </div>
                            </div>
                            
                                <div class="col-lg-12 mb-1">
                                    <div class="form-floating">
                                        <select class="form-select" style="background-color:#fafafa;"
                                            id="kategori_edit" name="kategori" required="">
                                            <option value="">Tidak ada Kategori yang dipilih</option>
                                        </select>
                                        <label class="label-form" for="kategori_edit">Kategori *</label>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal Edit Bunga -->
    </div>
    <!-- End::row-1 -->
    <!-- Modal Preview Peserta -->
    <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <center>
                <img src="" class="img-profile" alt="">
            </center>
        </div>
    </div>
    <!-- Modal Preview Peserta -->
@endsection
@push('script')
    <script src="{{ asset('assets/js/datatables.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.all.js') }}"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/blockui.js') }}"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('assets/js/feather.js') }}"></script>
    <script>
        $('#formBarang').submit(function(e) {
            e.preventDefault();
            $.blockUI({
                message: '<div class="spinner-border text-primary" role="status"></div>',
                css: {
                    border: 'none',
                    backgroundColor: 'transparent'
                }
            });
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $.unblockUI();
                    console.log(response); // Pastikan response diterima dengan benar
                    swal.fire({
                        title: "Success",
                        text: "Data berhasil ditambahkan",
                        icon: "success",
                        button: "OK",
                    }).then(function() {
                        $('#exampleModal').modal('hide');
                        $('#responsiveDataTable').DataTable().ajax.reload();
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    console.error('Response:', xhr.responseText);
                    $.unblockUI();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if ($.fn.dataTable.isDataTable('#responsiveDataTable')) {
                $('#responsiveDataTable').DataTable().clear().destroy();
            }

            var table = $('#responsiveDataTable').DataTable({
                dom: "<'row'<'col-md-1'l><'col-md-6'B><'col-md-5'f>r>" +
                    "<'row'<'col-md-6'><'col-md-6'>>" +
                    "<'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
                "pageLength": 30,
                "lengthMenu": [
                    [10, 25, 30, 50, 100, -1],
                    [10, 25, 30, 50, 100, "All"]
                ],
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: `{{ url()->current() }}`,
                    data: function(d) {
                        d.barang = $('#barang').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'kode_barang',
                        name: 'kode_barang'
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar'
                    },
                    {
                        data: 'kategori',
                        name: 'kategori'
                    },
                    {
                        data: 'action'
                    }
                ],
                "rowCallback": function(row, data, iDisplayIndex) {
                    var pageInfo = table.page.info();
                    var index = pageInfo.start + iDisplayIndex + 1;
                    $('td:eq(0)', row).html(index);
                },
                "drawCallback": function() {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                },
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                buttons: [{
                    text: '<i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none">Tambah User</span>',
                    className: 'btn btn-primary ms-2 d-none',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#tambahModal'
                    }
                }]
            });
        });
    </script>
    <script>
        window.baseUrl = "{{ url('') }}";
        $('#responsiveDataTable').on('click', '.btn-edit', function() {
            $.blockUI({
                message: '<div class="spinner-border text-primary" role="status"></div>',
                css: {
                    border: 'none',
                    backgroundColor: 'transparent'
                }
            });
            const id = $(this).data('id');
            $.ajax({
                url: "{{ url(path: 'dashboard/barang/edit') }}/" + id,
                type: 'GET',
                data: {
                    id: id
                },
                success: function(response) {
                    $.unblockUI();
                    $('#editModal').modal('show');

                    $('#id_edit').val(response.id);
                    $('#kode_edit').val(response.id);
                    $('#nama_edit').val(response.name);
                    $('#stock_edit').val(response.stock);
                    $('#gambar_edit').val(response.phone);

                    // Clear and populate the categories dropdown
                    $('#kategori_edit').empty();
                    $('#kategori_edit').append('<option value="">Tidak ada Kategori yang dipilih</option>');
                    response.categories.forEach(function(category) {
                        var selected = (category.nama === response.kategori) ? 'selected' : '';
                        $('#kategori_edit').append(`<option value="${category.nama}" ${selected}>${category.nama}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    $.unblockUI();
                    console.error('Error:', error);
                }
            });
        });


        $('#formedit').on('submit', function(e) {
            e.preventDefault();
            $.blockUI({
                message: '<div class="spinner-border text-primary" role="status"></div>',
                css: {
                    border: 'none',
                    backgroundColor: 'transparent'
                }
            });

            const formData = new FormData();
            formData.append('id', $('#id_edit').val());
            formData.append('name', $('#name_edit').val());
            formData.append('stock', $('#stock_edit').val());
            formData.append('phone', $('#phone_edit').val());
            formData.append('alamat', $('#alamat_edit').val());
            $.ajax({
                url: "{{ url('dashboard/barang/update') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                processData: false,
                success: function(response) {
                    $.unblockUI();
                    swal.fire({
                        icon: 'success',
                        text: 'Berhasil Edit Barang'
                    });
                    $('#responsiveDataTable').DataTable().ajax.reload();
                    $('#editModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });

        $('#responsiveDataTable').on('click', '.btn-hapus', function() {
            $.blockUI({
                message: '<div class="spinner-border text-primary" role="status"></div>',
                css: {
                    border: 'none',
                    backgroundColor: 'transparent'
                }
            });
            const id = $(this).data('id');
            Swal.fire({
                title: "Yakin?",
                text: "Data Tidak Bisa Dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('dashboard/barang/delete') }}/" + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}', // Tambahkan token CSRF
                            id: id
                        },
                        success: function(response) {
                            $.unblockUI();
                            swal.fire({
                                icon: 'success',
                                text: 'Berhasil Delete Data'
                            });
                            $('#responsiveDataTable').DataTable().ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            $.unblockUI();
                            console.error('Error:', error);
                        }
                    });
                }
            });
        });
    </script>
@endpush
