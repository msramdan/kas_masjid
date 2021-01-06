<?php
$koneksi = new mysqli ("localhost","root","","kas_masjid");
  $sql = $koneksi->query("SELECT SUM(masuk) as tot_masuk  from kas_masjid where jenis='Masuk'");
  while ($data= $sql->fetch_assoc()) {
    $masuk=$data['tot_masuk'];
  }
  $koneksi = new mysqli ("localhost","root","","kas_masjid");
  $sql = $koneksi->query("SELECT SUM(keluar) as tot_keluar  from kas_masjid where jenis='Keluar'");
  while ($data= $sql->fetch_assoc()) {
    $keluar=$data['tot_keluar'];
  }

  $saldo= $masuk-$keluar;
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Laporan Kas Masjid</title>
</head>
<body>
<center>
<h2>Laporan Rekapitulasi Kas Masjid</h2>
<h3>Masjid Mandiri Syariah Cipularang KM88A</h3>
<p>________________________________________________________________________</p>

  <table border="1" cellspacing="0">
    <thead>
      <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Sumber Kas Masuk</th>
            <th>Tujuan Pengeluaran Kas</th>
            <th>Keterangan</th>
            <th>Pemasukan</th>
            <th>Pengeluaran</th>
      </tr>
    </thead>
    <tbody>
        <?php

            $no=1;
            $sql_tampil = "select * from kas_masjid LEFT JOIN categori_sumber ON kas_masjid.categori_sumber_id = categori_sumber.categori_sumber_id LEFT JOIN categori_tujuan ON kas_masjid.categori_tujuan_id = categori_tujuan.categori_tujuan_id  order by tgl_km asc";
            $query_tampil = mysqli_query($koneksi, $sql_tampil);
            while ($data = mysqli_fetch_array($query_tampil,MYSQLI_BOTH)) {
        ?>
         <tr>
            <td><?php echo $no; ?></td>
            <td><?php  $tgl = $data['tgl_km']; echo date("d/M/Y", strtotime($tgl))?></td>
            <td align="right"><?php echo $data['nama_categori_sumber']; ?></td>
            <td align="right"><?php echo $data['nama_categori_tujuan']; ?></td>
            <td><?php echo $data['uraian_km']; ?></td>
            <td align="right"><?php echo rupiah($data['masuk'])  ?></td>  
            <td align="right"><?php echo rupiah($data['keluar'])  ?></td>   
        </tr>
        <?php
            $no++;
            }
        ?>
    </tbody>
    <tr>
        <td colspan="5">Total Pemasukan</td>
        <td colspan="4"><?php echo rupiah($masuk)  ?></td>
    </tr>
    <tr>
        <td colspan="6">Total Pengeluaran</td>
        <td><?php echo rupiah($keluar)  ?></td>
    </tr>
    <tr>
        <td colspan="5">Saldo Kas Masjid</td>
        <td colspan="4"><?php echo rupiah($saldo)  ?></td>
    </tr>
  </table>
</center>

<script>
    window.print();
</script>
</body>
</html>

