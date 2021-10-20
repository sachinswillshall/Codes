@extends('layouts.app', ['pageSlug' => 'inactive-projects'])

@section('content')
    <?php /* $status = array(
        '1' => 'Active',
        '2' => 'Completed',
        '3' => 'On-hold',
        '4' => 'Canceled',
        '5' => 'Dispute'
    ); */ ?>
	<?php //echo '<pre>';print_r($projects);echo'</pre>';die; ?>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif


<div class="main_listing_projects1">
        <div class=""><h2>Inactive Projects</h2></div>
        <div class="row projects_departments">
            <div class="form-group col-md-3">
                <div class="controls">
                    <select id="project_status" class="form-control" name="status">
                        <option value="" selected="selected">Status</option>
                        <option value="2">Completed</option>
                        <option value="3">Paused</option>
                        <option value="4">Canceled</option>
                       <!--  <option value="4">Inactive</option> -->
                    </select>
                </div>
            </div>
        </div>

       
		
		<div class="table-res-mobile">
    	<table class="table table-striped table-bordered table-hover new-bullet-class" id="project_list">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th class="inactve-project">Project Name</th>
                    <th>Department</th>
                    <th>Start Date</th>
                    <th class="text-center">Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
		</div>
		
	<div class="card-footer p-0 card-footer card-foote22 py-2">
       <a class="btn  btn-primary1" href="{{ url('/home') }}" class="btn">Back</a>
      <!--  <a href="{{ url('/add-project') }} " class="btn btn-sm btn-primary">Add Project</a> -->
       <div class="ctm-projects-counts">
           <div class="ctm-projects-counts-inner">
               <strong>Design: </strong>{{$designProjects}}
           </div>
           <div class="ctm-projects-counts-inner">
               <strong>Development: </strong>{{$devProjects}}
           </div>
           <div class="ctm-projects-counts-inner">
               <strong>SEO: </strong>{{$seoProjects}}
           </div>
       </div>
    </div>
    </div>

	<!-- <div>
		<h1>No projects to display</h1>
	</div> -->
@endsection

@push('js')
	<script src="{{{ URL::asset('datatable/datatables.min.js')}}}"></script>
	<script type="text/javascript">
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
		   	$('#project_list').DataTable({
                processing: true,
                serverSide: true,
				pageLength: 25,
                ajax: {
                    url: "{{ url('projects-inactive-list') }}",
                    type: 'GET',
                    data: function (d) {
                        // d.start_date = $('#start_date').val();
                        // d.end_date = $('#end_date').val();
                        // d.department = $("#department_id").children("option:selected").val();
                        d.status = $("#project_status").children("option:selected").val();
                        // d.inactive = $("#inactive_30").children("option:selected").val();
                        // d.salesExecutive = $("#salesExecutive").children("option:selected").val();
                        // d.employees = $("#employees").children("option:selected").val();    
                       
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'project_title', name: 'project_title', orderable: false },
                    { data: 'department', name: 'departments.department', orderable: false },
                    { data: 'start_date', name: 'start_date', orderable: false },
                    { data: 'status', name: 'status', orderable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
		});
        // $('#btnFiterSubmitSearch').click(function(){
        //     $('#project_list').DataTable().draw(true);
        // });
        $("#project_status").on("change",function(e){
            $('#project_list').DataTable().draw(true);
        });
	</script>
@endpush