@extends('layouts.admin')
@section('title')
    Detail Template
@endsection
@section('content')

      <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!--  Main wrapper -->
    <div class="body-wrapper">

        <div class="container-fluid">

            <div id="content" class="flex ">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismiss=">
            <button type="button" class="btn btn-close" data-dismiss="alert" aria-hidden="true"></button>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
        </div>
    @endif
                <!-- ############ Main START-->
                <div>
                    <div class="page-hero page-container " id="page-hero">
                        <div class="padding d-flex pt-0">
                            <div class="page-title">
                                <h2 class="text-md text-highlight">Update Template</h2>
                                <small class="text-muted">Silahkan update data template emaiil</small>
                            </div>
                        </div>
                    </div>

                    <div class="page-content page-container" id="page-content">
                        <div class="padding pt-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Data - data laporan</strong>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('update-data',$data->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                    <label for="exampleInputtext1" class="form-label">Customer</label>
                                                    <input id="customer" type="text" class="form-control @error('customer') is-invalid @enderror" name="customer"   value="{{ $data->customer }}"  autofocus>

                                                    @error('customer')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Telephone</label>
                                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"   value="{{ $data->phone }}" autocomplete="phone">

                                                                @error('phone')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Email Address</label>
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"   value="{{ $data->email }}" autocomplete="email">

                                                                @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Brand</label>
                                                    <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand"   value="{{ $data->brand }}" autocomplete="brand">

                                                                @error('brand')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Tanggal Transaksi</label>
                                                    <input id="transaction_date" type="date" class="form-control @error('transaction_date') is-invalid @enderror" name="transaction_date"  value="{{ $data->transaction_date }}" autocomplete="transaction_date">

                                                                @error('transaction_date')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="form-group col-md-6 mb-3">
                                                        <label for="exampleInputtext1" class="form-label">Tipe Transaksi</label>
                                                        <select class="form-control" name="tipe_trancation" id="tipe_trancation"  >
                                                                    <option value="{{ $data->tipe_trancation}}">{{ $data->tipe_trancation}}</option>
                                                                    <option  value="OFFLINE">Offline</option>
                                                                    <option  value="ONLINE">Online</option>
                                                                    
                                                        </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Nama Toko</label>
                                                    <input id="name_store" type="text" class="form-control @error('name_store') is-invalid @enderror" name="name_store"    autocomplete="name_store">

                                                                @error('name_store')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Group Produk</label>
                                                    <input id="name_product" type="text" class="form-control @error('name_product') is-invalid @enderror" name="name_product" value="{{ old('name_product') }}"  value="{{ $data->name_product }}" autocomplete="name_product">

                                                                @error('name_product')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Product</label>
                                                    <input id="product" type="text" class="form-control @error('product') is-invalid @enderror" name="product"   value="{{ $data->product }}" autocomplete="product">

                                                                @error('product')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                                                    <input id="name_product" type="text" class="form-control @error('name_product') is-invalid @enderror" name="name_product"  value="{{ $data->name_product }}" autocomplete="name_product">

                                                                @error('name_product')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Gender</label>
                                                    <input id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender"   value="{{ $data->gender }}" autocomplete="gender">

                                                                @error('gender')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Warna</label>
                                                    <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color"   value="{{ $data->color }}" autocomplete="color">

                                                                @error('color')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Size</label>
                                                    <input id="size" type="text" class="form-control @error('size') is-invalid @enderror" name="size"   value="{{ $data->size }}" autocomplete="size">

                                                                @error('size')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Qty</label>
                                                    <input id="qty" type="text" class="form-control @error('qty') is-invalid @enderror" name="qty"  value="{{ $data->qty }}" autocomplete="qty">

                                                                @error('qty')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Harga</label>
                                                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price"   value="{{ $data->price }}" autocomplete="price">

                                                                @error('price')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Disc</label>
                                                    <input id="disc" type="text" class="form-control @error('disc') is-invalid @enderror" name="disc"   value="{{ $data->disc }}" autocomplete="disc">

                                                                @error('disc')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Netto</label>
                                                    <input id="netto" type="text" class="form-control @error('netto') is-invalid @enderror" name="netto"  value="{{ $data->netto }}" autocomplete="netto">

                                                                @error('netto')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Domisili</label>
                                                    <input id="domisili" type="text" class="form-control @error('domisili') is-invalid @enderror" name="domisili"   value="{{ $data->domisili }}" autocomplete="domisili">

                                                                @error('domisili')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button type="submit" style="float: right" class="btn btn-success">Submit</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                                    <a href="{{ route('template-email') }}" class="btn btn-primary mt-5">Back</a>
                                               
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ############ Main END-->
            </div>
            <!-- ############ Content END-->


        </div>

    </div>
  </div>




@endsection
@push('addon-script')
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'body' );
</script>
@endpush
