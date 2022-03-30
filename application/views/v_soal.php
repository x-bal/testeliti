<?php $this->load->View('include/header.php'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php if ($set == "add-soal") : ?>
        Tambah Soal
      <?php endif; ?>
      <?php if ($set == "edit-soal") : ?>
        Edit Soal
      <?php endif; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-file"></i> Soal</a></li>
      <li class="active">
        <?php if ($set == "add-soal") : ?>
          Tambah Soal
        <?php endif; ?>
        <?php if ($set == "edit-soal") : ?>
          Edit Soal
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
            <?php echo $this->session->flashdata('pesan'); ?>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <?php if ($set == "add-soal") : ?>
              <form action="<?= base_url(); ?>admin/save_add_soal" method="post">
                <input type="hidden" name="id_quiz" value="<?= $quiz_id ?>">
              <?php endif; ?>

              <?php if ($set == "edit-soal") : ?>
                <form action="<?= base_url(); ?>admin/save_edit_soal" method="post">
                  <input type="hidden" name="id" value="<?= $soal->id_soal ?>">
                  <input type="hidden" name="id_quiz" value="<?= $soal->id_quiz ?>">
                <?php endif; ?>

                <div class="form-group">
                  <label>
                    No Soal* <br>
                    <small>Mohon input no soal secara berurutan.</small>
                  </label>
                  <input type="number" maxlength="2" name="no_soal" id="no_soal" value="<?= $set == 'edit-soal' ? $soal->no_soal : set_value('no_soal') ?>" required class="form-control">
                </div>
                <div class="form-group">
                  <label>A</label>
                  <input type="text" maxlength="2" name="a" id="a" value="<?= $set == 'edit-soal' ? $soal->a : set_value('a') ?>" required oninput="this.value=this.value.replace(/[^0-9a-zA-Z]/g,'');" class="form-control">
                </div>
                <div class="form-group">
                  <label>B</label>
                  <input type="text" maxlength="2" name="b" id="b" value="<?= $set == 'edit-soal' ? $soal->b : set_value('b') ?>" required oninput="this.value=this.value.replace(/[^0-9a-zA-Z]/g,'');" class="form-control">
                </div>
                <div class="form-group">
                  <label>C</label>
                  <input type="text" maxlength="2" name="c" id="c" value="<?= $set == 'edit-soal' ? $soal->c : set_value('c') ?>" required oninput="this.value=this.value.replace(/[^0-9a-zA-Z]/g,'');" class="form-control">
                </div>
                <div class="form-group">
                  <label>D</label>
                  <input type="text" maxlength="2" name="d" id="d" value="<?= $set == 'edit-soal' ? $soal->d : set_value('d') ?>" required oninput="this.value=this.value.replace(/[^0-9a-zA-Z]/g,'');" class="form-control">
                </div>
                <div class="form-group">
                  <label>E</label>
                  <input type="text" maxlength="2" name="e" id="e" value="<?= $set == 'edit-soal' ? $soal->e : set_value('e') ?>" required class="form-control" required oninput="this.value=this.value.replace(/[^0-9a-zA-Z]/g,'');">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
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

    // $("#type").on('change', function() {
    //   let tipe = $(this).val();
    //   if (tipe == 'number') {
    //     $("#a").on('input', function() {
    //       if (!$(this).val().match(/^([0-9]){3,16}$/)) {
    //         alert('Not Match')
    //       }
    //     })
    //   }
    // })
  });
</script>

</body>

</html>