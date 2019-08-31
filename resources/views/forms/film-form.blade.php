<div class="row">
		
	<div class="col-md-12 col-sm-12 col-xs-12">
		
		<div class="x_panel">
	    	<div class="x_title">
	      		<h2>
					Add Film
	            </h2>
	            <div class="clearfix"></div>
	        </div>
	        <div class="x_content">
	        	
	        	<form id="search-film-form" data-parsley-validate class="form-horizontal form-label-left">

	        		<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">
							Film Index <span class="has-error">*</span>
						</label>

						<div class="col-md-3 col-sm-3 col-xs-12">
							<input type="number" id="search-film-index" class="form-control col-md-7 col-xs-12">
						</div>

						<div class="col-md-3 col-sm-3 col-xs-12">
							<button type="button" class="btn btn-success js-search-film">Search</button>
						</div>

					</div>

	        	</form>

	        	<form id="add-film-form" data-parsley-validate class="form-horizontal form-label-left hide-film">

	        		<div class="ln_solid"></div>
	        		
					<div class="form-group">

						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
							Name
						</label>

						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="hidden" name="index" id="film-index" value="">
							<input type="hidden" name="characters" value="" id="characters-url">
							<input type="text" id="film-name" name="film_name" required="required" class="form-control col-md-7 col-xs-12">
						</div>

					</div>

					<div class="form-group">

						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="height">
							Director
						</label>

						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="director" id="director" required="required" class="form-control col-md-7 col-xs-12">
						</div>

					</div>

					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<button type="button" class="btn btn-success js-submit-film">Submit</button>
							<button class="btn btn-primary js-reset-film" type="reset">Reset</button>
							<button class="btn btn-primary js-cancel-film" type="button">Cancel</button>
						</div>
					</div>

	        	</form>

	        	<div class="ln_solid"></div>

	        	@include('list.film-list')

	        </div>
	    </div>

	</div>

</div>