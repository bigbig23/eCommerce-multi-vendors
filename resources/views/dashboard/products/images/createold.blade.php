@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="">
                                        المنتجات </a>
                                </li>
                                <li class="breadcrumb-item active"> أضافه منتج
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> أضافة منتج جديد </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                        <h3 class="text-center" style="margin-top: 50px;">يمكنك رفع اكثر من صوره هنا</h3><br>
                                        <form method="post" action="{{route('upload.store')}}" enctype="multipart/form-data"
                                              class="dropzone" id="dropzone">
                                            @csrf
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@stop



@section('script')

    <script type="text/javascript">
        Dropzone.options.dropzone =
            {
                maxFilesize: 12,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time+file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file)
                {
                    var name = file.upload.filename;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'GET',
                        url: '{{ route("delete") }}',
                        data: {filename: name},
                        success: function (data){
                            console.log("File has been successfully removed!!");
                        },
                        error: function(e) {
                            console.log(e);
                        }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },

                success: function(file, response)
                {
                    console.log(response);
                },
                error: function(file, response)
                {
                    return false;
                }
            };
    </script>
@stop



{{--  USING DROPZONE WITH FIELD INSIDE IT

<form action="{{ url('upload/store') }}" method="POST" enctype="multipart/form-data">

    --}}
{{-- <div class="col-md-6">
         <div class="box">
             <div class="box-header with-border">
                 <h3 class="box-title">Info</h3>
             </div>
             <div class="box-body ">
                 <div class="form-group col-md-12">
                     <label>Name</label>
                     <input type="text" name="txtName" class="form-control" value="{{ old('txtName')}}">
                 </div>
                 <div class="form-group col-md-12">
                     <label>Desc</label>
                     <textarea name="txtDesc" class="form-control">{{ old('txtDesc') }}</textarea>
                 </div>
                 <div class="form-group col-md-12">
                     <label>Content</label>
                     <textarea name="txtContent" class="form-control">{{ old('txtContent') }}</textarea>
                 </div>
                 <div class="form-group col-md-12">
                     <label>Price</label>
                     <input name="txtPrice" class="form-control"
                            value="@if(empty(old('txtPrice'))) 0 @else{{old('txtPrice')}}@endif">
                 </div>

             </div>
         </div>
     </div>--}}{{--


    <div class="col-md-12">
        <div class="dropzone" id="my-dropzone" name="myDropzone">

        </div>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-success pull-right">
            <i class="fa fa-save"></i>
            <span>Save and back</span>
        </button>
    </div>
</form>--}}
