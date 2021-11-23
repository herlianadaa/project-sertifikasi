<?php
session_start();
// $_SESSION['msg'] = 2;
include 'layout/header.php';
?>


<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
				<!--end::Page Title-->
				<!--begin::Actions-->
				<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200">
				</div>
				<span class="text-muted font-weight-bold mr-4"> => </span>
				<button type="button" class="btn btn-primary">Kelola Arsip</button>


				</a>
				<!--end::Actions-->
			</div>
			<!--end::Info-->
		</div>
	</div>
	<!--end::Subheader-->

	<!-- isi -->
	<div class="container">
		<!--begin::Card-->
		<div class="card card-custom gutter-b">
			<div class="card-header flex-wrap border-0 pt-6 pb-0">
				<div class="card-title">
					<h3 class="card-label">Arsip Surat
						<span class="d-block text-muted pt-1 font-size-sm">Berikut ini adalah surat-surat yang telah terbit dan diarsipkan. </span>
						<span class="d-block text-muted pt-1 font-size-sm">Klik Lihat pada "Icon Mata" untuk melihat surat </span>
					</h3>
				</div>
			</div>
			<div class="card-body">
				<input type="text" id="myInput" placeholder="Cari Surat" title="Type in a name">
				<button type="button" style="padding-right: 10px;" onclick="myFunction()" class="btn btn-outline-success">Cari</button>
				<?php
				include 'function/tampil.php';
				tampilsurat();
				?>


				<button type="button" data-toggle="modal" data-target="#ModalTambah" class="btn btn-outline-primary">Arsipkan Surat</button>

			</div>
		</div>
		<!--end::Card-->
	</div>
	<!--end::Container-->
	<!-- end isi -->

	<!-- Modal Tambah surat-->
	<div class="modal fade" id="ModalTambah" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ModalTambahLabel">Tambah Arsip Surat</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<div class="modal-body">
					<form class="form" method="POST" action="function/tambah.php" enctype="multipart/form-data">
						<div class="form-group">
							<label>No Surat:</label>
							<input required type="text" name="nosurat" class="form-control form-control-solid" placeholder="No surat..." />
							<span class="form-text text-muted">Masukan Nomor Surat</span>
						</div>
						<div class="form-group">
							<label>Judul Surat</label>
							<input required type="text" name="judulsurat" class="form-control form-control-solid" placeholder="Judul Surat..." />
							<span class="form-text text-muted">Masukan Judul Surat </span>
						</div>
						<div class="form-group ">
							<label>Kategori</label>
							<?php
							include 'include/koneksi.php';

							$query = "select * from kategori";
							$result = mysqli_query($koneksi, $query);

							if (!$result) {
								die('SQL Error: ' . mysqli_error($koneksi));
							}
							echo
							'<select name="kategori" class="form-control form-control-solid">';
							while ($row = mysqli_fetch_array($result)) {

								echo '
										<option  value="' . $row['id'] . '">' . $row['nama'] . '</option>';
							}
							echo '
									</select>';
							?>
						</div>

						<div class="form-group">
							<label> file Surat</label>
							<input required accept="pdf/*" type="file" name="file" class="form-control form-control-solid" placeholder="File..." />
							<span class="form-text text-muted">Upload File Surat </span>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary font-weight-bold">Simpan</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end modal tambah  -->



	<!-- Modal Lihat surat-->
	<div class="modal fade " id="ModalLihat" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ModalTambahLabel"> Lihat Arsip Surat</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<div class="modal-body">
					<form class="form" method="POST" action="function/edite.php" enctype="multipart/form-data">
						<input hidden type="text" name="id" id="id" class="form-control form-control-solid" placeholder="No surat..." />

						<div class="form-group">
							<label>No Surat:</label>
							<input readonly type="text" id="nosur" name="nosurat" class="form-control form-control-solid" placeholder="No surat..." />

						</div>
						<div class="form-group">
							<label>Kategori Surat</label>
							<input readonly type="text" name="kategori" id="kategori" class="form-control form-control-solid" placeholder="Kategori Surat..." />
						</div>
						<div class="form-group">
							<label>Judul Surat</label>
							<input readonly type="text" name="judulsurat" id="judul" class="form-control form-control-solid" placeholder="Judul Surat..." />
						</div>
						<div class="form-group">
							<label>Tanggal Surat</label>
							<input readonly type="text" name="tglarsip" id="tgl" class="form-control form-control-solid" placeholder="Tgl Surat..." />
						</div>

						<div id="filnotup" class="form-group text-center">
							<h1>File Arsip</h1>
							<!-- tempat tampil pdf -->
							<div class="cobak text-center">

							</div>
						</div>

						<div id="filup" class="form-group">
							<label> file Surat</label>
							<input required accept="pdf/*" type="file" name="fileupdate" class="form-control form-control-solid" placeholder="File..." />
							<span class="form-text text-muted">Upload File Surat </span>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<a id="unduhfile"> <button class="btn btn-success">Download File</button></a>
					<a id="batal"> <button class="btn btn-success">Batal</button></a>
					<button type="button" id="edite" class="btn btn-primary">Edit</button>
					<button type="submit" id="simpan" class="btn btn-primary">Simpan</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- end modal lihat  -->
</div>
<!--end::Content-->

<!-- lihat data -->
<script>
	// vareable data
	var id
	var nosur
	var judul
	var kategori
	var tgl
	var file

	// $(document)
	$(document).on('click', '#lihatsurat', function() {
		// sembunyikan upload file new
		$("#filup").hide()
		$("#filnotup").show()
		$("#edite").show()
		$("#simpan").hide()
		$("#batal").hide()


		id = $(this).attr('data-id');
		nosur = $(this).attr('data-nosur');
		judul = $(this).attr('data-judul');
		kategori = $(this).attr('data-kategori');
		tgl = $(this).attr('data-tgl');
		file = $(this).attr('data-file');
		$("#id").val(id);
		$("#nosur").val(nosur);
		$("#judul").val(judul);
		$("#kategori").val(kategori);
		$("#tgl").val(tgl);


		// menampilkan pdf
		var a = '/E-Arsip/assets/arsip/' + $(this).data('file');
		console.log(a);
		$('.cobak').html('<iframe id="tampil" src="' + a + '" height="550" width="100%" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" allowtransparency="true"  frameborder="0"></iframe>');

		// unduh button from modal lihat
		$("#unduhfile").attr("href", a)

		$('#ModalLihat').modal({
			backdrop: 'static',
			keyboard: false, // to prevent closing with Esc button (if you want this too)
			show: true
		})
	});


	// setting button edit
	$("#edite").click(function() {
		$("#filup").toggle("slow");
		$("#filnotup").hide();
		$("#edite").hide();
		$("#unduhfile").hide();
		$("#simpan").toggle("slow");
		$("#batal").toggle("slow")

	});

	$("#batal").click(function() {
		$("#filnotup").toggle("slow");
		$("#filup").hide();
		$("#batal").hide();
		$("#simpan").hide();
		$("#unduhfile").toggle("slow");
		$("#edite").toggle("slow")

	});
	//end set edite


	// });




	// hapus data proses
	$(document).on('click', '#deleteData', function() {
		var id = $(this).attr('data-id');

		console.log(id);
		Swal.fire({
			title: 'Apakah Kamu Yakin Menghapus Data Ini',
			showDenyButton: true,
			icon: 'warning',
			showCancelButton: false,
			confirmButtonText: 'Hapus',
			denyButtonText: `Batal`,
		}).then((result) => {
			/* Read more about isConfirmed, isDenied below */
			if (result.isConfirmed) {
				$.ajax({
					type: 'POST',
					data: "id=" + id,
					url: '/E-Arsip/function/hapus.php',
					success: function($result) {
						Swal.fire('Data Telah Dihapus!', '', 'Sukses')
						location.reload();
					}
				});

			} else if (result.isDenied) {
				Swal.fire('Data Tidak jadi di hapus', '', 'info')
			}
		})
	});
</script>
<!-- endlihat -->




<?php
include 'layout/footer.php'
?>

<!--  setting msg -->
<?php

$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : "";
switch ($msg) {
	case 1:
		echo "<script>
		Swal.fire(
			'Selamat!',
			'Data Arsip Surat Berhasil di tambahkan!',
			'success'
			)
		</script>";
		session_destroy();
		break;
	case 2:
		echo "<script>
		Swal.fire(
			'GAGAL!',
			'Data Arsip Surat Gagal di tambahkan!',
			'error'
			)
		</script>";
		session_destroy();
		break;
	case 4:
		echo "<script>
		Swal.fire(
			'Warning!',
			'Type File Harus PDF!',
			'error'
			)
		</script>";
		session_destroy();
		break;
	case 3:
		echo "<script>
		Swal.fire(
			'Warning!',
			'Ukuran File Terlalu Besar Max 5MB!',
			'error'
			)
		</script>";
		session_destroy();
		break;
	case 6:
		echo "<script>
		Swal.fire(
			'Selamat!',
			'Data Arsip Surat Berhasil di ubah!',
			'success'
			)
		</script>";
		session_destroy();
		break;
	case 5:
		echo "<script>
		Swal.fire(
			'GAGAL!',
			'Data Arsip Surat Gagal di Ubah!',
			'error'
			)
		</script>";
		session_destroy();
		break;
	default:
		echo "";
		break;
}

?>