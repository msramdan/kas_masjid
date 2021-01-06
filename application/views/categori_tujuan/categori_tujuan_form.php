<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA CATEGORI_TUJUAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Categori Tujuan <?php echo form_error('nama_categori_tujuan') ?></td><td><input type="text" class="form-control" name="nama_categori_tujuan" id="nama_categori_tujuan" placeholder="Nama Categori Tujuan" value="<?php echo $nama_categori_tujuan; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="categori_tujuan_id" value="<?php echo $categori_tujuan_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('categori_tujuan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>