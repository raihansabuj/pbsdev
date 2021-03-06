<head>
<?php
    /*
    <!--Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('/')}}admin/vendors/jquery-validation-engine/css/validationEngine.jquery.css" />
    <link type="text/css" rel="stylesheet" href="{{asset('/')}}admin/vendors/datepicker/css/bootstrap-datepicker.min.css">
    <link type="text/css" rel="stylesheet" href="{{asset('/')}}admin/vendors/datepicker/css/bootstrap-datepicker3.css">
    <link type="text/css" rel="stylesheet" href="{{asset('/')}}admin/vendors/datetimepicker/css/DateTimePicker.min.css">
    <link type="text/css" rel="stylesheet" href="{{asset('/')}}admin/vendors/bootstrapvalidator/css/bootstrapValidator.min.css" />
    <!--End of plugin styles-->
*/ ?>
<!--Plugin style-->
    <link type="text/css" rel="stylesheet" href="{{asset('/')}}admin/vendors/bootstrap-tagsinput/css/bootstrap-tagsinput.css"/>
    <link rel="stylesheet" type="text/css" href={{asset('/')}}admin/"vendors/animate/css/animate.min.css" />
    <!-- end of plugin styles -->
    <link type="text/css" rel="stylesheet" href="{{asset('/')}}admin/css/pages/portlet.css"/>
    <link type="text/css" rel="stylesheet" href="{{asset('/')}}admin/css/pages/advanced_components.css"/>

    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('/')}}admin/css/pages/tables.css" />

    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('/')}}admin/css/pages/form_validations.css" />
     <!-- end of page level styles -->


    <!--plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('/')}}admin/vendors/select2/css/select2.min.css" />
    <link type="text/css" rel="stylesheet" href="{{asset('/')}}admin/vendors/datatables/css/scroller.bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="{{asset('/')}}admin/vendors/datatables/css/colReorder.bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="{{asset('/')}}admin/vendors/datatables/css/dataTables.bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="{{asset('/')}}admin/css/pages/dataTables.bootstrap.css" />
    <!-- end of plugin styles -->
</head>
@extends('admin.master')

@section('title')
    Admin Panel | Manage Writer/Auther
@endsection

@section('body')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-sm-5 col-lg-6">
                    <h4 class="nav_top_align">
                        <i class="fa fa-pencil"></i>
                        Writers / Authers
                    </h4>
                </div>
                <div class="col-sm-7 col-lg-6">
                    <ol  class="breadcrumb float-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Writers</a>
                        </li>
                        <li class="active breadcrumb-item">Manage</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="row">
                <div class="col-12 data_tables">

                <div class="col-Select inputs12 data_tables">
                    <div class="card ">
                        <div class="card-header bg-white">
                            <i class="fa fa-table"></i> Manage Writers
                        </div>
                        <div class="card-body ">

                            <a class="btn btn-success adv_cust_mod_btn m-b-20" data-toggle="modal"
                               data-href="#responsive" href="#responsive">Add New Writer</a>
                            <table id="example2" class="display table table-stripped table-bordered">
                                <thead>
                                <tr>
                                    <th width="2%;">Sl.</th>
                                    <th width="10%;">Photo</th>
                                    <th width="15%;">Name Eng.</th>
                                    <th width="15%;">Name Bang.</th>
                                    <th width="15%;">SLUG URL</th>
                                    <th width="15%;">Phone</th>
                                    <th width="15%;">Email</th>
                                    <th width="10%;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i =1)
                                @foreach($data as $row)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td><img src="{{ URL::to('/') }}/uploads/writers/{{ $row->image }}" class="img-thumbnail" width="75" /></td>
                                        <td>{{ $row->title }}</td>
                                        <td>{{ $row->title_bang }}</td>
                                        <td>{{ $row->slug }}</td>
                                        <td>{{ $row->phone }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>
                                            <a href="{{route('crud.show', $row->id)}}" data-toggle="tooltip" data-placement="top" title="View User"><i class="fa fa-eye text-success"></i></a>&nbsp; &nbsp;
                                            <a href="{{route('crud.edit', $row->id)}}" class="edit" data-toggle="tooltip" data-placement="top" title="Edit" ><i class="fa fa-pencil text-warning"></i></a>&nbsp; &nbsp;
                                            <a href="#" id="{{$row->id}}" onclick="" class="deleteBtn hidden-xs hidden-sm" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash text-danger"></i></a>
                                            <form id="delWriterForm{{$row->id}}" action="{{route('del-writer')}}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{$row->id}}" name="id">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <script>
                                    $('.deleteBtn').click(function () {
                                        var writerID = $(this).attr('id');
                                        event.preventDefault();
                                        var check = confirm('Are you sure to delete this writer??');
                                        if(check){
                                            document.getElementById('delWriterForm'+writerID).submit();
                                        }

                                    });
                                </script>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Name Eng.</th>
                                        <th>Name Bang.</th>
                                        <th>SLUG URL</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            {!! $data->links() !!}
                        </div>
                    </div>
                </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->

    <!--- responsive model -->
    <div class="modal fade in display_none" id="responsive" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title text-white">Add New Writer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form  id="categoryForm" method="post" action="{{ route('crud.store') }}" enctype="multipart/form-data" name="categoryForm" class="form-horizontal">
                            <!-- <form id="categoryForm" action="" method="POST" name="categoryForm" class="form-horizontal"> -->
                                @csrf
                                <!--<input type="hidden" name="writer_id" id="writer_id"> -->

                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Writer Name (Eng.)*</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="validate[required] form-control" id="title" name="title" placeholder="Enter Name" value="" maxlength="200" required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="title_bang" class="col-sm-12 control-label">Writer Name (Bang.)*</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="validate[required] form-control" id="title_bang" name="title_bang" placeholder="বাংলা নাম" value="" maxlength="200" required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="col-sm-12 control-label">Contact Information</label>
                                    <div class="col-sm-6 fLeft">
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="" maxlength="50" >
                                    </div>
                                    <div class="col-sm-6  fLeft">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="" maxlength="150" >
                                    </div>
                                    <div class="lClear"></div>
                                </div>


                                <div class="form-group">
                                    <label for="phone" class="col-sm-12 control-label">Address</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="" maxlength="200" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="col-sm-12 control-label">Photo</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control" id="image" name="image" accept="image/*"  value="" maxlength="200" >
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Short Description</label>
                                    <div class="col-sm-12">
                                        <textarea id="detail_info" name="detail_info" required="" placeholder="Enter Details" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-offset-2 col-sm-10">
                                    <!--<button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                                    </button> -->
                                    <input type="submit" name="add" class="btn btn-primary input-lg" value="Add" />

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-light">Close</button>
                    <!--<button type="button" class="btn btn-success">Save changes</button> -->
                </div>
                <!-- end page level scripts -->
                @section('scripts')
                    <script>
                        // $(document).ready(function(){
                        //     $("#title").on('change', function() {
                        //         var value = $("#title").value;
                        //         //do your work here
                        //     })
                        // })



                        // $(document).ready(function() {
                        //     $("#title").blur(function(){
                        //         $('#slug').val($(this).val());
                        //     });
                        // });
                        // $(document).ready(function() {
                        //     $("#title").blur(function(){
                        //         var titleValue = $('#title').val();
                        //         alert (titleValue);
                        //         $('#slug').val($(this).val());
                        //         //$('#slug').val(titleValue.val());
                        //     });
                        // });

                        {{--$('#title').change(function(e) {--}}
                        {{--    $.get('{{ route('pages.check_slug') }}',--}}
                        {{--        { 'title': $(this).val() },--}}
                        {{--        function( data ) {--}}
                        {{--            $('#slug').val(data.slug);--}}
                        {{--        }--}}
                        {{--    );--}}
                        {{--});--}}

                    </script>
                @endsection
            </div>
        </div>
    </div>
    <!-- END modal-->



@endsection

<script type="text/javascript" src="{{asset('/')}}admin/js/components.js"></script>


<!--End of global scripts-->
<script type="text/javascript" src="{{asset('/')}}admin/js/pages/modals.js"></script>


