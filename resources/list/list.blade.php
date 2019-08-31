@extends('layouts.index')

@section('extra-css')
	
	<link href="{{ asset('js/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('js/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('js/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('js/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('js/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

	<style type="text/css">
		
		.has-error {
			color: red;
		}

		.hide-people, .hide-film {
			display: none;
		}

	</style>

@endsection

@section('extra-js')

    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/datatables/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('js/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/datatables/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.scroller.min.js') }}"></script>
	
	<script type="text/javascript">
		
		var people_table = $('#datatable-people-list').DataTable({
            "lengthMenu": [[10, 40, 60, 80, 100], [10, 40, 60, 80, "All"]],
            "pagingType": "simple_numbers", 
            "length":20,
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :"{{ route('list-people') }}",
                data : {
                    '_token' : '{{ csrf_token() }}',
                },
                method : "POST",
            },
            "columnDefs" : [
                { "targets" : 'no-sort', "orderable" : false }
            ],
        });

        var film_table = $('#datatable-film-list').DataTable({
            "lengthMenu": [[10, 40, 60, 80, 100], [10, 40, 60, 80, "All"]],
            "pagingType": "simple_numbers", 
            "length":20,
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :"{{ route('list-film') }}",
                data : {
                    '_token' : '{{ csrf_token() }}',
                },
                method : "POST",
            },
            "columnDefs" : [
                { "targets" : 'no-sort', "orderable" : false }
            ],
        });

	</script>

@endsection

@section('content')
	
	<div class="row">
			
		<div class="col-md-12 col-sm-12 col-xs-12">
			
			<div class="x_panel">
		    	<div class="x_title">
		      		<h2>
						People List
		            </h2>
		            <div class="clearfix"></div>
		        </div>
		        <div class="x_content">

		        	@include('list.people-list')

		        </div>
		    </div>

		</div>

	</div>

	<div class="row">
			
		<div class="col-md-12 col-sm-12 col-xs-12">
			
			<div class="x_panel">
		    	<div class="x_title">
		      		<h2>
						People List
		            </h2>
		            <div class="clearfix"></div>
		        </div>
		        <div class="x_content">

		        	@include('list.film-list')

		        </div>
		    </div>

		</div>

	</div>

@endsection
