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
						<a href="<?=base_url()?>laporan/mingguIni">Minggu Ini</a>
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
							<div class="col-md-6"><div id="tableTools"></div></div>
							<div class="col-md-6">
								<!-- <button style="float: right;" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14"><i class="fa fa-plus"></i> <span>Tambah</span></button> -->
							</div>
						</div>
						<br>
						<table class="table table-custom" id="advanced-usage">
							<thead>
								<tr>
									<th> Kelas</th>
									<th> Angkatan</th>
									<th> Data Absen</th>
									<!-- <th style="text-align: right;">Pilihan &nbsp;&nbsp;</th> -->
								</tr>
							</thead>
							<tbody>
								<?php foreach($kelas as $r) : ?>
									<tr>
										<td> <?= $r['kela_nama'] ?> <?= $r['juru_nama'] ?> <?= $r['kede_detail'] ?></td>
										<td> <?= $r['angk_nama'] ?></td>
										<td> 
											<a href="<?= base_url() ?>laporan/mingguIni/detail/<?= $r['kkdj_id'] ?>" class="btn btn-primary">
												<i class="fa fa-search"></i> Lihat
											</a>
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