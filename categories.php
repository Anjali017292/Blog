<?php
include('header.php');
if(!$admin)
{
    header("location:index.php");
}
// Pagination
if(!isset($_GET['page'])){
    $page = 1;
} else {
    $page = intval($_GET['page']);
}
$limit = 5;
$offset = ($page - 1) * $limit;
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h5 class="mb-2 text-gray-800">Categories </h5> <!-- DataTales Example -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between">
            <div> <a href="add_cat.php">
                    <h6 class="font-weight-bold text-primary mt-2">Add New</h6>
                </a> </div>
            <div>
                <form class="navbar-search">
                    <div class="input-group"> <input type="text" class="form-control bg-white border-0 small" placeholder="Search for...">
                        <div class="input-group-append"> <button class="btn btn-primary" type="button"> <i class="fa fa-search "></i> </button> </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Category Name</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                        $sql="SELECT * FROM category limit $offset,$limit";
                        $query=mysqli_query($config,$sql);
                        $rows=mysqli_num_rows($query);
                        
                        if($rows){
                            while($row=mysqli_fetch_assoc($query)){
                                ?>
                                <tr>
                                    <td><?= ++$offset ?></td>
                                    <td><?= $row['catname'] ?></td>
                                    <td>
                                        <a href="edit_category.php?id=<?= $row['cat_id'] ?>" class="btn btn-sm btn-success">Edit</a>
                                    </td>
                                    <td>
                                        <form method="post" action="" onsubmit="return confirm('Are you sure you want to delete?')">
                                            <input type="hidden" name="catID" value="<?= $row['cat_id']?>">
                                            <input type="submit" name="deletecat" value="delete" class="btn btn-sm btn-danger">
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <tr>
                            <td colspan="4"> NO Record Found</td>
                            </tr>
                            <?php  
                        }
                        ?>
                    </tbody>
                </table>
                <! _ _ _ _ _ _ _ pagination >

        <?php
        $pagination = "SELECT * FROM category";
        $run_q = mysqli_query($config, $pagination);
        $total_post = mysqli_num_rows($run_q);
        $total_pages = ceil($total_post / $limit);
        if($total_post>$limit){
        ?>
        <ul class="pagination pt-2 pb-5">
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <li class="page-item <?= ($i==$page)? $active="active":"";?>">
                <a href="categories.php?page=<?= $i ?>" class="page-link"><?= $i ?></a>
            </li>
        <?php } ?>
        </ul>
      <?php } ?>
        <!---------------->
            </div>
        </div>
    </div>
</div> <!-- /.container-fluid -->
</div>
<?php
include('footer.php');
if(isset($_POST['deletecat'])){
    $id=$_POST['catID'];
    $delete="DELETE FROM category WHERE cat_id='$id'";
    $run=mysqli_query($config,$delete);
    if($run){
                $msg= ['category has been deleted successfully','alert-success'];
                $_SESSION['msg']=$msg;
                header("location:categories.php");

    }
    else
    {
        $msg=['Failed,Please try again','alert-danger'];
        $_SESSION['msg']=$msg;
        header("location:categories.php");
    }
}
?>