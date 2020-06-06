<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo $judul; ?></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo site_url('Dashboard'); ?>">Home</a></li>
          <li class="breadcrumb-item active"><?php echo $judul; ?></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <table id="myTable" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="2%">NO.</th>
              <th>Nama</th>
              <th>Jenis Kelamin</th>
              <th>Provinsi</th>
              <th>Kabupaten</th>
              <th>Kecamatan</th>
              <th>Unit Kerja</th>
              <th>Status</th>
              <th>#</th>
            </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach($data as $row) {
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row->nama; ?></td>
                <td><?php echo $row->jenis_kelamin; ?></td>
                <td><?php echo $row->nama_prov; ?></td>
                <td><?php echo $row->nama_kab; ?></td>
                <td><?php echo $row->nama_kec; ?></td>
                <td><?php echo $row->unit_kerja; ?></td>
                <td><?php echo $row->status==0?"Belum Aktif":"Aktif"; ?></td>
                <td>
                  <a href="<?php echo site_url($this->url.'/verifikasi/'.$row->id); ?>" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-info btn-xs update">Verifikasi</a>
         	        <a href="<?php echo site_url($this->url.'/hapus/'.$row->id); ?>" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-danger btn-xs delete">Delete</a>
                </td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->


    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

<?php
	echo $this->session->flashdata('notif');
	echo $this->session->flashdata('audio');
?>
<script>
$(document).ready(function(){
  var dataTable = $('#user_data').DataTable({
       "processing":true,
       "serverSide":true,
       "searching": false,
       "order":[],
       "ajax":{
            url:"<?php echo site_url($url.'/get_data'); ?>",
            type:"POST"
       },
       "columnDefs":[
            {
                 "targets":[0, 1, 2,3],
                 "orderable":false,
            },
       ],
  });

    $('#myTable').DataTable({
      "searching": false
    });
    $("#tangkis").change(function() {
		var id = $("#tangkis").val();
		// return alert(id);

		$.ajax({

			url : '<?php echo site_url($url."/get_nozzel"); ?>',
            data : 'id=' + id,
            type : 'get',
            success : function(result) {
                $("#nozzel").html(result);

            }

		});

	});
});
</script>
