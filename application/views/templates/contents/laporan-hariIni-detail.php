<section id="content">

	<div class="page page-tables-datatables">

		<div class="pageheader">

			<div class="page-bar">

				<ul class="page-breadcrumb">
					<li>
						<a href="<?=base_url()?>"><i class="fa fa-home"></i> Dashboard</a>
					</li>
					<li>
						<a href="#">Laporan</a>
					</li>
					<li>
						<a href="<?=base_url()?>laporan/hariIni/detail/<?= $id ?>">Hari Ini Detail</a>
					</li>
				</ul>

			</div>

		</div>

		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">



				<!-- tile -->
				<section class="tile">

					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">Data <strong><?=$title?></strong></h1>
						<ul class="controls">
							<li class="dropdown">

								<a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
									<i class="fa fa-cog"></i>
									<i class="fa fa-spinner fa-spin"></i>
								</a>

								<ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
									<li>
										<a role="button" tabindex="0" class="tile-toggle">
											<span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
											<span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
					<!-- /tile header -->

					<!-- tile body -->
					<div class="tile-body">
						<div class="row">
							<div class="col-md-11">
								<a style="float: right;" href="<?= base_url() ?>laporan/hariIni/exportExcel/<?= $id ?>" target="_blank" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10" ><i class="fa fa-plus"></i> <span>Export Excel</span></a>
							</div>
							<div class="col-md-1">
								<a style="float: right;" href="<?= base_url() ?>laporan/hariIni/exportPDF/<?= $id ?>" target="_blank" class="btn btn-ef btn-ef-5 btn-ef-5b btn-danger mb-10" ><i class="fa fa-plus"></i> <span>Export PDF</span></a>
							</div>
						</div>
						<br>
						<table class="table table-custom" id="advanced-usage">
							<thead>
							<tr>
								<th>Nis</th>
								<th>Nama</th>
								<th>Hadir</th>
								<th>Sakit</th>
								<th>Izin</th>
								<th>Alpa</th>
								<th>Detail</th>
							</tr>
							</thead>
							<tbody>
								<?php foreach($siswa as $r) : ?>
								<tr>
									<td><?= $r['sisw_nis'] ?></td>
									<td><?= $r['sisw_nama'] ?></td>

									<?php 
										$exe = $this->db->select('sum(b.abse_hadir) as hadir, sum(b.abse_izin) as izin,  sum(b.abse_sakit) as sakit, sum(b.abse_alpa) as alpa')
														->from('siswa a')
														->join('absensi_masuk b', 'b.abse_sisw_id = a.sisw_id', 'right')
														->where('b.abse_tanggal', psql_date_format())
														->where('b.abse_sisw_id', $r['sisw_id'])
							                            ->where('b.abse_matp_id', 0)
														->get()
														->row_array();
									?>

									<td><?= $exe['hadir'] ?></td>
									<td><?= $exe['sakit'] ?></td>
									<td><?= $exe['izin'] ?></td>
									<td><?= $exe['alpa'] ?></td>
									<td>
										<button class="btn btn-sm btn-primary detail" onclick="detail(<?= $r['sisw_id'] ?>)" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14">
											Detail
										</button>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<!-- /tile body -->

				</section>
				<!-- /tile -->

			</div>
			<!-- /col -->
		</div>
		<!-- /row -->

	</div>
	
</section>

<!-- Splash Modal Izin -->
	<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title custom-font" id="myModalLabel">Scan QR Code</h3>
				</div>
				<input type="hidden" id="siswa">
				<form role="form" id="form" method="post">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-3 text-center">
								<div class="form-group">
									<label for="tanggal"><h5>NIS</h5></label>
								</div>
							</div>
							<div class="col-md-9">
								<input type="text" id="nis" class="form-control" readonly="">
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 text-center">
								<div class="form-group">
									<label for="tanggal"><h5>Nama</h5></label>
								</div>
							</div>
							<div class="col-md-9">
								<input type="text" id="nama" class="form-control" readonly="">
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 text-center">
								<div class="form-group">
									<label for="tanggal"><h5>Kelas</h5></label>
								</div>
							</div>
							<div class="col-md-9">
								<?php 
									$get = $this->db->select('a.kela_nama, b.juru_nama, c.kede_detail')
														->from('kelas_kelas_detail_jurusan_angkatan d')
														->join('kelas a', 'd.kkdj_kela_id = a.kela_id') 
														->join('kelas_detail c', 'd.kkdj_kede_id = c.kede_id') 
														->join('jurusan b', 'd.kkdj_juru_id = b.juru_id')
														->where('kkdj_id', $id)
														->get()
														->row_array();
								?>
								<input type="text" id="kelas" value="<?= $get['kela_nama'] ?> <?= $get['juru_nama'] ?> <?= $get['kede_detail'] ?>" class="form-control" readonly="">
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 text-center">
								<div class="form-group">
									<label for="tanggal"><h5>Absen Menurut Mata Pelajaran</h5></label>
								</div>
							</div>
							<div class="col-md-9">
								<select id="mata-pelajaran" class="form-control" onchange="change(this.value)">
									
								</select>
							</div>
						</div>
						<div class="row">
							<section class="tile" fullscreen="isFullscreen02">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font" id="siswa"><strong></strong></h1>
                                </div>
                                <!-- /tile header -->

                                <!-- tile widget -->
                                Absen Masuk
                                <div id="absen-masuk" style="width: 100%;height: 400px;"></div>

                                <!-- /tile widget -->

                                <!-- tile body -->
                                <div class="tile-body p-0">

                                    <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default panel-transparent">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <span><i class="fa fa-minus text-sm mr-5"></i> Absen Masuk</span>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body">
                                                    <table class="table table-no-border m-0">
                                                        <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Hadir</td>
                                                            <td id="hadir"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>Sakit</td>
                                                            <td id="sakit"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>Izin</td>
                                                            <td id="izin"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>4</td>
                                                            <td>Alpa</td>
                                                            <td id="alpa"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /tile body -->

                                <!-- tile widget -->
                                Absen Keluar
                                <div id="absen-keluar" style="width: 100%;height: 400px;"></div>

                                <!-- /tile widget -->

                                <!-- tile body -->
                                <div class="tile-body p-0">

                                    <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default panel-transparent">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <span><i class="fa fa-minus text-sm mr-5"></i> Absen Keluar</span>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body">
                                                    <table class="table table-no-border m-0">
                                                        <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Hadir</td>
                                                            <td id="hadirk"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>Sakit</td>
                                                            <td id="sakitk"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>Izin</td>
                                                            <td id="izink"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>4</td>
                                                            <td>Alpa</td>
                                                            <td id="alpak"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /tile body -->

                            </section>
						</div>
					</div>
					<hr>
					<div class="modal-footer">
						<button class="btn btn-default btn-border" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>