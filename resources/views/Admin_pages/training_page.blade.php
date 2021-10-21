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
                <h4 class="content-title mb-0 my-auto">Training Page</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ User Pages Controller</span>
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
    @if(session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
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
                        <h4 class="card-title mg-b-0">Trainings</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">

                            <a class="btn ripple btn-success btn-block btn-rounded" data-target="#modaldemo1"
                               data-toggle="modal"
                               href="">Add a Training</a>
                        </div>
                        <div class="col-3">

                            <a class="btn ripple btn-info btn-block btn-rounded" data-target="#modaldemo4"
                               data-toggle="modal"
                               href="">Add a Topic To Choose In Topics For Trainings</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table text-md-nowrap">
                        <thead>
                        <tr>
                            <th class="border-bottom-0">ID</th>
                            <th class="border-bottom-0">Name</th>
                            <th class="border-bottom-0">Tag</th>
                            <th class="border-bottom-0">Description</th>
                            <th class="border-bottom-0">Mentor</th>
                            <th class="border-bottom-0">Date</th>
                            <th class="border-bottom-0">Topics</th>
                            <th class="border-bottom-0">Operations</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($trainings as $training)
                            <tr>
                                <td>{{$training['id']}}</td>
                                <td>{{$training['name']}}</td>
                                <td>{{$training['tag']}}</td>
                                <td>{{$training['description']}}</td>
                                <td>{{$training->item->name}}</td>
                                <td>{{$training['date']}}</td>


                                <td> @foreach($training->topics as  $topic)
                                        <label class="badge badge-success">{{ $topic }}</label>



                                    @endforeach
                                </td>
                                <td><a class="modal-effect btn-lg btn-info" data-effect="effect-scale"

                                       data-id="{{$training['id']}}" data-name="{{$training['name']}}"
                                       data-tag="{{$training['tag']}}"
                                       data-description="{{$training['description']}}"
                                       data-mentor="{{$training->item->name}}"
                                       data-date="{{$training['date']}}"

                                       data-toggle="modal"
                                       href="#modaldemo2"
                                       title="edit"><i class="las la-pen"></i></a>

                                    <a class="modal-effect btn-lg  btn-danger" data-effect="effect-scale"

                                       data-id="{{$training['id']}}" data-name="{{$training['name']}}"
                                       data-toggle="modal"
                                       href="#modaldemo3" title="delete"><i class="las la-trash"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$trainings->appends(['topics'=>$topics,'members'=>$members])->links('vendor.pagination.custom')}}
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
                    <h6 class="modal-title">Adding a Training</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('trainingController.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">: Training's Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="">: Training's Tag</label>
                            <input type="text" class="form-control" id="tag" name="tag" required>

                        </div>

                        <div class="form-group">
                            <label for="">: Training's Description</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>

                        <div class="form-group">
                            <label for="">: Training's Mentor</label>
                            <select class="form-control select2 select2-dropdown--above" id="mentor" name="mentor"
                                    required>

                                @foreach($members as $member)
                                    <option value="{{$member['id']}}">{{$member['name']}}</option>
                                @endforeach

                            </select>
                            {{$members->appends(['topics'=>$topics->currentPage(),'trainings'=>$trainings->currentPage()])->links('vendor.pagination.custom')}}
                        </div>

                        <div class="form-group">
                            <label for="">: Training's Time In Format From -- To</label>
                            <input type="text" class="form-control" id="date" name="date" required>
                        </div>

                        <div class="form-group">
                            <label for="">: Training's Topics</label>
                            <select class="form-control multiple " multiple
                                    id="topics" name="topics[]" required>
                                @foreach($topics as $topic)
                                    <option value="{{$topic['name']}}">{{$topic['name']}}</option>
                                @endforeach
                            </select>
                            {{$topics->appends(['members'=>$members->currentPage(),'trainings'=>$trainings->currentPage()])->links('vendor.pagination.custom')}}
                        </div>

                        <div class="form-group">
                            <label for="">: Upload the new Training's photo</label>
                            <input type="file" class="form-control" id="img" name="img" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-success" type="submit">Add Training</button>
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
                    <h6 class="modal-title">Edit Training</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="/trainingController/update" method="post" enctype="multipart/form-data" autocomplete="off">
                    {{method_field('patch')}}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="">: Training's Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="">: Training's Tag</label>
                            <input type="text" class="form-control" id="tag" name="tag" required>
                        </div>

                        <div class="form-group">
                            <label for="">: Training's Description</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>

                        <div class="form-group">
                            <label for="">: Training's Topics</label>
                            <select class="form-control  multiple " multiple
                                    id="topics" name="topics[]" required>
                                @foreach($topics as $topic)
                                    <option value="{{$topic['name']}}">{{$topic['name']}}</option>
                                @endforeach
                            </select>
                            {{$topics->appends(['members'=>$members->currentPage(),'trainings'=>$trainings->currentPage()])->links('vendor.pagination.custom')}}
                        </div>

                        <div class="form-group">
                            <label for="">: Training's Time In Format From -- To</label>
                            <input type="text" class="form-control" id="date" name="date" required>
                        </div>

                        <div class="form-group">
                            <label for="">: Training's Mentor</label>
                            <select class="form-control " id="mentor" name="mentor"
                                    required>

                                @foreach($members as $member)
                                    <option value="{{$member['id']}}">{{$member['name']}}</option>
                                @endforeach
                            </select>
                            {{$members->appends(['topics'=>$topics->currentPage(),'trainings'=>$trainings->currentPage()])->links('vendor.pagination.custom')}}
                        </div>

                        <div class="form-group">
                            <label for="">: Upload the new Training's photo</label>
                            <input type="file" class="form-control" id="img" name="img">
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
                    <h6 class="modal-title">Delete Training</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="/trainingController/destroy" method="post">
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

    <!-- topic modal -->
    <div class="modal" id="modaldemo4">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Add Topic</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('topics.store')}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">

                        <input class="form-control" name="name" id="name" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Confirm</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- end topic modal -->
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
@endsection
