<section id="content">

	<div class="page page-tables-datatables">

		<div class="pageheader">

			<div class="page-bar">

				<ul class="page-breadcrumb">
					<li>
						<a href="<?=base_url()?>"><i class="fa fa-home"></i> Dashboard</a>
					</li>
					<li>
						<a href="#">Absen</a>
					</li>
					<li>
						<a href="<?=base_url()?>absen/detail/<?= $id ?>">Detail</a>
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
							<div class="col-md-6"><div id="tableTools"></div><a href="<?= base_url() ?>absen/keluar/siswa/<?= $id ?>" style="float: right;" class="btn btn-ef btn-ef-5 btn-ef-5b btn-warning mb-10" onclick="status(<?= $id ?>)"><i class="fa fa-plus"></i> <span>Absen Keluar</span></a></div>
							<div class="col-md-6">
								<!-- <?php 

									$get = $this->db->where('kkdj_id', $id)->get('kelas_kelas_detail_jurusan_angkatan')->row_array();

									if($get['kkdj_status'] == '') :
								?> -->
								<!-- id="absen" Untuk Ubah Status -->
									<button style="float: right;" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14"><i class="fa fa-plus"></i> <span>Scan QR-Code</span></button>
								<!-- <?php else : ?> -->
									<!-- <button style="float: right;" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10" data-toggle="modal" data-target="#splash" id="absen" data-options="splash-2 splash-ef-14" disabled><i class="fa fa-plus"></i> <span>Sudah Mengabsen</span></button> -->
								<!-- <?php endif; ?> -->
							</div>
						</div>
						<br>
						<table class="table table-custom" id="advanced-usage">
							<thead>
							<tr>
								<th>Nis</th>
								<th>Nama</th>
								<th>Pilihan</th>
							</tr>
							</thead>
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
<script type="text/javascript" src="<?= base_url() ?>assets/instascan.min.js"></script>

	<!-- Splash Modal -->
	<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title custom-font" id="myModalLabel">Scan QR Code</h3>
				</div>
				<form role="form" id="form-2" method="post">
					<div class="modal-body">
						<p class="text-center"><i id="myLabelSiswa"></i></p>
						<input type="text" class="hiden" id="siswa"  autocomplete="off">
						<input type="hidden" id="kksi_kkdj_id">
						<style type="text/css">
					      #preview
					      {
					        width: 100%;
					        height: 100%;
					      }

					      .hiden
					      {
					      	opacity: 0;
					      }
					    </style>
					    <video id="preview">
					    </video>
					</div>
					<hr>
					<div class="text-center">
						<table class="table table-bordered">
							<thead>
								<tr>
									<td>Siswa</td>
									<td>Status</td>
									<td>Jam Masuk</td>
								</tr>
							</thead>
							<tbody id="detail-absen">
								
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-default btn-border">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Splash Modal Izin -->
	<div class="modal splash fade" id="splash-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title custom-font" id="myModalLabel-absen">Scan QR Code</h3>
				</div>
				<form role="form" id="form" method="post">
					<div class="modal-body">
						<input type="hidden" id="id-siswa">
						<input type="hidden" id="status">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<textarea class="form-control" id="keterangan" required=""></textarea>
								</div>		
							</div>
						</div>
					</div>
					<hr>
					<div class="modal-footer">
						<button type="submit" class="btn btn-default btn-border" id="myButton">Simpan</button>
						<button class="btn btn-default btn-border" data-dismiss="modal">Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>