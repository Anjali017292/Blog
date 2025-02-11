<?php include "header.php";
$id=$_GET['id'];
if(empty($id))
{
	header("location:categories.php");
}
if(!$admin)
{
    header("location:index.php");
}

$sql="SELECT * FROM category WHERE cat_id='$id'";
$query=mysqli_query($config,$sql);
$row=mysqli_fetch_assoc($query);

?>
<div class="container">
	<h5 class="mb-2 text-gray-800">Categories </h5>
	<div class="row">
		<div class="col-xl-6 col-lg-5">
			<div class="card">
				<div class="card-header">
					<h6 class="font-weight-bold text-primary mt-2">Edit Category</h6>
					<div class="card-body">
						<form method="post" action="">
							<div class="mb-3">
								<input type="text" name="cat_name" placeholder="Category Name" class="form-control" required value="<?= $row['catname'];?>">
							</div>
							<div class="mb-3">
								<input type="submit" name="update_cat" value="Update" class="btn btn-primary">

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

if(isset($_POST['update_cat'])){
	$catname=mysqli_real_escape_string($config,$_POST['cat_name']);
	$sql2="UPDATE category SET catname='${catname}' WHERE cat_id='{$id}'";
	$update=mysqli_query($config,$sql2);
	if($update){
			$msg= ['Category has been updated successfully','alert-success'];
			$_SESSION['msg']=$msg;
		    header("location:categories.php");
		}else{
			$msg=['Failed,Please try again','alert-danger'];
			$_SESSION['msg']=$msg;
		    header("location:categories.php");
		}
}

?>