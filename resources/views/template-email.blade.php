@extends('layouts.admin')
@section('title')
User
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
                                    <h4 class="modal-title" id="myModalLabel">Template Email</h4>
                                    <button type="button" class="btn btn-close"  data-dismiss="modal">
                                      {{-- <span aria-hidden="true">&times;</span> --}}
                                    </button>
                                  </div>
                                  <div class="modal-body">
            
                                    <form action="{{ route('add-attachment') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-row">
                                                    <div class="form-group col-md-12 mb-2">
                                                        <label class="text-muted">Kategori</label>
                                                        <select style="padding: 5px; width: 100%;" name="category">
                                                            <option value="">Silahkan Pilih Kategori</option>
                                                            <option value="Penting">Penting</option>
                                                            <option value="Internal">Internal</option>
                                                            <option value="External">External</option>

                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12 mb-2">
                                                        <label class="text-muted">Body</label>
                                                        <textarea type="text" rows="5" class="form-control" name="body" placeholder="Silahkan Masukkan Deskripsi" required></textarea>
                                                    
                                                    </div>
                                                    
                                                   
                                                    <div class="form-group custom-file col-md-12 mb-2">
                                                            <label>Attachment</label>
                                                            <input type="file" name="file"
                                                            accept = "application/pdf"
                                                            class="form-control" required
                                                                placeholder="File">
                                                        
                                                    </div>
                                                </div>
                                               
                                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>

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

                                <form action="{{ route('delete-template') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="idTemplate" name="idTemplate">
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
                                                <h2 class="text-md text-highlight">List Template Email</h2>
                                                <small class="text-muted">Daftar list seluruh template email</small>
                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                            <div >
                                                <a style="float: right" data-toggle="modal" data-target="#myModal" class="btn btn-md btn-success">
                                                    <span class="d-none d-sm-inline mx-1">Tambah Template</span>
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
                                                        <th><span class="text-muted">Template Email</span></th>
                                                        <th><span class="text-muted">Kategori</span></th>
                                                        <th><span class="text-muted">Nama Attachment</span></th>
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

    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'body' );
</script>

<script>
    function setParameter(id){
    console.log(id);
        document.getElementById('idTemplate').value = id;

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
                {data:'body', name: 'body'},
                {data:'category', name: 'category'},
                {data:'name_attachment', name: 'name_attachment'},
                {data:'created_at', name: 'created_at'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '20%'
                },
            ]
        });
        
</script>

@endpush