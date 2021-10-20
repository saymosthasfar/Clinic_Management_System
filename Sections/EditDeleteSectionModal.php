<!-- Delete -->
<div class="modal fade" id="del<?php echo $sections[$i]->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
				$action = $dbHnd->dbObject->prepare("SELECT * FROM sections WHERE id=?");
				$id = $sections[$i]->getId();
				$action->bind_param("s", $id);
				$action->execute();
				$result = $action->get_result();
				$row = $result->fetch_assoc();
				?>
				<div class="container-fluid">
					<h5>
						<center>Are you sure to delete <strong><?php echo $row['title']; ?></strong> from the list? This method cannot be undone.</center>
					</h5>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				<a href="Sections/DeleteSection.php?id=<?php echo $id; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
			</div>

		</div>
	</div>
</div>
<!-- /.modal -->

<!-- Edit -->
<div class="modal fade" id="edit<?php echo $sections[$i]->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
				$action = $dbHnd->dbObject->prepare("SELECT * FROM sections WHERE id=?");
				$id = $sections[$i]->getId();
				$action->bind_param("s", $id);
				$action->execute();
				$result = $action->get_result();
				$row = $result->fetch_assoc();
				?>
				<div class="container-fluid">
					<form method="POST" action="Sections/EditSection.php">
						<div class="row">
							<div class="col-lg-2">
								<label style="position:relative; top:7px;">Title:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>">
							</div>
						</div>
						<div style="height:10px;"></div>
						<div class="row">
							<div class="col-lg-2">
								<label style="position:relative; top:7px;">Active:</label>
							</div>
							<div class="col-lg-10">
								<input type="checkbox" name="active" class="form-control" <?php echo $row['is_active'] == "1" ? "checked" : ""; ?>>
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