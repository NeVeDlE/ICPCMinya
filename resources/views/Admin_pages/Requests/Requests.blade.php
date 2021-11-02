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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!--Internal  Font Awesome -->
    <link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
    <!--Internal  treeview -->
    <link href="{{URL::asset('assets/plugins/treeview/treeview.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Requests</h4>
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
    @if (session()->has('Edit'))
        <script>
            window.onload = function () {
                notif({
                    msg: "{{session()->get('Edit') }}",
                    type: "success"
                })
            }
        </script>
    @endif
    @if (session()->has('Update'))
        <script>
            window.onload = function () {
                notif({
                    msg: "{{session()->get('Update') }}",
                    type: "success"
                })
            }
        </script>
    @endif
    @if (session()->has('Search'))
        <script>
            window.onload = function () {
                notif({
                    msg: "{{session()->get('Search') }}",
                    type: "success"
                })
            }
        </script>
    @endif
    @if (session()->has('Notify'))
        <script>
            window.onload = function () {
                notif({
                    msg: "{{session()->get('Notify') }}",
                    type: "success"
                })
            }
        </script>
    @endif
    @if (session()->has('Excel'))
        <script>
            window.onload = function () {
                notif({
                    msg: "{{session()->get('Excel') }}",
                    type: "success"
                })
            }
        </script>
    @endif
    <!-- row -->
    <div class="row">

        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Requests</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>

                </div>
                <div class="card-header pb-0">

                    <form action="{{route('Search')}}" method="get" autocomplete="off">
                        {{ csrf_field() }}

                        <div class="row">

                            <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                                <p class="mg-b-10">Choose Training</p><select class="form-control select2"
                                                                              name="training"
                                                                              required>
                                    <option value="{{ $trainID ?? 'Choose Training' }}" selected>
                                        {{ $training ?? 'Choose Training' }}
                                    </option>
                                    @foreach($trainings as $train)

                                        <option value="{{$train['id']}}">{{$train['name']}}</option>
                                    @endforeach

                                </select>
                            </div><!-- col-4 -->
                            <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="status">
                                <p class="mg-b-10">Choose Status</p><select class="form-control select2" name="type"
                                                                            required>
                                    <option value="{{ $type ?? 'Choose Status' }}" selected>
                                        @if(isset($type))
                                            @if($type==1)
                                                Accepted
                                            @elseif($type==2)
                                                Pending
                                            @elseif($type==3)
                                                Banned
                                            @else
                                                Choose Status
                                            @endif
                                        @else
                                            Choose Status
                                        @endif
                                    </option>

                                    <option value="1">Accepted</option>
                                    <option value="2">Pending</option>
                                    <option value="3">Banned</option>

                                </select>
                            </div><!-- col-4 -->


                        </div>
                        <br>

                        <div class="row" style="margin-bottom: 20px">
                            <div class="col-sm-1 col-md-1">
                                <button class="btn btn-primary btn-block" type="submit">Search</button>
                            </div>
                        </div>
                    </form>

                </div>
                @if(isset($requests))
                    @if(isset($trainID))
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">

                                    <a class="btn ripple btn-indigo btn-block btn-rounded" data-target="#modaldemo1"
                                       data-toggle="modal"
                                       href="">Accept all from Minya in this training</a>
                                </div>
                                <div class="col-3">

                                    <a class="btn ripple btn-info btn-block btn-rounded" data-target="#modaldemo4"
                                       data-toggle="modal"
                                       href="">Accept all requests in this training</a>
                                </div>
                                <div class="col-3">

                                    <a class="btn ripple btn-warning btn-block btn-rounded" data-target="#modaldemo5"
                                       data-toggle="modal"
                                       href="">Decline all requests in this training</a>
                                </div>
                                <div class="col-3">

                                    <a class="btn ripple btn-success btn-block btn-rounded"
                                       href="{{route('export')}}">Excel Sheet</a>
                                </div>

                            </div>
                            <div class="row" style="margin-top: 20px">
                                <div class="col-3">

                                    <a class="btn ripple btn-light btn-block btn-rounded"
                                       href="{{URL::route('Notify', [$trainID]) }}">Notify Accepted Students in this
                                        Training</a>
                                </div>
                                <div class="col-3">

                                    @if($status==1)
                                        <a class="btn ripple btn-success btn-block btn-rounded"
                                           href="{{URL::route('Status', [$trainID]) }}">Current Enrolling Status is
                                            ON</a>
                                    @else
                                        <a class="btn ripple btn-danger btn-block btn-rounded"
                                           href="{{URL::route('Status', [$trainID]) }}">Current Enrolling Status is
                                            OFF</a>
                                    @endif

                                </div>
                                <div class="col-3">
                                    <label for="" class="text-success">Requests From Minya in this Training
                                        = {{$minya}}</label>
                                    <br>
                                    <label for="" class="text-warning">Requests From Others in this Training
                                        = {{$other}}</label>

                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="example1" class="table text-md-nowrap">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">University</th>
                                <th class="border-bottom-0">Faculty</th>
                                <th class="border-bottom-0">Training</th>
                                <th class="border-bottom-0">Year</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Operations</th>

                            </tr>
                            </thead>
                            <tbody>
                            @php $i=1 @endphp

                            @foreach($requests as $request)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$request['name']}}</td>
                                    @if($request['university']==1)
                                        <td class="text-success">Minya</td>
                                    @else
                                        <td class="text-warning">Other</td>
                                    @endif

                                    @if($request['faculty']==1)
                                        <td class="text-success">Computers and Information</td>
                                    @elseif($request['faculty']==2)
                                        <td class="text-warning">Science</td>
                                    @elseif($request['faculty']==3)
                                        <td class="text-warning">Engineering</td>
                                    @elseif($request['faculty']==4)
                                        <td class="text-warning">Specific Education</td>
                                    @else
                                        <td class="text-warning">Other</td>
                                    @endif

                                    <td>{{$request->item->name}}</td>
                                    @if($request['year']==1)
                                        <td class="text-success">First</td>
                                    @elseif($request['year']==2)
                                        <td class="text-success">Second</td>
                                    @elseif($request['year']==3)
                                        <td class="text-warning">Third</td>
                                    @elseif($request['year']==4)
                                        <td class="text-warning">Fourth</td>
                                    @else
                                        <td class="text-danger">Fifth</td>
                                    @endif
                                    @if($request['status']==1)
                                        <td class="text-success">Accepted</td>
                                    @elseif($request['status']==2)
                                        <td class="text-warning">Pending</td>
                                    @else
                                        <td class="text-danger">Banned</td>
                                    @endif
                                    <td>
                                        @if($request['status']!=1)
                                            <a class="modal-effect btn-lg btn-success" data-effect="effect-scale"

                                               data-id="{{$request['id']}}"
                                               data-name="{{$request['name']}}"
                                               data-toggle="modal"
                                               href="#modaldemo2"
                                               title="accept"><i class="fa fa-check"></i></a>
                                        @endif
                                        @if($request['status']!=3)
                                            <a class="modal-effect btn-lg  btn-danger" data-effect="effect-scale"

                                               data-id="{{$request['id']}}" data-name="{{$request['name']}}"
                                               data-toggle="modal"
                                               href="#modaldemo3" title="delete"><i class="fa fa-times"></i></a>
                                        @endif</td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                        {{$requests->appends(['training'=>$trainID?? 'Choose Training', 'type'=>$type??'Choose Status'])->links('vendor.pagination.custom')}}

                    </div>
                @endif
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
                    <h6 class="modal-title">Accept all from Minya in this training</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="/requests/update" method="post" enctype="multipart/form-data">
                    @csrf
                    {{method_field('patch')}}

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">: Training's Name</label>
                            <input type="text" class="form-control" id="status" name="status" value="4" hidden>
                            <input type="text" class="form-control" id="id" name="id" value="{{$trainID??''}}" hidden>
                            <input type="text" class="form-control" id="name" name="name" value="{{$training??''}}"
                                   disabled>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-success" type="submit">Accept</button>
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
                    <h6 class="modal-title">Accept a Trainee</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="/requests/update" method="post" enctype="multipart/form-data" autocomplete="off">
                    {{method_field('patch')}}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="status" id="status" value="1">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="">: Trainee's Name</label>
                            <input type="text" class="form-control" id="name" name="name" disabled>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-success" type="submit">Accept</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end edit modal -->
    <!-- delete modal -->
    <div class="modal" id="modaldemo3">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Ban a Trainee</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="/requests/update" method="post" enctype="multipart/form-data" autocomplete="off">
                    {{method_field('patch')}}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="status" id="status" value="3">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="">: Trainee's Name</label>
                            <input type="text" class="form-control" id="name" name="name" disabled>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-danger" type="submit">Ban</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end delete modal -->

    <!-- Large Modal -->
    <div class="modal" id="modaldemo4">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Accept all requests in this training</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="/requests/update" method="post" enctype="multipart/form-data">
                    @csrf
                    {{method_field('patch')}}

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">: Training's Name</label>
                            <input type="text" class="form-control" id="status" name="status" value="5" hidden>
                            <input type="text" class="form-control" id="id" name="id" value="{{$trainID??''}}" hidden>
                            <input type="text" class="form-control" id="name" name="name" value="{{$training??''}}"
                                   disabled>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-success" type="submit">Accept All</button>
                        <button class="btn ripple btn-danger" data-dismiss="modal" type="button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--End Large Modal -->
    <!-- Large Modal -->
    <div class="modal" id="modaldemo5">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Decline all requests in this training</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="/requests/update" method="post" enctype="multipart/form-data">
                    @csrf
                    {{method_field('patch')}}

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">: Training's Name</label>
                            <input type="text" class="form-control" id="status" name="status" value="6" hidden>
                            <input type="text" class="form-control" id="id" name="id" value="{{$trainID??''}}" hidden>
                            <input type="text" class="form-control" id="name" name="name" value="{{$training??''}}"
                                   disabled>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-warning" type="submit">Decline All</button>
                        <button class="btn ripple btn-danger" data-dismiss="modal" type="button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--End Large Modal -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal Modal js-->
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
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
            var tag = button.data('tag')
            var mentor = button.data('mentor')

            var date = button.data('date')
            var description = button.data('description')
            var modal = $(this)

            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #date').val(date);
            modal.find('.modal-body #tag').val(tag);
            modal.find('.modal-body #mentor').val(mentor);
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
    <script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

@endsection
