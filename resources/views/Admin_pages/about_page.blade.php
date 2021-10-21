@extends('layouts.master')
@section('css')
    <!---Internal Owl Carousel css-->
    <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">About Page</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ User Pages Controller</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session()->has('Edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session()->has('Delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- row -->
    <div class="row">

        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Members</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>

                </div>
                <div class="card-body">
                    <div class="col-3">

                        <a class="btn ripple btn-indigo btn-block btn-rounded" data-target="#modaldemo1"
                           data-toggle="modal"
                           href="">Add a Member</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table text-md-nowrap">
                        <thead>
                        <tr>
                            <th class="border-bottom-0">ID</th>
                            <th class="border-bottom-0">Name</th>
                            <th class="border-bottom-0">Job</th>
                            <th class="border-bottom-0">Description</th>
                            <th class="border-bottom-0">Operations</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)

                            <tr>
                                <td>{{$member['id']}}</td>
                                <td>{{$member['name']}}</td>
                                <td>{{$member['job']}}</td>
                                <td>{{$member['description']}}</td>
                                <td><a class="modal-effect btn-lg btn-info" data-effect="effect-scale"

                                       data-id="{{$member['id']}}" data-name="{{$member['name']}}" data-job="{{$member['job']}}"
                                       data-description="{{$member['description']}}" data-toggle="modal" href="#modaldemo2"
                                       title="edit"><i class="las la-pen"></i></a>

                                    <a class="modal-effect btn-lg  btn-danger" data-effect="effect-scale"

                                       data-id="{{$member['id']}}" data-name="{{$member['name']}}" data-toggle="modal"
                                       href="#modaldemo3" title="delete"><i class="las la-trash"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$members->links('vendor.pagination.custom')}}
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->

    <!-- Large Modal -->
    <div class="modal" id="modaldemo1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Adding a Member</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('aboutController.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">: Member's Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="">: Member's Job</label>
                            <input type="text" class="form-control" id="job" name="job" required>
                        </div>

                        <div class="form-group">
                            <label for="">: Member's Description</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>

                        <div class="form-group">
                            <label for="">: Upload the new Member's photo</label>
                            <input type="file" class="form-control" id="img" name="img" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-success" type="submit">Add Member</button>
                        <button class="btn ripple btn-danger" data-dismiss="modal" type="button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--End Large Modal -->
    <!-- edit modal -->
    <div class="modal" id="modaldemo2">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Member</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="/aboutController/update" method="post" enctype="multipart/form-data" autocomplete="off">
                    {{method_field('patch')}}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label>Member Name:</label>
                            <input type="text" class="form-control" id="name" name="name"  required>
                        </div>
                        <div class="form-group">
                            <label>Member Job:</label>
                            <input type="text" class="form-control" id="job" name="job" required>
                        </div>
                        <div class="form-group">
                            <label>Member Description:</label>
                            <input type="text" class="form-control" id="description" name="description"  required>
                        </div>

                        <div class="form-group">
                            <label>Member Photo:</label>
                            <input type="file" class="form-control"name="img" id="img">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-success" type="submit">Save changes</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end edit modal -->
    <!-- delete modal -->
    <div class="modal" id="modaldemo3">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Delete Member</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="/aboutController/destroy" method="post">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <p>?Are you sure about this</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="name" id="name" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Confirm</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- end delete modal -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal Modal js-->
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <script>
        $('#modaldemo2').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var job = button.data('job')
            var description = button.data('description')
            var modal = $(this)

            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #job').val(job);
            modal.find('.modal-body #description').val(description);
        });
    </script>
    <script>
        $('#modaldemo3').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
        });
    </script>
@endsection
