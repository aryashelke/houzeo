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

		.modal-header .close {
		    margin-top: -27px;
		}

		.modal-body ul {
			list-style: none;
		}

		.modal-body ul li {
			margin-left: -7%;
			margin-bottom: 2%;
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
    <script src="{{ asset('js/validate.js') }}"></script>

    @include('list.list-js')
	
	<script type="text/javascript">

		$('#add-people-form').validate({
			errorElement : 'span',
			errorClass : 'has-error',
			rules : {
				first_name : {
					required : true,
				},
				height : {
					required : true,
				},
			},
			messages : {
				first_name : {
					required : "Please enter the name",
				},
				height : {
					required : "Please enter the height",
				},
			},
		});


		$('#add-film-form').validate({
			errorElement : 'span',
			errorClass : 'has-error',
			rules : {
				film_name : {
					required : true,
				},
				director : {
					required : true,
				},
			},
			messages : {
				film_name : {
					required : "Please enter the name",
				},
				director : {
					required : "Please enter the director",
				},
			},
		});
		
		$('.js-search-people').click(function(){

			var search_value = $('#search-index').val();

			if (search_value != "") {

				addLoader();

				$.ajax({
					url : '{{ $people_url }}' + search_value,
					success : function(responce){

						$('#people-index').val(search_value);
          				$('#height').val(responce.height);
						$('#first-name').val(responce.name);
						$('#people-index').val(search_value);
						$('#film-url').val(responce.films.join(','));

          				$('#add-people-form').removeClass('hide-people');

          				removeLoader();
					},
					error: function(xhr, status, error) {
					  var err = JSON.parse(xhr.responseText);
					  removeLoader();
					  console.log(err.detail);
					  alert("No detail found");
					},
				});
			}else{
				alert("Please enter the people index");
			}
		});

		$(document).on('click', '.js-submit-people', function(){

			if (! $('#add-people-form').valid()) {
				return false;
			}

			addLoader();

			$.ajax({
				url: "{{ route('add-people') }}",
				type: "POST",
				headers: {
			           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				data: {
					'index' : $('#people-index').val(),
					'name' : $('#first-name').val(),
					'height' : $('#height').val(),
					'film' : $('#film-url').val(),
				},
				success: function(data){
					$('.js-cancel-people').click();

					removeLoader();

					people_table.ajax.reload();
					alert(data.message);
				}
			});
		});

		$('.js-cancel-people').click(function(){
			$('.js-reset-people').click();
			$('#add-people-form').addClass('hide-people');
		});


		$('.js-search-film').click(function(){

			var search_value = $('#search-film-index').val();

			if (search_value != "") {

				addLoader();

				$.ajax({
					url : '{{ $film_url }}' + search_value,
					success : function(responce){

						$('#film-index').val(search_value);
						$('#film-name').val(responce.title);
						$('#director').val(responce.director);
						$('#characters-url').val(responce.characters.join(','));

          				$('#add-film-form').removeClass('hide-film');

          				removeLoader();
					},
					error: function(xhr, status, error) {
					  var err = JSON.parse(xhr.responseText);
					  removeLoader();
					  console.log(err.detail);
					  alert("No detail found");
					},
				});
			}else{
				alert("Please enter the film index");
			}
		});


		$(document).on('click', '.js-submit-film', function(){

			if (! $('#add-film-form').valid()) {
				return false;
			}

			addLoader();

			$.ajax({
				url: "{{ route('add-film') }}",
				type: "POST",
				headers: {
			           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				data: {
					'characters' : $('#characters-url').val(),
					'director' : $('#director').val(),
					'index' : $('#film-index').val(),
					'name' : $('#film-name').val(),
				},
				success: function(responce){
					$('.js-cancel-film').click();

					removeLoader();
					
					film_table.ajax.reload();
					alert(responce.message);
				}
			});
		});

		$('.js-cancel-film').click(function(){
			$('.js-reset-film').click();
			$('#add-film-form').addClass('hide-film');
		});


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
	
	@include('forms.people-form')

	@include('forms.film-form')

	@include('list.view')

@endsection
