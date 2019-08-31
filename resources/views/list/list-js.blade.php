<script type="text/javascript">
    	
	$(document).on('click', '.js-film-list', function(){

		var film_id = $(this).data('film-id');

		if (film_id != "") {

			addLoader();

			$.ajax({
				url : '{{ url("film/") }}/' + film_id,
				success : function(responce){
					$('.people ul').html(responce);
      				removeLoader();
      				$('#people-model').modal().show();
				}
			});
		}
	});

	$(document).on('click', '.js-people-list', function(){

		var people_id = $(this).data('people-id');

		if (people_id != "") {

			addLoader();

			$.ajax({
				url : '{{ url("people/") }}/' + people_id,
				success : function(responce){
					$('.film ul').html(responce);
      				removeLoader();
      				$('#film-model').modal().show();
				}
			});
		}
	});

</script>