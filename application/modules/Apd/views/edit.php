<style type="text/css">
#image {
	width: 100%;
    height: 200px;
    overflow: hidden;
    cursor: pointer;
    background: #fff;
    color: #ddd;
    text-align: center;
    border: 2px dashed #ddd;
}
#image img {
	visibility: hiddenn;
}
</style>

<script type="text/javascript">
function openKCFinder(div) {
	window.KCFinder = {
		callBack: function(url) {
			window.KCFinder = null;
			div.innerHTML = '<div style="margin:5px">Loading...</div>';
			var img = new Image();
			img.src = url;
			img.onload = function() {
				div.innerHTML = '<img id="img" src="' + url + '" /><input type="hidden" name="foto" value="'+url+'">';
				var img = document.getElementById('img');
				var o_w = img.offsetWidth;
				var o_h = img.offsetHeight;
				var f_w = div.offsetWidth;
				var f_h = div.offsetHeight;
				if ((o_w > f_w) || (o_h > f_h)) {
					if ((f_w / f_h) > (o_w / o_h))
						f_w = parseInt((o_w * f_h) / o_h);
					else if ((f_w / f_h) < (o_w / o_h))
						f_h = parseInt((o_h * f_w) / o_w);
					img.style.width = f_w + "px";
					img.style.height = f_h + "px";
				} else {
					f_w = o_w;
					f_h = o_h;
				}
				// img.style.marginLeft = parseInt((div.offsetWidth - f_w) / 2) + 'px';
				img.style.marginTop = parseInt((div.offsetHeight - f_h) / 2) + 'px';
				img.style.visibility = "visible";
			}
		}
	};
	window.open('<?php echo base_url('assets'); ?>/kcfinder/browse.php?type=files&dir=images/public',
		'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
		'directories=0, resizable=1, scrollbars=0, width=800, height=600'
	);
}
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo $judul; ?> <small style="font-size: 12px;">Edit</small></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo site_url('Dashboard'); ?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo site_url($url); ?>"><?php echo $judul; ?></a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Data <?php echo $judul; ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form role="form" method="POST" action="<?php echo site_url($url.'/update'); ?>">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Jenis APD</label>
                <input type="hidden" name="id" value="<?php echo $data->id; ?>" class="form-control">
                <input name="nama_apd" class="form-control" value="<?php echo $data->nama_apd; ?>" placeholder="Jenis APD" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Satuan</label>
                <input name="satuan" class="form-control" value="<?php echo $data->satuan; ?>" placeholder="Satuan" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Gambar</label>
                <div id="image" onclick="openKCFinder(this)">
                  <?php
                    if($data->foto == null) {
                  ?>
                  <div style="margin:90px;">
                    <input type="hidden" name="foto" value="">Click here to choose an image
                  </div>
                  <?php
                    } else {
                  ?>
                  <img src="<?php echo $data->foto; ?>" style="height: 200px;">
                  <div style="margin:60px;">
                      <input type="hidden" name="foto" value="<?php echo $data->foto; ?>">
                    </div>
                  <?php
                    }
                  ?>
                </div>

              </div>
              <div class="form-group">
        			  <label for="exampleInputEmail1">Status</label>
        			  <select name="status" class="form-control" required>
        				<option value="">-</option>
        				<option <?php echo $data->status=="1"?"selected":""; ?> value="1">Aktif</option>
        				<option <?php echo $data->status=="0"?"selected":""; ?> value="0">Tidak Aktif</option>
        			  </select>
        			</div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <a href="<?php echo site_url($url); ?>" class="btn btn btn-danger">
        			  <i class="fa fa-angle-double-left"></i> Back</a>
      			  <button type="submit" class="btn btn-primary">Simpan</button>
      			  <button type="reset" class="btn btn-warning">Batal</button>
            </div>
          </form>

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
