<!DOCTYPE html>
<html><head>
  <title>Data Absen Siswa <?= $kelas ?></title>
</head><body>
<style type="text/css">
  table
  {
    border-collapse: collapse;
  }
</style>
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
    <th>Sakit Masuk Keterangan</th>
    <th>Izin Masuk Keterangan</th>
    <th>Alpa Masuk Keterangan</th>
    <th>Sakit Keluar Keterangan</th>
    <th>Izin Keluar Keterangan</th>
    <th>Alpa Keluar Keterangan</th>
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
                            ->where('b.abse_tanggal', psql_date_format())
                            ->where('b.abse_matp_id', 0)
                            ->get()
                            ->row_array();

          $get2 = $this->db->select('sum(b.absk_hadir) as hadir, sum(b.absk_izin) as izin, sum(b.absk_sakit) as sakit, sum(b.absk_alpa) as alpa, b.*')
                            ->from('siswa a')
                            ->join('absensi_keluar b', 'b.absk_sisw_id = a.sisw_id', 'right')
                            ->where('b.absk_sisw_id', $r['sisw_id'])
                            ->where('b.absk_tanggal', psql_date_format())
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
      <td><?= $get['abse_sakit_keterangan'] ?></td>
      <td><?= $get['abse_izin_keterangan'] ?></td>
      <td><?= $get['abse_alpa_keterangan'] ?></td>
      <td><?= $get2['absk_sakit_keterangan'] ?></td>
      <td><?= $get2['absk_izin_keterangan'] ?></td>
      <td><?= $get2['absk_alpa_keterangan'] ?></td>
  </tr>
  <?php endforeach; ?>
</table>
</body></html>