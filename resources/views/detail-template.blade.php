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
                                            <form action="{{ route('update-template',$data->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-row">
                                                    <div class="form-group col-md-12 mb-2">
                                                        <label for="exampleInputtext1" class="form-label">Subject Email</label>
                                                        <input id="subject"  type="text" class="form-control" value="{{ $data->subject }}" name="subject">

                                                </div>
                                                    </div>
                                                    <div class="form-group col-md-12 mb-2">
                                                        <textarea type="text" rows="5" class="form-control" name="body" placeholder="Silahkan Masukkan Deskripsi" required> {{ $data->body }}</textarea>
                                                    
                                                    </div>
                                                    
                                                    <div class="form-group custom-file col-md-12">
                                                            <label>Preview Attachment</label>

                                                            <iframe src="{{ $pdf }}" width="100%" ></iframe>
                                                        
                                                    </div>
                                                   
                                                    <div class="form-group custom-file col-md-6">
                                                            <label>Change Attachment</label>
                                                            <input type="file" name="file" class="form-control" 
                                                            accept = "application/pdf"
                                                                placeholder="File">
                                                        
                                                    </div>
                                                </div>
                                               <a href="{{ route('template-email') }}" class="btn btn-primary mt-5">Back</a>
                                                <button type="submit" class="btn btn-success mt-5 float-right">Update Data</button>
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
