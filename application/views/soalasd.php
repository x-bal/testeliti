<div class="table-responsive">
    <table id="t1x" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th style="text-align:center">Soal</th>
                <th style="text-align:center">A</th>
                <th style="text-align:center">B</th>
                <th style="text-align:center">C</th>
                <th style="text-align:center">D</th>
                <th style="text-align:center">E</th>
                <th style="text-align:center">#</th>
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
                    $no++; ?>
                    <tr>
                        <td style="text-align:center"><b class="text-danger"><?php echo $row->id_soal; ?></b></td>
                        <td style="text-align:center"><?php echo $row->a; ?></td>
                        <td style="text-align:center"><?php echo $row->b; ?></td>
                        <td style="text-align:center"><?php echo $row->c; ?></td>
                        <td style="text-align:center"><?php echo $row->d; ?></td>
                        <td style="text-align:center"><?php echo $row->e; ?></td>
                        <td style="text-align:center">
                            <a href="<?= base_url() ?>admin/edit_soal/<?= $row->id_soal ?>" class="btn btn-info btn-sm" title="rubah nama"><i class="glyphicon glyphicon-pencil"></i></a>
                            <!-- <a href="<?php site_url() ?>/admin/hapus_devices/<?= $row->id_devices ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a> -->
                        </td>
                    </tr>
            <?php }
            } ?>

        </tbody>
    </table>
</div>