$(function() {
  function initAjax() {
    $.ajaxSetup({
      accepts: ['application/json'],
      dataType: 'json'
    });
  }

  function formatRupiah(angka=0, prefix=''){
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split   		= number_string.split(','),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if(ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}

	window.apiClient = {
		format:{
			rupiah: function(angka, prefix) {
				 if(angka){
		        var number_string = angka.replace(/[^,\d]/g, '').toString(),
						split   		= number_string.split(','),
						sisa     		= split[0].length % 3,
						rupiah     		= split[0].substr(0, sisa),
						ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

						// tambahkan titik jika yang di input sudah menjadi angka ribuan
						if(ribuan){
							separator = sisa ? '.' : '';
							rupiah += separator + ribuan.join('.');
						}

						rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
						// return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
						return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		    }else{
		        return 0;
		    }
			},
			tanggal: function(tanggal) {
				return tanggal;
			},
			splitString: function(stringToSplit, separator) {
			  var arrayOfStrings = stringToSplit.split(separator);
			  return arrayOfStrings.join('');
			}
		},
		dashboard: 
		{
			getDataKehadiran()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>dashboard/getDataKehadiran',
					data: null
				})
			},
			getDataKehadiranMinggu()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>dashboard/getDataKehadiranMinggu',
					data: null
				})
			},
			getDataKehadiranBulan()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>dashboard/getDataKehadiranBulan',
					data: null
				})
			}
		},
		laporan:
		{
			hariInidetailMataPelajaranMasuk(id, siswa)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/hariIni/getDataDetailAbsenMasuk/'+id+'/'+siswa,
					data: null
				})
			},
			hariInidetailMataPelajaranKeluar(id, siswa)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/hariIni/getDataDetailAbsenKeluar/'+id+'/'+siswa,
					data: null
				})
			},
			mingguInidetailMataPelajaranMasuk(id, siswa)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/mingguIni/getDataDetailAbsenMasuk/'+id+'/'+siswa,
					data: null
				})
			},
			mingguInidetailMataPelajaranKeluar(id, siswa)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/mingguIni/getDataDetailAbsenKeluar/'+id+'/'+siswa,
					data: null
				})
			},
			bulanInidetailMataPelajaranMasuk(id, siswa)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/bulanIni/getDataDetailAbsenMasuk/'+id+'/'+siswa,
					data: null
				})
			},
			bulanInidetailMataPelajaranKeluar(id, siswa)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/bulanIni/getDataDetailAbsenKeluar/'+id+'/'+siswa,
					data: null
				})
			},
			tahunInidetailMataPelajaranMasuk(id, siswa)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/tahunIni/getDataDetailAbsenMasuk/'+id+'/'+siswa,
					data: null
				})
			},
			tahunInidetailMataPelajaranKeluar(id, siswa)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/tahunIni/getDataDetailAbsenKeluar/'+id+'/'+siswa,
					data: null
				})
			},
			hariInidetail(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/hariIni/getDataDetail',
					data: {id : id}
				})
			},
			hariInidetailAbsenMasuk(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/hariIni/getDataDetailAbsenMasuk',
					data: {id : id}
				})	
			},
			hariInidetailAbsenKeluar(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/hariIni/getDataDetailAbsenKeluar',
					data: {id : id}
				})
			},
			mingguInidetail(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/mingguIni/getDataDetail',
					data: {id : id}
				})	
			},
			mingguInidetailAbsenMasuk(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/mingguIni/getDataDetailAbsenMasuk',
					data: {id : id}
				})	
			},
			mingguInidetailAbsenKeluar(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/mingguIni/getDataDetailAbsenKeluar',
					data: {id : id}
				})
			},
			bulanInidetail(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/bulanIni/getDataDetail',
					data: {id : id}
				})	
			},
			bulanInidetailAbsenMasuk(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/bulanIni/getDataDetailAbsenMasuk',
					data: {id : id}
				})	
			},
			bulanInidetailAbsenKeluar(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/bulanIni/getDataDetailAbsenKeluar',
					data: {id : id}
				})
			},
			tahunInidetail(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/tahunIni/getDataDetail',
					data: {id : id}
				})
			},
			tahunInidetailAbsenMasuk(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/tahunIni/getDataDetailAbsenMasuk',
					data: {id : id}
				})	
			},
			tahunInidetailAbsenKeluar(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>laporan/tahunIni/getDataDetailAbsenKeluar',
					data: {id : id}
				})
			}
		},
		absenKeluar:
		{
			hadir(content, kksi_kkdj_id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>absen/keluar/absen',
					data: 
					{
						siswa: content,
						kksi_kkdj_id: kksi_kkdj_id
					}
				})
			},
			sakit(content, kksi_kkdj_id, keterangan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>absen/keluar/sakit',
					data: 
					{
						siswa: content,
						kksi_kkdj_id: kksi_kkdj_id,
						keterangan: keterangan
					}
				})
			},
			izin(content, kksi_kkdj_id, keterangan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>absen/keluar/izin',
					data: 
					{
						siswa: content,
						kksi_kkdj_id: kksi_kkdj_id,
						keterangan: keterangan
					}
				})
			},
			alpa(content, kksi_kkdj_id, keterangan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>absen/keluar/alpa',
					data: 
					{
						siswa: content,
						kksi_kkdj_id: kksi_kkdj_id,
						keterangan: keterangan
					}
				})
			},
			getDataSiswa(siswa)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>absen/keluar/getDataSiswa',
					data: {id : siswa}
				})
			}
		},
		absen:
		{
			hadir(content, kksi_kkdj_id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>absen/detail/absen',
					data: 
					{
						siswa: content,
						kksi_kkdj_id: kksi_kkdj_id
					}
				})
			},
			sakit(content, kksi_kkdj_id, keterangan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>absen/detail/sakit',
					data: 
					{
						siswa: content,
						kksi_kkdj_id: kksi_kkdj_id,
						keterangan: keterangan
					}
				})
			},
			izin(content, kksi_kkdj_id, keterangan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>absen/detail/izin',
					data: 
					{
						siswa: content,
						kksi_kkdj_id: kksi_kkdj_id,
						keterangan: keterangan
					}
				})
			},
			alpa(content, kksi_kkdj_id, keterangan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>absen/detail/alpa',
					data: 
					{
						siswa: content,
						kksi_kkdj_id: kksi_kkdj_id,
						keterangan: keterangan
					}
				})
			},
			ChangeStatus(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>absen/detail/ChangeStatus',
					data:
					{
						id: id
					}
				})
			},
			ChangeStatusKeluar(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>absen/keluar/ChangeStatusKeluar',
					data: 
					{
						id: id
					}
				})
			},
			getDataSiswa(siswa)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>absen/detail/getDataSiswa',
					data: {id : siswa}
				})
			}
		},
		pengajarData:
		{
			insert(guru, mataPelajaran, kelas, jurusan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengajar/data/insert',
					data:
					{
						guru: guru,
						mataPelajaran: mataPelajaran,
						kelas: kelas,
						jurusan: jurusan
					}
				})
			},
			update(id, guru, mataPelajaran, kelas, jurusan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengajar/data/update',
					data:
					{
						id: id,
						guru: guru,
						mataPelajaran: mataPelajaran,
						kelas: kelas,
						jurusan: jurusan
					}
				})
			},
			delete(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengajar/data/delete',
					data: { id: id }
				})
			}
		},
		kelasDetail:
		{
			insert(siswa, kksi_kkdj_id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>kelas/detail/insert',
					data: 
					{
						siswa: siswa,
						kksi_kkdj_id: kksi_kkdj_id
					}
				})
			},
			delete(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>kelas/detail/delete',
					data: { id: id }
				})
			}
		},
		kelasData:
		{
			insert(kela, kede, jurusan, angkatan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>kelas/data/insert',
					data:
					{
						kela: kela,
						kede: kede,
						jurusan: jurusan,
						angkatan: angkatan
					}
				})
			},
			update(id, kela, kede, jurusan, angkatan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>kelas/data/update',
					data:
					{
						id: id,
						kela: kela,
						kede: kede,
						jurusan: jurusan,
						angkatan: angkatan
					}
				})	
			},
			delete(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>kelas/data/delete',
					data: { id: id }
				})
			}
		},
		siswaData:
		{
			insert: (nis, nisn, nama, no_hp, email, asal_sekolah) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>siswa/data/insert',
					data:
					{
						nis: nis,
						nisn: nisn,
						nama: nama,
						no_hp: no_hp,
						email: email,
						asal_sekolah: asal_sekolah
					}
				})
			},
			update: (id, nis, nisn, nama, no_hp, email, asal_sekolah) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>siswa/data/update',
					data:
					{
						id: id,
						nis: nis,
						nisn: nisn,
						nama: nama,
						no_hp: no_hp,
						email: email,
						asal_sekolah: asal_sekolah
					}
				})
			}, 
			delete: (id) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>siswa/data/delete',
					data:
					{
						id: id
					}
				})
			}
		},
		guruData:
		{
			insert: (email, name, phone, address, lev_id, pass) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>guru/data/insert',
					data:
					{
						email: email,
						name: name,
						phone: phone,
						address: address,
						lev_id: lev_id,
						pass: pass
					}
				})
			},
			update: (id, email, name, phone, address, lev_id, pass) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>guru/data/update',
					data:
					{
						id: id,
						email: email,
						name: name,
						phone: phone,
						address: address,
						lev_id: lev_id,
						pass: pass
					}
				})
			},
			delete: (id) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>guru/data/delete',
					data: {id : id}
				})
			}
		},
		referensiKelas: 
		{
			insert: (nama, keterangan, status) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/kelas/insert',
					data: {
						nama: nama,
						keterangan: keterangan,
						status: status
					}
				})
			},
			update: (id, nama, keterangan, status) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/kelas/update',
					data: {
						id: id,
						nama: nama,
						keterangan: keterangan,
						status: status
					}
				})
			},
			delete: (id) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/kelas/delete',
					data: {
						id: id
					}
				})
			}
		},
		referensiKelasDetail: 
		{
			insert: (detail, status) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/kelasDetail/insert',
					data: {
						detail: detail,
						status: status
					}
				})
			},
			update: (id, detail, status) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/kelasDetail/update',
					data: {
						id: id,
						detail: detail,
						status: status
					}
				})
			},
			delete: (id) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/kelasDetail/delete',
					data: {
						id: id
					}
				})
			}
		},
		referensiAngkatan: 
		{
			insert: (nama, keterangan) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/angkatan/insert',
					data:
					{
						nama: nama,
						keterangan: keterangan
					}
				})
			},
			update: (id, nama, keterangan) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/angkatan/update',
					data: {
						id: id,
						nama: nama,
						keterangan: keterangan
					}
				})
			},
			delete: (id) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/angkatan/delete',
					data: {id: id}
				})
			}
		},
		referensiJurusan:
		{
			insert: (nama, keterangan) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/jurusan/insert',
					data:
					{
						nama: nama,
						keterangan: keterangan
					}
				})
			},
			update: (id, nama, keterangan) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/jurusan/update',
					data: {
						id: id,
						nama: nama,
						keterangan: keterangan
					}
				})
			},
			delete: (id) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/jurusan/delete',
					data: {id: id}
				})
			}
		},
		referensiMataPelajaran:
		{
			insert: (nama, keterangan, status) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/mataPelajaran/insert',
					data: {
						nama: nama,
						keterangan: keterangan,
						status: status
					}
				})
			},
			update: (id, nama, keterangan, status) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/mataPelajaran/update',
					data: {
						id: id,
						nama: nama,
						keterangan: keterangan,
						status: status
					}
				})
			},
			delete: (id) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/mataPelajaran/delete',
					data: {
						id: id
					}
				})
			}
		},
		referensiSemester: 
		{
			insert: (nama, keterangan) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/semester/insert',
					data:
					{
						nama: nama,
						keterangan: keterangan
					}
				})
			},
			update: (id, nama, keterangan, status) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/semester/update',
					data: {
						id: id,
						nama: nama,
						keterangan: keterangan,
						status: status
					}
				})
			},
			delete: (id) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/semester/delete',
					data: {id: id}
				})
			}
		},
		pengaturanPengguna: {
			insert: function(email, name, phone, address, lev_id, pass) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/pengguna/insert',
					data: {
						email: email,
						name: name,
						phone: phone,
						address: address,
						lev_id: lev_id,
						pass: pass
					}
				});
			},

			update: function(id, email, name, phone, address, lev_id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/pengguna/update',
					data: {
						id: id,
						email: email,
						name: name,
						phone: phone,
						address: address,
						lev_id: lev_id
					}
				});
			},

			delete: function(id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/pengguna/delete',
					data: {
						id: id
					}
				});
			},
		},
		pengaturanLevel: {
			insert: function(nama, deskripsi, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/level/insert',
					data: {
						nama: nama,
						deskripsi: deskripsi,
						status: status
					}
				});
			},

			update: function(id, nama, deskripsi, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/level/update',
					data: {
						id: id,
						nama: nama,
						deskripsi: deskripsi,
						status: status
					}
				});
			},

			delete: function(id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/level/delete',
					data: {
						id: id
					}
				});
			},
		},
		pengaturanMenu: {
			insert: function(menu_menu_id, name, description, index, icon, url, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/menu/insert',
					data: {
						menu_menu_id: menu_menu_id,
						name: name,
						description: description,
						index: index,
						icon: icon,
						url: url,
						status: status
					}
				});
			},

			update: function(id, menu_menu_id, name, description, index, icon, url, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/menu/update',
					data: {
						id: id,
						menu_menu_id: menu_menu_id,
						name: name,
						description: description,
						index: index,
						icon: icon,
						url: url,
						status: status
					}
				});
			},

			delete: function(id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/menu/delete',
					data: {
						id: id
					}
				});
			},
		},
		pengaturanRoleAplikasi: {
			insert: function(lev_id, menu_id, menu_menu_id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/hakAkses/insert',
					data: {
						lev_id: lev_id,
						menu_id: menu_id,
						menu_menu_id: menu_menu_id
					}
				});
			},
			update: function(id, lev_id, menu_id, menu_menu_id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/hakAkses/update',
					data: {
						id: id,
						lev_id: lev_id,
						menu_id: menu_id,
						menu_menu_id: menu_menu_id
					}
				});
			},
			delete: function(id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/hakAkses/delete',
					data: {
						id: id
					}
				});
			},
		},
		filter:{
			kelasYangDiajar()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueKelasYangDiajar',
					data: null
				})
			},
			mataPelajaran()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueMataPelajaran',
					data: null
				})
			},
			guru()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueGuru',
					data: null
				})
			},
			siswa()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueSiswa',
					data: null
				})
			},
			kelas()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueKelas',
					data: null
				})
			},
			kelasDetail()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueKelasDetail',
					data: null
				})
			},
			jurusan()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueJurusan',
					data: null
				})
			},
			angkatan()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueAngkatan',
					data: null
				})
			},
			pengaturanMenuParent: function() {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValuePengaturanMenuParent',
					data: null
				});
			},
			pengaturanSubMenu: function(menu_id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueSubMenu',
					data: {
						menu_id: menu_id
					}
				});
			},
			pengaturanPenggunaLevel: function() {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValuePengaturanPenggunaLevel',
					data: null
				});
			},
			pengaturanLevel: function() {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueLevel',
					data: null
				});
			}
		}
	};

	initAjax();
});