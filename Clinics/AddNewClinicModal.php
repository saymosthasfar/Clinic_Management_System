<!-- Add New -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center>
					<h4 class="modal-title" id="myModalLabel">Add New</h4>
				</center>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<form method="POST" action="Clinics/AddNewClinic.php">
						<div class="row">
							<div class="col-lg-2">
								<label class="control-label" style="position:relative; top:7px;">Name: </label>
							</div>
							<div class="col-lg-10">
								<input type="text" class="form-control" name="name">
							</div>
						</div>
						<div style="height:10px;"></div>
						<div class="row">
							<div class="col-lg-2">
								<label class="control-label" style="position:relative; top:7px;">Address: </label>
							</div>
							<div class="col-lg-10">
								<input type="text" class="form-control" name="address">
							</div>
						</div>
						<div style="height:10px;"></div>
						<div class="row">
							<div class="col-lg-2">
								<label class="control-label" style="position:relative; top:7px;">Phone: </label>
							</div>
							<div class="col-lg-10">
								<input type="text" class="form-control" name="phone">
							</div>
						</div>
						<div style="height:10px;"></div>
						<div class="row">
							<div class="col-lg-2">
								<label class="control-label" style="position:relative; top:7px;">Fulltime: </label>
							</div>
							<div class="col-lg-10">
								<input type="checkbox" class="form-control" name="fulltime">
							</div>
						</div>
						<div class="modal-footer">
							<button id="cancelBtn" type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
							<button id="saveBtn" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>