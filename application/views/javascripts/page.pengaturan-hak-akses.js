 $(function() {

 	value_filter_parent();
	value_level();

	function value_filter_parent(){
		window.apiClient.filter.pengaturanMenuParent().done(function(res) {
				$.each(res, function(value, key) {
					$("#menu_id").append("<option value='"+key.menu_id+"'>"+key.menu_name+"</option>");
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	function value_filter_sub_parent(menu_id, val=null){
		$('#menu_menu_id option[value]').remove();
		$("#menu_menu_id").append("<option value=''>--Pilih Sub Menu--</option>");
		window.apiClient.filter.pengaturanSubMenu(menu_id).done(function(res) {
				$.each(res, function(value, key) {
					if(key.menu_id == val){
						$("#menu_menu_id").append("<option selected value='"+key.menu_id+"'>"+key.menu_name+"</option>");						
					}else{
						$("#menu_menu_id").append("<option value='"+key.menu_id+"'>"+key.menu_name+"</option>");						
					}
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	function value_level(){
		window.apiClient.filter.pengaturanLevel().done(function(res) {
				$.each(res, function(value, key) {
					$("#lev_id").append("<option value='"+key.lev_id+"'>"+key.lev_nama+"</option>");
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
			"url": "<?= base_url()?>pengaturan/hakAkses/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "lev_nama" },
      { "data": "parent" },
      { "data": "menu_name" },
      { "data": "created_date" },
			{
				"data": "rola_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
										+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.rola_id+'|'+full.rola_lev_id+'|'+full.parent_id+'|'+full.rola_menu_id+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
				"url": "<?= base_url()?>pengaturan/hakAkses/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": [
				{ "data": "lev_nama" },
	      { "data": "parent" },
	      { "data": "menu_name" },
	      { "data": "created_date" },
				{
					"data": "rola_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
											+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.rola_id+'|'+full.rola_lev_id+'|'+full.parent_id+'|'+full.rola_menu_id+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
		let lev_id = $('#lev_id').val();
		let menu_id = $('#menu_id').val();
		let menu_menu_id = $('#menu_menu_id').val();
		
		let ajax = null;
		if(id == 0) {
			ajax = window.apiClient.pengaturanRoleAplikasi.insert(lev_id, menu_id, menu_menu_id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','Hak Akses','success');
				dynamic();
				$('#lev_id').val('');
				$('#menu_id').val('');
				$('#menu_menu_id').val('');
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Hak Akses','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
		else {
			ajax = window.apiClient.pengaturanRoleAplikasi.update(id, lev_id, menu_id, menu_menu_id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil diubah.','Hak Akses','success');
				dynamic();
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','Hak Akses','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
	});

	
	// fungsi ubah
	$('#advanced-usage tbody').on('click', '.edit-button', function(ev) {
		ev.preventDefault();
		$('#myModalLabel').html('Ubah Data Hak Akses');
		var ids = $(this).val();
		$('#form input[name=id]').val(ids);
		var res = ids.split("|");
		$('#id').val(res[0]);
		$('#lev_id').val(res[1]);
		let parent = res[2];
		let menu = res[3];

		
		if(parent == 'null'){
			$('#menu_menu_id option[value]').remove();
			$('#menu_id').val(menu);			
		}else{
			$('#menu_id').val(parent);
			value_filter_sub_parent(parent,menu);
		}
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
		ajax = window.apiClient.pengaturanRoleAplikasi.delete(id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil dihapus.','Hak Akses','success');
				dynamic();
				
			})
			.fail(function($xhr) {
				$.message('Gagal dihapus.','Hak Akses','error');
			}).
			always(function() {
				$('#myModal3').modal('toggle');
			});
	});

	$('#menu_id').change(function() {
		let menu_id = $(this).val();
		value_filter_sub_parent(menu_id);
	});
});