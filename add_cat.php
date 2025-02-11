<?php include "header.php";
if(!$admin)
{
    header("location:index.php");
}
?>
<div class="container">
	<h5 class="mb-2 text-gray-800">Categories </h5>
	<div class="row">
		<div class="col-xl-6 col-lg-5">
			<div class="card">
				<div class="card-header">
					<h6 class="font-weight-bold text-primary mt-2">Add Category</h6>
					<div class="card-body">
						<form method="post" action="">
							<div class="mb-3">
								<input type="text" name="cat_name" placeholder="Category Name" class="form-control" required>
							</div>
							<div class="mb-3">
								<input type="submit" name="add_cat" value="Add" class="btn btn-primary">

								<a href="categories.php" class="btn btn-secondary">Back</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
include "footer.php";

if(isset($_POST['add_cat'])){
	$catname=mysqli_real_escape_string($config,$_POST['cat_name']);
	$sql="SELECT * FROM category WHERE catname='{$catname}'";
	$query=mysqli_query($config,$sql);
	$row=mysqli_num_rows($query);
	if($row){
		$msg= ['category name already exist','alert-danger'];
		$_SESSION['msg']=$msg;
		header("location:add_cat.php");
	}
	else
	{
		$sql2="INSERT INTO category (catname) VALUES ('$catname')";
		$query2=mysqli_query($config,$sql2);
		if($query2){
			$msg= ['Category has been added successfully','alert-success'];
			$_SESSION['msg']=$msg;
		    header("location:add_cat.php");
		}else{
			$msg=['Failed,Please try again','alert-danger'];
			$_SESSION['msg']=$msg;
		    header("location:add_cat.php");
		}
	}
}







?>