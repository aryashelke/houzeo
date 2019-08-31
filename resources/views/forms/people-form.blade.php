<div class="row">
		
	<div class="col-md-12 col-sm-12 col-xs-12">
		
		<div class="x_panel">
	    	<div class="x_title">
	      		<h2>
					Add People
	            </h2>
	            <div class="clearfix"></div>
	        </div>
	        <div class="x_content">
	        	
	        	<form id="search-people-form" data-parsley-validate class="form-horizontal form-label-left">

	        		<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">
							People Index <span class="has-error">*</span>
						</label>

						<div class="col-md-3 col-sm-3 col-xs-12">
							<input type="number" id="search-index" class="form-control col-md-7 col-xs-12">
						</div>

						<div class="col-md-3 col-sm-3 col-xs-12">
							<button type="button" class="btn btn-success js-search-people">Search</button>
						</div>

					</div>

	        	</form>

	        	<form id="add-people-form" data-parsley-validate class="form-horizontal form-label-left hide-people">
	        		<input type="hidden" name="index" id="people-index" value="">
	        		<div class="ln_solid"></div>
	        		
					<div class="form-group">

						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
							Name
						</label>

						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="hidden" name="film" value="" id="film-url">
							<input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
						</div>

					</div>

					<div class="form-group">

						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="height">
							Height
						</label>

						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="number" id="height" required="required" class="form-control col-md-7 col-xs-12">
						</div>

					</div>

					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<button type="button" class="btn btn-success js-submit-people">Submit</button>
							<button class="btn btn-primary js-reset-people" type="reset">Reset</button>
							<button class="btn btn-primary js-cancel-people" type="button">Cancel</button>
						</div>
					</div>

	        	</form>

	        	<div class="ln_solid"></div>

	        	@include('list.people-list')

	        </div>
	    </div>

	</div>

</div>