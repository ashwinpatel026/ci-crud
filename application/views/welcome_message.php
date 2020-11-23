 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <?php echo link_tag('assests/vendor/bootstrap/css/bootstrap.min.css'); ?>
    <?php echo link_tag('assests/vendor/fontawesome-free/css/all.min.css'); ?>
    <?php echo link_tag('assests/css/sb-admin.css'); ?>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	
	 <script type="text/javascript">
 	$(document).ready(function() {
    $('#example').DataTable();
} );
 </script>
 </head>
 <body>
 	
<!---- Success Message ---->
<?php if ($this->session->flashdata('success')) { ?>
<p style="color:green; font-size:18px;"><?php echo $this->session->flashdata('success'); ?></p>
</div>
<?php } ?>

 	<br>
 	<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <td colspan="8" align="center"><h3>Display Records</h3></td>
            </tr>
            <tr>
                <td colspan="8" align="left"><a href="<?= site_url('welcome/add_data') ?>"><button type="submit" class="btn btn-primary">Add Record</button></a></td>
            </tr>
            <tr>
                <th>Name</th>
 		        <th>Email</th>
         		<th>Gender</th>
         		<th>Hobby</th>
         		<th>City</th>
         		<th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($all as $value) 
 	 	{
            //print_r(site_url());
        ?>  
            <tr id="<?= $value['id']?>">
                <td><?=$value['name']?></td>
         		<td><?=$value['email']?></td>
         		<td><?=$value['gender']?></td>
         		<td><?=$value['hobby']?></td>
         		<td><?=$value['city']?></td>
         		<td>
 
                    <a href="<?= site_url('welcome/edit_data/').$value['id']?>" class="btn btn-primary a-btn-slide-text">Edit</a> &nbsp;&nbsp;&nbsp;
         			<button type="submit" class="btn btn-danger remove"> Delete</button>
         		</td>
 
            </tr>
        <?php
        }
        ?>    
             
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
		 		<th>Email</th>
		 		<th>Gender</th>
		 		<th>Hobby</th>
		 		<th>City</th>
		 		<th>Action</th>
                 
            </tr>
        </tfoot>
    </table>
        </div>
    </div>
</div>
<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
<link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />
<script type="text/javascript">
    $(".remove").click(function(){
        var id = $(this).parents("tr").attr("id");
    
       swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
             url: 'welcome/delete_data/'+id,
             type: 'POST',
             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {
                  $("#"+id).remove();
                  swal("Deleted!", "Your imaginary file has been deleted.", "success");
             }
          });
        } else {
          swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
      });
     
    });
    
</script>
 </body>
 </html>

