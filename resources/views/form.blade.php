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
		
		$('.js-search-people').click(function(){

			var search_value = $('#search-index').val();

			if (search_value != "") {

				$.ajax({
					url : '{{ $people_url }}' + search_value,
					success : function(responce){
						console.log(responce);

						$('#people-index').val(search_value);
          				$('#height').val(responce.height);
						$('#first-name').val(responce.name);
						$('#people-index').val(search_value);
						$('#film-url').val(responce.films.join(','));

          				$('#add-people-form').removeClass('hide-people');
					}
				});
			}
		});

		$(document).on('click', '.js-submit-people', function(){

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

				$.ajax({
					url : '{{ $film_url }}' + search_value,
					success : function(responce){

						console.log(responce);
						$('#film-index').val(search_value);
						$('#film-name').val(responce.title);
						$('#director').val(responce.director);
						$('#characters-url').val(responce.characters.join(','));

          				$('#add-film-form').removeClass('hide-film');
					}
				});
			}
		});


		$(document).on('click', '.js-submit-film', function(){

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

@endsection
