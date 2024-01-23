@extends('layouts.admin')
@section('title')
Upload Data
@endsection
@push('addon-script')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/fc-4.1.0/datatables.min.js"></script>

@endpush
@section('content')


      <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!--  Main wrapper -->
    <div class="body-wrapper">

        <div class="container-fluid">
            <div id="content" class="flex" >
                @include('alert.success')
                @include('alert.failed')
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Add Data</h4>
                                    <button type="button" class="btn btn-close"  data-dismiss="modal">
                                      {{-- <span aria-hidden="true">&times;</span> --}}
                                    </button>
                                  </div>
                                  <div class="modal-body">
                
                                        <form action="{{ route('add-data') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                                <div class="mb-3">
                                                    <label for="exampleInputtext1" class="form-label">Customer</label>
                                                    <input id="customer" type="text" class="form-control @error('customer') is-invalid @enderror" name="customer"  required autocomplete="customer" autofocus>

                                                    @error('customer')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Telephone</label>
                                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                                                @error('phone')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Email Address</label>
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                                @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Brand</label>
                                                    <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{ old('brand') }}" required autocomplete="brand">

                                                                @error('brand')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Tanggal Transaksi</label>
                                                    <input id="transaction_date" type="date" class="form-control @error('transaction_date') is-invalid @enderror" name="transaction_date" value="{{ old('transaction_date') }}" required autocomplete="transaction_date">

                                                                @error('transaction_date')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="form-group mb-3">
                                                        <label for="exampleInputtext1" class="form-label">Tipe Transaksi</label>
                                                        <select class="form-control" name="tipe_trancation" id="tipe_trancation" required>
                                                                    <option value="">Add Tipe Transaksi</option>
                                                                    <option  value="OFFLINE">Offline</option>
                                                                    <option  value="ONLINE">Online</option>
                                                                    
                                                        </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Nama Toko</label>
                                                    <input id="name_store" type="text" class="form-control @error('name_store') is-invalid @enderror" name="name_store" value="{{ old('name_store') }}" required autocomplete="name_store">

                                                                @error('name_store')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Group Produk</label>
                                                    <input id="name_product" type="text" class="form-control @error('name_product') is-invalid @enderror" name="name_product" value="{{ old('name_product') }}" required autocomplete="name_product">

                                                                @error('name_product')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Product</label>
                                                    <input id="product" type="text" class="form-control @error('product') is-invalid @enderror" name="product" value="{{ old('product') }}" required autocomplete="product">

                                                                @error('product')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                                                    <input id="name_product" type="text" class="form-control @error('name_product') is-invalid @enderror" name="name_product" value="{{ old('name_product') }}" required autocomplete="name_product">

                                                                @error('name_product')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Gender</label>
                                                    <input id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender">

                                                                @error('gender')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Warna</label>
                                                    <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ old('color') }}" required autocomplete="color">

                                                                @error('color')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Size</label>
                                                    <input id="size" type="text" class="form-control @error('size') is-invalid @enderror" name="size" value="{{ old('size') }}" required autocomplete="size">

                                                                @error('size')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Qty</label>
                                                    <input id="qty" type="text" class="form-control @error('qty') is-invalid @enderror" name="qty" value="{{ old('qty') }}" required autocomplete="qty">

                                                                @error('qty')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Harga</label>
                                                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price">

                                                                @error('price')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Disc</label>
                                                    <input id="disc" type="text" class="form-control @error('disc') is-invalid @enderror" name="disc" value="{{ old('disc') }}" required autocomplete="disc">

                                                                @error('disc')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Netto</label>
                                                    <input id="netto" type="text" class="form-control @error('netto') is-invalid @enderror" name="netto" value="{{ old('netto') }}" required autocomplete="netto">

                                                                @error('netto')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Domisili</label>
                                                    <input id="domisili" type="text" class="form-control @error('domisili') is-invalid @enderror" name="domisili" value="{{ old('domisili') }}" required autocomplete="domisili">

                                                                @error('domisili')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button type="submit" style="float: right" class="btn btn-success">Submit</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                        </form>
                                    
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Upload Excel</h4>
                                    <button type="button" class="btn btn-close"  data-dismiss="modal">
                                      {{-- <span aria-hidden="true">&times;</span> --}}
                                    </button>
                                  </div>
                                  <div class="modal-body">
            
                                        <form action="{{ route('add-transaction') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            
                                            <div class="form-group custom-file col-md-12 mb-2">
                                                <input type="file" name="file"
                                                class="form-control" required
                                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                                placeholder="File">
                                                <p><span style="color: red">*</span><i>extention harus xlsx</i></p>
                                                            
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6" >
                                                <button type="submit" style="float:right" class="btn btn-success">Upload</button>

                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                            </div>
                                            </div>

                                        </form>
                                    
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">HAPUS DATA</h4>
                                <button type="button" class="btn btn-close" data-dismiss="modal" >
                                
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('delete-transaction') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="idData" name="idData">
                                <p>Anda yakin menghapus data ini?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Ya</button>
                                </form>

                            </div>
                            </div>
                        </div>
                    </div>


    <!-- ############ Main START-->
                            <div>
                                <div class="page-hero page-container " id="page-hero">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="page-title">
                                                <h2 class="text-md text-highlight">List Data</h2>
                                                <small class="text-muted">Daftar list data</small>
                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                            <div >
                                                <a style="float: right" data-toggle="modal" data-target="#myModal" class="btn btn-md btn-success">
                                                    <span class="d-none d-sm-inline mx-1">Add Data</span>
                                                    <i class="ti ti-plus"></i>
                                                </a>
                                                <a style="float: right; margin-right: 50px" data-toggle="modal" data-target="#modalUpload" class="btn btn-md btn-primary">
                                                    <span class="d-none d-sm-inline mx-1">Upload Data</span>
                                                    <i class="ti ti-plus"></i>
                                                </a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="page-content page-container" id="page-content">
                                    <div class="padding">
                                        <div class="table-responsive">
                                            <table id="datatable" class="table table-theme table-row v-middle" >
                                                <thead>
                                                    <tr>
                                                        <th><span class="text-muted">Nama Barang</span></th>
                                                        <th><span class="text-muted">Tgl Transaksi</span></th>
                                                        <th><span class="text-muted">QTY</span></th>
                                                        <th><span class="text-muted">Tipe Transaksi</span></th>
                                                        <th><span class="text-muted">Total Bayar</span></th>
                                                        <th><span class="text-muted">Aksi</span></th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                {{-- @foreach ($data as $row ) --}}
                                                
                                                {{-- @endforeach --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ############ Main END-->
            </div>

        </div>

            <!-- ############ Content END-->

    </div>



@endsection

@push('addon-script')
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script>
    function setParameter(id){
        document.getElementById('idData').value = id;

    }
    var datatable = $('#datatable').DataTable({
            processing: true,
            serverSide:true,
            ordering:true,
            ajax:{
                url: '{!! url()->current() !!}',
            },
            columns:[
                {data:'name_product', name: 'name_product'},
                {data:'transaction_date', name: 'transaction_date'},
                {data:'qty', name: 'qty'},
                {data:'tipe_trancation', name: 'tipe_trancation'},
                {data:'netto', name: 'netto'},

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '15%'
                },
            ]
        });
        
</script>

@endpush