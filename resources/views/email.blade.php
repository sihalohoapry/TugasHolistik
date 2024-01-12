@extends('layouts.admin')
@section('title')
Email
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

                <div class="modal fade" id="ModalSentAll" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Kirim Email</h4>
                                <button type="button" class="btn btn-close" data-dismiss="modal" >
                                
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('sent-all') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="idTemplate" name="idTemplate">
                                <p>Anda akan mengirim email sejumlah <span><b id="jumlahData"></b></span></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Kirim</button>
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
                                                <h2 class="text-md text-highlight">Email</h2>
                                                <div class="mt-4 mb-4">
                                                {{-- <a  data-toggle="modal" data-target="#myModal" class="btn btn-md btn-success">
                                                    <span class="d-none d-sm-inline mx-1">Sent Mail</span>
                                                    <i class="ti ti-mail"></i>
                                                </a> --}}
                                                
                                            </div>
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
                                                        <th width="150px"><button type="button" data-toggle="modal" data-target="#ModalSentAll" name="bulk_delete" id="bulk_delete" class="btn btn-md btn-primary btn-xs">Sent Email 
                                                            <i class="ti ti-mail"></i></button></th>
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
                {data: 'checkbox', name: 'checkbox', orderable:false, searchable:false},
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
        

        var user_id;
  
    $(document).on('click', '.delete', function(){
        user_id = $(this).attr('id');
        $('#confirmModal').modal('show');
    });
 
    $('#ok_button').click(function(){
        $.ajax({
            url:"users/destroy/"+user_id,
            beforeSend:function(){
                $('#ok_button').text('Deleting...');
            },
            success:function(data)
            {
                setTimeout(function(){
                $('#confirmModal').modal('hide');
                $('#user_table').DataTable().ajax.reload();
                alert('Data Deleted');
                }, 2000);
            }
        })
    });
 
    $(document).on('click', '#bulk_delete', function(){
        const id = [];
        $('.users_checkbox:checked').each(function(){
            id.push($(this).val());
        });

        // $('[name=idTemplate]').val(id); 

        document.getElementById('idTemplate').value =  JSON.stringify(id);
        document.getElementById('jumlahData').innerHTML =  id.length;

    });

</script>

@endpush