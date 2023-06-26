<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1><?= $title; ?></h1>
		</div>

		<div class="section-body">
			<!-- main -->
			<div class="row">
				<div class="col-xl-4">
					<div class="form-group">
						<label for="tanggal">Tanggal Awal</label>
						<input type="date" name="tanggal_awal" id="by_tanggal_awal" class="form-control" value="<?= $tanggal_awal; ?>">
					</div>
				</div>
				<div class="col-xl-4">
					<div class="form-group">
						<label for="tanggal">Tanggal Akhir</label>
						<input type="date" name="tanggal_akhir" id="by_tanggal_akhir" class="form-control" value="<?= $tanggal_akhir; ?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped" id="table-1">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Nama User</th>
											<th>Nama Paket</th>
											<th>Ekspedisi</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($paket as $data) : ?>
											<tr>
												<td><?= $i++; ?></td>
												<td><?= $data->name; ?></td>
												<td><?= $data->namaPaket; ?></td>
												<td><?= $data->ekspedisi; ?></td>
												<td>
													<div class="dropdown">
														<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															Action
														</button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
															<a href="javascript:void(0)" class="dropdown-item btn-progres" data-toggle="modal" data-target="#listProgres" data-id="<?= $data->id; ?>"><i class="fas fa-eye"></i> Progres</a>
														</div>
													</div>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end main -->
		</div>
	</section>
</div>

<div class="modal fade" id="listProgres" tabindex="-1" role="dialog" aria-labelledby="listProgresTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">List Progres</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 mb-3">
						<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addProgres">Tambah Progres</a>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<div id="tampil-list" class="d-none">
								<div class="table-responsive" style="overflow-y: auto; max-height: 500px;">
									<table class="table table-bordered table-hover table-vcenter" id="tabel-list">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th>Tanggal</th>
												<th>Status</th>
												<th>Catatan</th>
												<th>Foto</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="isi_table-list">

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="addProgres" tabindex="-1" role="dialog" aria-labelledby="addProgres" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Progres</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/progres/add'); ?>" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<input type="hidden" name="idPaket" id="idPaket">
							<div class="form-group">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="">-- Pilih Status --</option>
									<option value="Return">Return</option>
									<option value="Refund">Refund</option>
									<option value="Reject">Reject</option>
									<option value="Dijemput">Dijemput</option>
									<option value="Sampai">Sampai</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Catatan</label>
								<textarea name="catatan" cols="30" rows="10" class="form-control"></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Foto</label>
								<input type="file" name="foto" class="form-control">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	let list_btn = $('.btn-progres');

	$(list_btn).each(function(i) {
		$(list_btn[i]).click(function() {
			let id = $(this).data('id');

			$('#idPaket').val(id);

			$.ajax({
				url: `<?= base_url('admin/progres/getList'); ?>`,
				type: 'get',
				dataType: 'json',
				data: {
					id,
				},
				async: true,
				beforeSend: function(e) {
					$('#tampil-list').addClass('d-none');
				},
				success: function(res) {
					$('#tampil-list').removeClass('d-none');
					$('.tr_isi-list').remove();

					if (res != null) {
						$(res).each(function(i) {
							$("#tabel-list").append(
								`<tr class='tr_isi-list'>
                                <td class='text-center'>${i + 1}</td>
								<td>${res[i].createdAt}</td>
                                <td>${res[i].status}</td>
                                <td>${res[i].catatan}</td>
								<td>
								${(res[i].foto != null) ? `<a href="<?= base_url('uploads/paket/'); ?>${res[i].foto}" target="_blank"><img src="<?= base_url('uploads/paket/'); ?>${res[i].foto}" alt="${res[i].status}" class="img-thumbnail" width="400"></a>` : '-'}
								</td>
                                <td><a href="<?= base_url('admin/progres/delete/'); ?>${res[i].id}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="badge badge-danger">Delete</a></td>
                                <tr>`
							);
						});
					} else {
						$("#tabel-list").append(
							"<tr class='tr_isi-list'>" +
							"<td colspan='5' class='text-center'>Kosong</td>" +
							"<tr>");
					}
				},
				complete: function() {
					$('#tampil-list').removeClass('d-none');
				}
			});
		});
	});

	$('#by_tanggal_awal').change(function() {
		let tanggal_awal = $(this).val();
		let tanggal_akhir = $('#by_tanggal_akhir').val();

		document.location.href = `<?= base_url('admin/progres/index/'); ?>${tanggal_awal}/${tanggal_akhir}`;
	});

	$('#by_tanggal_akhir').change(function() {
		let tanggal_awal = $('#by_tanggal_awal').val();
		let tanggal_akhir = $(this).val();

		document.location.href = `<?= base_url('admin/progres/index/'); ?>${tanggal_awal}/${tanggal_akhir}`;
	});
</script>