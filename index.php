<?php
include("views/header.php");
require("controller/csv.php");
$pdo=new DataMapper();
$hide="visibility: hidden";// button export default invisible
   if( isset($_POST['submit'])){
       import($_FILES['file']['name'],$pdo);
      $hide="";
    }
   if( isset($_POST['export'])){     
      export_report($pdo,$_FILES['file']['name']);    
    }
$pdo->closeConnection($pdo);

?>
<div class="container-xl">
<div class="pb-5">
	<div class="pb-5"></div>
</div>
	<div class="">
		<div class="">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h3>Create <b>Your Report !</b></h3>
					</div>
					<div class="col-lg-6 col-sm-6 col-12">
						<form method="post" enctype="multipart/form-data">
						    <div class="input-group ">
                               <label class="input-group-btn mr-3">
                                    <span class="btn btn-primary ">
                                        Browse File <input type="file" name ="file" style="display: none;">
                                    </span>
                                </label>
                                <label class="input-group-btn mr-3">
                                	
                                        <input class="btn btn-success" data-toggle="modal" type="submit" name="submit" value="Show my report">
                                    
                                </label>
                                <label class="input-group-btn mr-3">
                                	
                                        <input class="btn btn-info" data-toggle="modal"  type="submit" name="export" value="Export my report"  style="<?= $hide ?>">
                                     
                                </label>
                                <!-- Add Modal HTML -->
                                <!-- Add a row in the report is a plus for a future feature -->
                                <a href="#addEmployeeModal" class="add" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Add" style="<?= $hide ?>">&#xE254;</i></a>
                        </div>
                    </form>
						
		            
												
					</div>
				</div>
			</div>
			
			
		</div>
	</div>        

<!-- Add Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Add Category</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>category</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>price</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>amount</label>
						<input type="text" class="form-control" required>
					</div>
									
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>
</div>
<?php include("views/footer.php"); ?>