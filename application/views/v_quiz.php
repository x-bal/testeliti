<?php $this->load->View('include/header.php'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php if ($set == "list-quiz") : ?>
        Data Quiz
      <?php endif; ?>
      <?php if ($set == "add-quiz") : ?>
        Tambah Quiz
      <?php endif; ?>
      <?php if ($set == "edit-quiz") : ?>
        Edit Quiz
      <?php endif; ?>
      <?php if ($set == "show-quiz") : ?>
        Detail Quiz
      <?php endif; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-book"></i> Quiz</a></li>
      <li class="active">
        <?php if ($set == "list-quiz") : ?>
          List Quiz
        <?php endif; ?>
        <?php if ($set == "add-quiz") : ?>
          Tambah Quiz
        <?php endif; ?>
        <?php if ($set == "edit-quiz") : ?>
          Edit Quiz
        <?php endif; ?>
        <?php if ($set == "show-quiz") : ?>
          Detail Quiz
        <?php endif; ?>
      </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <?= $this->session->flashdata('pesan'); ?>

            <?php if ($set == "list-quiz") : ?>
              <a href="<?= base_url() ?>admin/add_quiz"><button type="button" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-plus"></i> Tambah Quiz</button></a>
              <br>
            <?php endif; ?>

            <?php if ($set == "show-quiz") : ?>
              <a href="<?= base_url('admin/add_soal/' . $quiz) ?>"><button type="button" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-plus"></i> Tambah Soal</button></a>
            <?php endif; ?>

          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <?php if ($set == "list-quiz") : ?>
              <div class="table-responsive">
                <table id="t1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="text-align:center">No</th>
                      <th style="text-align:center">Nama</th>
                      <th style="text-align:center">Jumlah Soal</th>
                      <th style="text-align:center">Menit Per Soal</th>
                      <th style="text-align:center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (empty($dataquiz)) { ?>
                      <tr>
                        <td>Data tidak ditemukan</td>
                        <td>Data tidak ditemukan</td>
                        <td>Data tidak ditemukan</td>
                        <td>Data tidak ditemukan</td>
                        <td>Data tidak ditemukan</td>
                      </tr>
                      <?php } else {
                      $no = 0;
                      foreach ($dataquiz as $row) {
                        if ($row->nama_quiz != "") {
                          $no++; ?>
                          <tr>
                            <td style="text-align:center"><?php echo $no; ?></td>
                            <td style="text-align:center"><?php echo $row->nama_quiz; ?></td>
                            <td style="text-align:center">
                              <?= $this->db->get_where('soal', ['id_quiz' => $row->id])->num_rows() ?>
                            </td>
                            <td style="text-align:center"><?php echo $row->minute; ?> Menit</td>
                            <td style="text-align:center">
                              <a href="<?= base_url() ?>admin/show_quiz/<?= $row->id ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                              <a href="<?= base_url() ?>admin/edit_quiz/<?= $row->id ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                              <a href="<?= base_url() ?>admin/hapus_quiz/<?= $row->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
                            </td>
                          </tr>
                    <?php }
                      }
                    } ?>

                  </tbody>
                </table>
              </div>
            <?php endif; ?>

            <?php if ($set == "add-quiz" || $set == "edit-quiz") : ?>
              <?php if ($set == "add-quiz") : ?>
                <form role="form" action="<?= base_url(); ?>admin/save_quiz" method="post">
                <?php endif; ?>
                <?php if ($set == "edit-quiz") : ?>
                  <form role="form" action="<?= base_url(); ?>admin/save_edit_quiz" method="post">
                    <input type="hidden" name="id" value="<?= $quiz->id ?>">
                  <?php endif; ?>
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama" required value="<?= $set == "edit-quiz" ? $quiz->nama_quiz : '' ?>">
                  </div>
                  <div class="form-group">
                    <label>Menit Per Soal</label>
                    <input type="number" name="minute" class="form-control" placeholder="minute" required value="<?= $set == "edit-quiz" ? $quiz->minute : '' ?>">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                  </form>
                <?php endif; ?>

                <?php if ($set == "show-quiz") : ?>
                  <div class="table-responsive">
                    <table id="t1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th style="text-align:center">Soal</th>
                          <th style="text-align:center">A</th>
                          <th style="text-align:center">B</th>
                          <th style="text-align:center">C</th>
                          <th style="text-align:center">D</th>
                          <th style="text-align:center">E</th>
                          <th style="text-align:center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (empty($datasoal)) { ?>
                          <tr>
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
                          foreach ($datasoal as $row) {
                            if ($row->id_soal != "") {
                              $no++; ?>
                              <tr>
                                <td style="text-align:center"><?= $no; ?></td>
                                <td style="text-align:center"><?= $row->a ?></td>
                                <td style="text-align:center"><?= $row->b ?></td>
                                <td style="text-align:center"><?= $row->c ?></td>
                                <td style="text-align:center"><?= $row->d ?></td>
                                <td style="text-align:center"><?= $row->e ?></td>
                                <td style="text-align:center">
                                  <a href="<?= base_url() ?>admin/edit_soal/<?= $row->id_soal ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                                  <a href="<?= base_url() ?>admin/delete_soal/<?= $row->id_soal . '/' . $row->id_quiz ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
                                </td>
                              </tr>
                        <?php }
                          }
                        } ?>

                      </tbody>
                    </table>
                  </div>
                <?php endif; ?>
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

<?php $this->load->view('include/footer.php'); ?>

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