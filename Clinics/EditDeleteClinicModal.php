<!-- Delete -->
<div class="modal fade" id="del<?php echo $clinics[$i]->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center>
					<h4 class="modal-title" id="myModalLabel">Delete</h4>
				</center>
			</div>
			<div class="modal-body">
				<?php
				$action = $dbHnd->dbObject->prepare("SELECT * FROM clinics WHERE id=?");
				$id = $clinics[$i]->getId();
				$action->bind_param("s", $id);
				$action->execute();
				$result = $action->get_result();
				$row = $result->fetch_assoc();
				?>
				<div class="container-fluid">
					<h5>
						<center>Are you sure to delete <strong><?php echo $row['name']; ?></strong> from the list? This method cannot be undone.</center>
					</h5>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				<a href="Clinics/DeleteClinic.php?id=<?php echo $id; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
			</div>

		</div>
	</div>
</div>
<!-- /.modal -->

<!-- Edit -->
<div class="modal fade" id="edit<?php echo $clinics[$i]->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center>
					<h4 class="modal-title" id="myModalLabel">Edit</h4>
				</center>
			</div>
			<div class="modal-body">
				<?php
				$action = $dbHnd->dbObject->prepare("SELECT * FROM clinics WHERE id=?");
				$id = $clinics[$i]->getId();
				$action->bind_param("s", $id);
				$action->execute();
				$result = $action->get_result();
				$row = $result->fetch_assoc();
				?>
				<div class="container-fluid">
					<form method="POST" action="Clinics/EditClinic.php">
						<div class="row">
							<div class="col-lg-2">
								<label style="position:relative; top:7px;">Name:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>">
							</div>
						</div>
						<div style="height:10px;"></div>
						<div class="row">
							<div class="col-lg-2">
								<label style="position:relative; top:7px;">Address:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>">
							</div>
						</div>
						<div style="height:10px;"></div>
						<div class="row">
							<div class="col-lg-2">
								<label style="position:relative; top:7px;">Phone:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>">
							</div>
						</div>
						<div style="height:10px;"></div>
						<div class="row">
							<div class="col-lg-2">
								<label style="position:relative; top:7px;">Fulltime:</label>
							</div>
							<div class="col-lg-10">
								<input type="checkbox" name="fulltime" class="form-control" <?php echo $row['is_full_time'] == "1" ? "checked" : ""; ?>>
							</div>
						</div>
						<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
							<button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-check"></span> Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.modal -->