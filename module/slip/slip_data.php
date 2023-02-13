<?php require('module/slip/slip_act.php'); ?>

<!-- Content Header (Page header) -->

    <section class="content-header">

      <h1> <?php echo $title;?> <small><?php echo substr($tgl->tgl_indo($datemax), 3,20);?></small> </h1>

      <ol class="breadcrumb">

        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li class="active"><?php echo $title;?> <?php echo substr($tgl->tgl_indo($datemax), 3,20);?></li>

      </ol>

    </section>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css">
	<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>
<section class="content"> 

      <!-- Your Page Content Here -->
        <div class="row">

         <div class="col-xs-12">
		
			<table id="example55" class="stripe row-border order-column" style="width:100%">
			
				<thead>
					<tr>
						<th>First name</th>
						<th>Last name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Age</th>
						<th>Start date</th>
						<th>Salary</th>
						<th>Extn.</th>
						<th>E-mail</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Tiger</td>
						<td>Nixon</td>
						<td>System Architect</td>
						<td>Edinburgh</td>
						<td>61</td>
						<td>2011/04/25</td>
						<td>$320,800</td>
						<td>5421</td>
						<td>t.nixon@datatables.net</td>
					</tr>
					<tr>
						<td>Garrett</td>
						<td>Winters</td>
						<td>Accountant</td>
						<td>Tokyo</td>
						<td>63</td>
						<td>2011/07/25</td>
						<td>$170,750</td>
						<td>8422</td>
						<td>g.winters@datatables.net</td>
					</tr>
				</tbody>
			</table>
	    </div>
	  </div>
	</section>

	<style>
	/* Ensure that the demo table scrolls */
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 1300px;
        margin: 0 auto;
    }
	</style>
	<script>
		$(document).ready(function() {
			var table = $('#example55').DataTable( {
				scrollY:        "300px",
				scrollX:        true,
				scrollCollapse: true,
				paging:         false,
				fixedColumns:   {
					leftColumns: 1,
					rightColumns: 1
				}
			} );
		} );
	</script>