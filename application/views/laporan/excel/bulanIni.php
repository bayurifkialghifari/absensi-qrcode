<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_absen_".$kelas."_bulan_ini.xls");

?>

<h3>Data Siswa <?= $kelas ?></h3>
    
<table border="1" cellpadding="5">
  <tr>
    <th>No</th>
    <th>NIS</th>
    <th>Nama</th>
    <th>Hadir Masuk</th>
    <th>Sakit Masuk</th>
    <th>Izin Masuk</th>
    <th>Alpa Masuk</th>
    <th>Hadir Keluar</th>
    <th>Sakit Keluar</th>
    <th>Izin Keluar</th>
    <th>Alpa Keluar</th>
    <!-- <th>Izin Masuk Keterangan</th>
    <th>Alpa Masuk Keterangan</th>
    <th>Izin Keluar Keterangan</th>
    <th>Alpa Keluar Keterangan</th> -->
  </tr>
  <?php $no = 1; foreach($siswa as $r) : ?>
  <tr>
      <td><?= $no++ ?></td>
      <td><?= $r['sisw_nis'] ?></td>
      <td><?= $r['sisw_nama'] ?></td>
      <?php  
        $get = $this->db->select('sum(b.abse_hadir) as hadir, sum(b.abse_izin) as izin, sum(b.abse_sakit) as sakit, sum(b.abse_alpa) as alpa, b.*')
                            ->from('siswa a')
                            ->join('absensi_masuk b', 'b.abse_sisw_id = a.sisw_id', 'right')
                            ->where('b.abse_sisw_id', $r['sisw_id'])
                            ->where('MONTH(b.abse_tanggal)=MONTH(NOW())')
                            ->where('b.abse_matp_id', 0)
                            ->get()
                            ->row_array();

        $get2 = $this->db->select('sum(b.absk_hadir) as hadir, sum(b.absk_izin) as izin, sum(b.absk_sakit) as sakit, sum(b.absk_alpa) as alpa, b.*')
                            ->from('siswa a')
                            ->join('absensi_keluar b', 'b.absk_sisw_id = a.sisw_id', 'right')
                            ->where('b.absk_sisw_id', $r['sisw_id'])
                            ->where('MONTH(b.absk_tanggal)=MONTH(NOW())')
                            ->where('b.absk_matp_id', 0)
                            ->get()
                            ->row_array();
      ?>
      <td><?= $get['hadir'] ?></td>
      <td><?= $get['sakit'] ?></td>
      <td><?= $get['izin'] ?></td>
      <td><?= $get['alpa'] ?></td>
      <td><?= $get2['hadir'] ?></td>
      <td><?= $get2['sakit'] ?></td>
      <td><?= $get2['izin'] ?></td>
      <td><?= $get2['alpa'] ?></td>
      <!-- <td><?= $data['abse_izin_keterangan'] ?></td>
      <td><?= $data['abse_alpa_keterangan'] ?></td>
      <td><?= $data['absk_izin_keterangan'] ?></td>
      <td><?= $data['absk_alpa_keterangan'] ?></td> -->
  </tr>
  <?php endforeach; ?>
</table>