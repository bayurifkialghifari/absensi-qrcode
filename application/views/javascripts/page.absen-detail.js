$(function() {

	load()

	function load()
	{
		$('#navigation').css('display', 'none')

		window.history.pushState(null, "", window.location.href);        
	      	window.onpopstate = function() {
	        	window.history.pushState(null, "", window.location.href);
	    };
	}

	let url = window.location.pathname
	let id 	= url.split('/')
	
	id 		= id[5]

	$('#kksi_kkdj_id').val(id)


	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible)
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>absen/detail/ajax_data/"+id,
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "sisw_nis" },
			{ "data": "sisw_nama" },
			{ "data": "sisw_id", render(data, type, full, meta)
				{
					if(full.sisw_status == '')
					{
						return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-success btn-ef btn-ef-5 btn-ef-5b hadir-button" value="'+data+'"><i class="fa fa-pencil"></i> <span>Hadir</span></button>'
									+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b sakit-button" data-toggle="modal" data-target="#splash-2" data-options="splash-2 splash-ef-14" value="'+data+'"><i class="fa fa-pencil"></i> <span>Sakit</span></button>'
									+'<button class="btn btn-sm btn-warning btn-ef btn-ef-5 btn-ef-5b izin-button" data-toggle="modal" data-target="#splash-2" data-options="splash-2 splash-ef-14" value="'+data+'"><i class="fa fa-pencil"></i> <span>Izin</span></button>'
									+'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b alpa-button" data-toggle="modal" data-target="#splash-2" data-options="splash-2 splash-ef-14" value="'+data+'""><i class="fa fa-pencil"></i> <span>Alpa</span></button>'
								+'</div>'
					}
					else
					{
						return full.sisw_status
					}
				}
			}
		],
		"aoColumnDefs": [
		  { 'bSortable': false, 'aTargets': [ "no-sort" ] }
		]
	})


	var colvis = new $.fn.dataTable.ColVis(table4)

	$(colvis.button()).insertAfter('#colVis')
	$(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button')

	var tt = new $.fn.dataTable.TableTools(table4, {
		sRowSelect: 'single',
		"aButtons": [

			'copy',
			'print', {
				'sExtends': 'collection',
				'sButtonText': 'Save',
				'aButtons': ['csv', 'xls', 'pdf']
			}
		],
		"sSwfPath": "<?php echo base_url()?>assets/admin/non-angular/assets/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
	})

	$(tt.fnContainer()).insertAfter('#tableTools')
	//*initialize responsive datatable
	
	function dynamic()
	{
		//initialize responsive datatable

		var table4 = $('#advanced-usage').DataTable({
			"ajax": {
				"url": "<?= base_url()?>absen/detail/ajax_data/"+id,
				"data": null,
				"type": 'POST'
			},
			"columns": [
				{ "data": "sisw_nis" },
				{ "data": "sisw_nama" },
				{ "data": "sisw_id", render(data, type, full, meta)
					{
						if(full.sisw_status == '')
						{
							return '<div class="pull-right">'
										+'<button class="btn btn-sm btn-success btn-ef btn-ef-5 btn-ef-5b hadir-button" value="'+data+'"><i class="fa fa-pencil"></i> <span>Hadir</span></button>'
										+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b sakit-button" data-toggle="modal" data-target="#splash-2" data-options="splash-2 splash-ef-14" value="'+data+'"><i class="fa fa-pencil"></i> <span>Sakit</span></button>'
										+'<button class="btn btn-sm btn-warning btn-ef btn-ef-5 btn-ef-5b izin-button" data-toggle="modal" data-target="#splash-2" data-options="splash-2 splash-ef-14" value="'+data+'"><i class="fa fa-pencil"></i> <span>Izin</span></button>'
										+'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b alpa-button" data-toggle="modal" data-target="#splash-2" data-options="splash-2 splash-ef-14" value="'+data+'""><i class="fa fa-pencil"></i> <span>Alpa</span></button>'
									+'</div>'
						}
						else
						{
							return full.sisw_status
						}
					}
				}
			],
			"aoColumnDefs": [
			  { 'bSortable': false, 'aTargets': [ "no-sort" ] }
			]
		})

		var colvis = new $.fn.dataTable.ColVis(table4)

		$(colvis.button()).insertAfter('#colVis')
		$(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button')

		var tt = new $.fn.dataTable.TableTools(table4, {
			sRowSelect: 'single',
			"aButtons": [
				'copy',
				'print', {
					'sExtends': 'collection',
					'sButtonText': 'Save',
					'aButtons': ['csv', 'xls', 'pdf']
				}
			],
			"sSwfPath": "<?php echo base_url()?>assets/admin/non-angular/assets/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
		})

		$(tt.fnContainer()).insertAfter('#tableTools')
	}
	
	// Hadir
	$('#advanced-usage tbody').on('click', '.hadir-button', function(ev) {
		let content = $(this).val()
		let kksi_kkdj_id = $('#kksi_kkdj_id').val()
		
		window.apiClient.absen.hadir(content, kksi_kkdj_id)
		.done(function(data) {
			$("#advanced-usage").dataTable().fnDestroy()
			$.message('Absen',data.sisw_nama,'success')
			dynamic()

			let html = '<tr>'
						+'<td>'+data.sisw_nama+'</td>'
						+'<td>Hadir</td>'
						+'<td><?= psql_time_format() ?></td>'
					+'</tr>'
			if(data.sisw_nama != 'Sudah Terabsen')
			{
				if(data.sisw_nama != 'Siswa Tidak Terdaftar')
				{
					$('#detail-absen').append(html)
				}
			}
		})
		.fail(function($xhr) {
			$.message('Gagal ditambahkan.','siswa','error')
		})
	})

	// Sakit Button Click
	$('#advanced-usage tbody').on('click', '.sakit-button', function(ev) {
		$('#id-siswa').val($(this).val())
		$('#myButton').html('Sakit')
		$('#status').val('Sakit')

		let siswa = $(this).val()

		window.apiClient.absen.getDataSiswa(siswa)
		.done(function(data)
		{
			$('#myModalLabel-absen').html('Keterangan Sakit '+data)
		})
	})

	// Izin Button Click
	$('#advanced-usage tbody').on('click', '.izin-button', function(ev) {
		$('#id-siswa').val($(this).val())
		$('#myButton').html('Izin')
		$('#status').val('Izin')

		let siswa = $(this).val()

		window.apiClient.absen.getDataSiswa(siswa)
		.done(function(data)
		{
			$('#myModalLabel-absen').html('Keterangan Izin '+data)
		})
	})

	// Alpa Button Click
	$('#advanced-usage tbody').on('click', '.alpa-button', function(ev) {
		$('#id-siswa').val($(this).val())
		$('#myButton').html('Alpa')
		$('#status').val('Alpa')

		let siswa = $(this).val()

		window.apiClient.absen.getDataSiswa(siswa)
		.done(function(data)
		{
			$('#myModalLabel-absen').html('Keterangan Alpa '+data)
		})
	})

	$('#form').submit(function(ev) 
	{
		ev.preventDefault()

		let kksi_kkdj_id 		= $('#kksi_kkdj_id').val()
		let content 			= $('#id-siswa').val()
		let status 				= $('#status').val()
		let keterangan 			= $('#keterangan').val()

		if(status == 'Izin')
		{
			window.apiClient.absen.izin(content, kksi_kkdj_id, keterangan)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Izin',data,'success')
				$('#keterangan').val('')
				dynamic()
			})
			.fail(function($xhr) {
				$.message('Izin','siswa','error')
			})
			.always(function() {
				$('#splash-2').modal('toggle');
			})
		}
		else if(status == 'Sakit')
		{
			window.apiClient.absen.sakit(content, kksi_kkdj_id, keterangan)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Sakit',data,'success')
				$('#keterangan').val('')
				dynamic()
			})
			.fail(function($xhr) {
				$.message('Alpa','siswa','error')
			})
			.always(function() {
				$('#splash-2').modal('toggle');
			})
		}
		else if(status == 'Alpa')
		{
			window.apiClient.absen.alpa(content, kksi_kkdj_id, keterangan)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Alpa',data,'error')
				$('#keterangan').val('')
				dynamic()
			})
			.fail(function($xhr) {
				$.message('Alpa','siswa','error')
			})
			.always(function() {
				$('#splash-2').modal('toggle');
			})	
		}
	})

	// Scan HP
	$('#siswa').on('change', () =>
	{
		let content 	= $('#siswa').val()

		let kksi_kkdj_id = $('#kksi_kkdj_id').val()
		
		window.apiClient.absen.hadir(content, kksi_kkdj_id)
		.done(function(data) {
			$("#advanced-usage").dataTable().fnDestroy()
			$.message('Absen',data.sisw_nama,'success')

			let html = '<tr>'
						+'<td>'+data.sisw_nama+'</td>'
						+'<td>Keluar</td>'
						+'<td><?= psql_time_format() ?></td>'
					+'</tr>'
			if(data.sisw_nama != 'Sudah Terabsen')
			{
				if(data.sisw_nama != 'Siswa Tidak Terdaftar')
				{
					$('#detail-absen').append(html)
				}
			}
			dynamic()
		})
		.fail(function($xhr) {
			$.message('Gagal ditambahkan.','siswa','error')
		}).always(() =>
		{
			$('#siswa').focus()
		})

	})
	
	$('#form-2').submit((ev) =>
	{
		ev.preventDefault()

		$('#siswa').val('')		
		$('#siswa').focus()		
	})

	$('#splash').on('shown.bs.modal', () =>
	{
		$('#siswa').focus()
	})

	$('#siswa').on('focus', () =>
	{
		$('#myLabelSiswa').html('Silakan Scann QR-Code Lewat HP')
	})

	$('#splash').click(() =>
	{
		$('#siswa').focus()	
	})

	$('#siswa').on('focusout', () =>
	{
		$('#myLabelSiswa').html('Silakan Tekan Tab Untuk Melakukan Scann QR-Code Lewat HP')
	})

	// Scann QR
	let scanner = new Instascan.Scanner({ video: document.getElementById('preview') })
	scanner.addListener('scan', function (content) 
	{
		let ajax = null
		let kksi_kkdj_id = $('#kksi_kkdj_id').val()

		ajax = window.apiClient.absen.hadir(content, kksi_kkdj_id)
			.done(function(data) {
				$.message('Absen',data.sisw_nama,'success')

				let html = '<tr>'
							+'<td>'+data.sisw_nama+'</td>'
							+'<td>Hadir</td>'
							+'<td><?= psql_time_format() ?></td>'
						+'</tr>'
				if(data.sisw_nama != 'Sudah Terabsen')
				{
					if(data.sisw_nama != 'Siswa Tidak Terdaftar')
					{
						$('#detail-absen').append(html)
					}
				}
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','siswa','error')
			}).
			always(function() {
				// $('#splash').modal('toggle')
			})
	})

	$('#splash').on('hidden.bs.modal', () =>
	{
		// location.href = '<?= base_url() ?>absen/detail/siswa/'+id
		$("#advanced-usage").dataTable().fnDestroy()
		dynamic()
	})

	Instascan.Camera.getCameras().then(function (cameras) 
	{
	    if (cameras.length > 0) {
	      scanner.start(cameras[0])
	    } else {
	      console.error('No cameras found.')
	    }
	}).catch(function (e) {
	    console.error(e)
	})
})

function status(id)
{
	window.apiClient.absen.ChangeStatusKeluar(id)
}
