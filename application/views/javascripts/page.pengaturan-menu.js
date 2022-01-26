 $(function() {

 	value_filter_parent();

	function value_filter_parent(){
		window.apiClient.filter.pengaturanMenuParent().done(function(res) {
				$.each(res, function(value, key) {
					$("#menu_menu_id").append("<option value='"+key.menu_id+"'>"+key.menu_name+"</option>");
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>pengaturan/menu/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "parent" },
      { "data": "menu_name" },
      { "data": "menu_description" },
      { "data": "menu_index" },
      { "data": "menu_icon" },
      { "data": "menu_url" },
      { "data": "menu_status" },
			{
				"data": "menu_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
										+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.menu_id+'|'+full.menu_menu_id+'|'+full.menu_name+'|'+full.menu_description+'|'+full.menu_index+'|'+full.menu_icon+'|'+full.menu_url+'|'+full.menu_status+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
										+'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b delete-button" value="'+data+'"><i class="fa fa-trash"></i> <span>Hapus</span></button>'
									+'</div>';
				}
			}
		],
		"aoColumnDefs": [
		  { 'bSortable': false, 'aTargets': [ "no-sort" ] }
		]
	});


	var colvis = new $.fn.dataTable.ColVis(table4);

	$(colvis.button()).insertAfter('#colVis');
	$(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button');

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
		"sSwfPath": "<?php echo base_url();?>assets/admin/non-angular/assets/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
	});

	$(tt.fnContainer()).insertAfter('#tableTools');
	//*initialize responsive datatable

	function dynamic(){
		//initialize responsive datatable
	
		var table4 = $('#advanced-usage').DataTable({
			"ajax": {
				"url": "<?= base_url()?>pengaturan/menu/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": [
				{ "data": "parent" },
	      { "data": "menu_name" },
	      { "data": "menu_description" },
	      { "data": "menu_index" },
	      { "data": "menu_icon" },
	      { "data": "menu_url" },
	      { "data": "menu_status" },
				{
					"data": "menu_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
											+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.menu_id+'|'+full.menu_menu_id+'|'+full.menu_name+'|'+full.menu_description+'|'+full.menu_index+'|'+full.menu_icon+'|'+full.menu_url+'|'+full.menu_status+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
											+'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b delete-button" value="'+data+'"><i class="fa fa-trash"></i> <span>Hapus</span></button>'
										+'</div>';
					}
				}
			],
			"aoColumnDefs": [
			  { 'bSortable': false, 'aTargets': [ "no-sort" ] }
			]
		});


		var colvis = new $.fn.dataTable.ColVis(table4);

		$(colvis.button()).insertAfter('#colVis');
		$(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button');

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
			"sSwfPath": "<?php echo base_url();?>assets/admin/non-angular/assets/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
		});

		$(tt.fnContainer()).insertAfter('#tableTools');
	}

	// fungsi simpan 
	$('#form').submit(function(ev) {
		ev.preventDefault();
		let id = $('#form input[name=id]').val();
		let menu_menu_id = $('#menu_menu_id').val();
		let name = $('#name').val();
		let description = $('#description').val();
		let index = $('#index').val();
		let icon = $('#icon').val();
		let url = $('#url').val();
		let status = $('#status').val();

		let ajax = null;
		if(id == 0) {
			ajax = window.apiClient.pengaturanMenu.insert(menu_menu_id, name, description, index, icon, url, status)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','Menu','success');
				dynamic();
				$('#menu_menu_id').val('');
				$('#name').val('');
				$('#description').val('');
				$('#index').val('');
				$('#icon').val('');
				$('#url').val('');
				$('#status').val('');
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Menu','success');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
		else {
			ajax = window.apiClient.pengaturanMenu.update(id, menu_menu_id, name, description, index, icon, url, status)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil diubah.','Menu','success');
				dynamic();
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','Menu','success');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
	});

	
	// fungsi ubah
	$('#advanced-usage tbody').on('click', '.edit-button', function(ev) {
		ev.preventDefault();
		var ids = $(this).val();
		console.log(ids);
		var res = ids.split("|");
		$('#form input[name=id]').val(res[0]);
		$('#myModalLabel').html('Ubah Data Menu');
		$('#id').val(res[0]);
		$('#menu_menu_id').val(res[1]);
		$('#name').val(res[2]);
		$('#description').val(res[3]);
		$('#index').val(res[4]);
		$('#icon').val(res[5]);
		$('#url').val(res[6]);
		$('#status').val(res[7]);
	});

	// fungsi hapus
	$('#advanced-usage tbody').on('click', '.delete-button', function(ev) {
		var ids = $(this).val();
		$("#idHapus").val(ids);
		$("#labelHapus").text('Form Hapus');
		$("#contentHapus").text('Apakah anda yakin akan menghapus data ini?');
		$('#myModal3').modal('toggle');
	});

	// fungsi hapus jika ya
	$('#clickHapus').click(function() {
		let id = $("#idHapus").val();
		ajax = window.apiClient.pengaturanMenu.delete(id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil dihapus.','Menu','success');
				dynamic();
				
			})
			.fail(function($xhr) {
				$.message('Gagal dihapus.','Menu','error');
			}).
			always(function() {
				$('#myModal3').modal('toggle');
			});
	});

});
