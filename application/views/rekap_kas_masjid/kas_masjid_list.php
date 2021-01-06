<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php
                      $koneksi = new mysqli ("localhost","root","","kas_masjid");
                      $sql = $koneksi->query("SELECT SUM(masuk) as tot_masuk  from kas_masjid where jenis='Masuk'");
                      while ($data= $sql->fetch_assoc()) {
                        $masuk=$data['tot_masuk'];
                      }
                    ?>

                    <?php
                      $koneksi = new mysqli ("localhost","root","","kas_masjid");
                      $sql = $koneksi->query("SELECT SUM(keluar) as tot_keluar  from kas_masjid where jenis='Keluar'");
                      while ($data= $sql->fetch_assoc()) {
                        $keluar=$data['tot_keluar'];
                      }
                    ?>

                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5>
                            <i class="icon fa fa-info"></i> Saldo Kas Masjid</h5>
                        <h5>Pemasukan :
                            <?php
                      echo rupiah($masuk);
                      ?>
                        </h5>

                        <h5>Pengeluaran :
                            <?php
                        echo rupiah($keluar);
                        ?>
                        </h5>
                        <hr>

                        <h3>Saldo Akhir :
                            <?php
                        $saldo= $masuk-$keluar;
                        echo rupiah($saldo);
                        ?>
                        </h3>
                    </div>
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA KAS_MASJID</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;"'>
        <?php echo anchor(site_url('rekap_kas_masjid/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('rekap_kas_masjid/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('rekap_kas_masjid/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?></div>
            </div>
            <div class='col-md-3'>
            <form action="<?php echo site_url('rekap_kas_masjid/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('rekap_kas_masjid'); ?>" class="btn btn-sm btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-sm btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
            </div>
        
   
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                
            </div>
        </div>
        <div class="box-body" style="overflow-x: scroll; ">
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Tgl Km</th>
        <th>Sumber Kas Masuk</th>
        <th>Tujuan Pengeluaran Kas</th>
		<th>Keterangan</th>
		<th>Masuk</th>
		<th>Keluar</th>
		<th>Jenis</th>
		<th>Action</th>
            </tr><?php
            foreach ($rekap_kas_masjid_data as $rekap_kas_masjid)
            {
                ?>
                <tr>
			<td width="10px"><?php echo ++$start ?></td>
			<td><?php echo $rekap_kas_masjid->tgl_km ?></td>
            <td><?php echo $rekap_kas_masjid->nama_categori_sumber ?></td>
            <td><?php echo $rekap_kas_masjid->nama_categori_tujuan?></td>
			<td><?php echo $rekap_kas_masjid->uraian_km ?></td>
			<td><?php echo rupiah($rekap_kas_masjid->masuk)  ?></td>
			<td><?php echo rupiah($rekap_kas_masjid->keluar)  ?></td>
			<td><?php echo $rekap_kas_masjid->jenis ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('rekap_kas_masjid/read/'.$rekap_kas_masjid->id_km),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-success btn-sm"'); 
				echo '  '; 
				echo anchor(site_url('rekap_kas_masjid/update/'.$rekap_kas_masjid->id_km),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-primary btn-sm"'); 
				echo '  '; 
				echo anchor(site_url('rekap_kas_masjid/delete/'.$rekap_kas_masjid->id_km),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>