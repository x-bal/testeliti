<?php
$this->load->View('include/header.php');

if ($set == "list-test") {
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Test
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-book"></i> Test</a></li>
        <li class="active">List Test</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php echo "<br>";
              echo $this->session->flashdata('pesan'); ?>
              <a href="<?php base_url() ?>add_test"><button type="button" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-plus"></i> Tambah User Test</button></a>
              <br><br><br>
              <h1 class="box-title"></h1>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="t1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="text-align:center">No</th>
                    <th style="text-align:center">Nama</th>
                    <th style="text-align:center">Quiz</th>
                    <th style="text-align:center">Status Ujian</th>
                    <th style="text-align:center">Tanggal Selesai</th>
                    <th style="text-align:center">Skor</th>
                    <th style="text-align:center">Token</th>
                    <th style="text-align:center">#</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($datatest)) { ?>
                    <tr>
                      <td>Data tidak ditemukan</td>
                      <td>Data tidak ditemukan</td>
                      <td>Data tidak ditemukan</td>
                      <td>Data tidak ditemukan</td>
                      <td>Data tidak ditemukan</td>
                      <td>Data tidak ditemukan</td>
                      <td>Data tidak ditemukan</td>
                      <td>Data tidak ditemukan</td>
                    </tr>
                    <?php } else {
                    $no = 0;
                    foreach ($datatest as $row) {
                      if ($row->nama != "") {
                        $no++; ?>
                        <tr>
                          <td style="text-align:center"><?php echo $no; ?></td>
                          <td style="text-align:center"><?php echo $row->nama; ?></td>
                          <td style="text-align:center"><?php echo $this->db->get_where('quiz', ['id' => $row->id_quiz])->row()->nama_quiz ?></td>
                          <td style="text-align:center"><?php echo $row->status; ?></td>
                          <td style="text-align:center">
                            <?php
                            if ($row->tanggal_selesai > 0) {
                              echo date("H:i:s - d M Y", $row->tanggal_selesai);
                            }
                            ?>
                          </td>
                          <td style="text-align:center">
                            <?php
                            if ($row->tanggal_selesai > 0) {
                              echo '<a href="' . base_url() . 'ujian/hasiltest?token=' . $row->token . '" target="_blank" class="btn btn-success">Lihat Hasil</a>';
                            }
                            ?>
                          </td>
                          <td style="text-align:center"><?php echo $row->token; ?></td>
                          <td style="text-align:center">
                            <!-- <a href="<?= base_url() ?>admin/edit_rfid/<?= $row->id_rfid ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a> -->
                            <a href="<?= base_url() ?>admin/hapus_test/<?= $row->id_test ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
                          </td>
                        </tr>
                  <?php }
                    }
                  } ?>

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php
} else if ($set == "add-test") {
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah User Test
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-book"></i> Test</a></li>
        <li class="active">Tambah User Test</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php echo $this->session->flashdata('pesan'); ?>
              <h1 class="box-title"></h1>
            </div>
            <!-- /.box-header -->
            <form role="form" action="<?= base_url(); ?>admin/save_test" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                </div>
                <div class="form-group">
                  <label>Token</label>
                  <input type="text" name="token" class="form-control" placeholder="Token" required>
                </div>
                <div class="form-group">
                  <label for="quiz">Quiz</label>
                  <select name="quiz" id="quiz" class="form-control" required>
                    <option disabled selected>-- Pilih Quiz --</option>
                    <?php foreach ($quiz as $q) : ?>
                      <option value="<?= $q->id ?>"><?= $q->nama_quiz ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php
}

$this->load->view('include/footer.php');
?>

</div> <!-- penutup header -->

<!-- jQuery 3 -->
<script src="<?= base_url(); ?>components/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url(); ?>components/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>components/dist/js/adminlte.min.js"></script>

<!-- DataTables -->
<script src="<?= base_url(); ?>components/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>components/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- page script -->
<script>
  $(function() {
    $("#t1").DataTable();
  });
</script>

</body>

</html>