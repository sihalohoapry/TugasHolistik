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
                
                                        <form action="{{ route('add-user') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                                <div class="mb-3">
                                                    <label for="exampleInputtext1" class="form-label">Name</label>
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  required autocomplete="name" autofocus>

                                                    @error('name')
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
            
                                        <form action="{{ route('add-user') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            
                                            <div class="form-group custom-file col-md-12 mb-2">
                                                <input type="file" name="file"
                                                class="form-control" required
                                                accept="application/vnd.ms-excel"
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

                    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Edit User</h4>
                                    <button type="button" class="btn btn-close"  data-dismiss="modal">
                                      {{-- <span aria-hidden="true">&times;</span> --}}
                                    </button>
                                  </div>
                                  <div class="modal-body">
            
                                    <form action="{{ route('edit-user') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                    <input type="hidden" id="id" name="id">

                                        <div class="mb-3">
                                            <label for="exampleInputtext1" class="form-label">Name</label>
                                            <input id="name_edit" type="text" class="form-control" name="name_edit"  required >

                                         </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Email Address</label>
                                            <input id="email_edit" type="email" class="form-control"  name="email_edit">

                                                        
                                        </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success">Submit</button>
                                                            </form>
                                    
                                                        </div>
                                                        </div>
                                                    </div>
                                    </form>
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

                                <form action="{{ route('delete-user') }}" method="POST" enctype="multipart/form-data">
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
                                                        <th><span class="text-muted">Nama</span></th>
                                                        <th><span class="text-muted">Email</span></th>
                                                        <th><span class="text-muted">Created Date</span></th>
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

    function setParameterEdit(id, name, email){
        document.getElementById('id').value = id;
        document.getElementById('email_edit').value = email;
        document.getElementById('name_edit').value = name;
        


    }
    var datatable = $('#datatable').DataTable({
            processing: true,
            serverSide:true,
            ordering:true,
            ajax:{
                url: '{!! url()->current() !!}',
            },
            columns:[
                {data:'name', name: 'name'},
                {data:'email', name: 'email'},
                {data:'created_at', name: 'created_at'},
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