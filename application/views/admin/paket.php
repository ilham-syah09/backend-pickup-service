<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1><?= $title; ?></h1>
		</div>

		<div class="section-body">
			<!-- main -->
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
											<th>Berat</th>
											<th>Catatan</th>
											<th>Alamat Penjemputan</th>
											<th>Total Biaya</th>
											<th>Status</th>
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
												<td><?= $data->berat . ' Kg'; ?></td>
												<td><?= $data->catatan; ?></td>
												<td>
													<a href="<?= base_url('admin/paket/alamat/' . $data->id); ?>" class="btn btn-info">Lihat</a>
												</td>
												<td>Rp. <?= number_format($data->totalBiaya); ?></td>
												<td>
													<?php if ($data->status_code == 200) : ?>
														<span class="badge badge-success text-dark">Success</span>
													<?php elseif (($data->status_code == 201)) : ?>
														<span class="badge badge-warning text-dark">Pending</span>
													<?php else : ?>
														<span class="badge badge-danger text-dark">Belum ada pembayaran</span>
													<?php endif; ?>
												</td>
												<td>
													<div class="dropdown">
														<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															Action
														</button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
															<?php if ($data->status_code != null) : ?>
																<a href="javascript:void(0)" class="dropdown-item btn_detail" data-toggle="modal" data-target="#modalDetail" data-payment_type="<?= $data->payment_type; ?>" data-bank="<?= $data->bank; ?>" data-va_numbers="<?= $data->va_numbers; ?>" data-pdf_url="<?= $data->pdf_url; ?>" data-status_code="<?= ($data->status_code == 200) ? 'Success' : 'Pending'; ?>"><i class="fas fa-info"></i> Detail Transaksi</a>
															<?php endif; ?>

															<a href="<?= base_url('admin/paket/delete/' . $data->id); ?>" class="dropdown-item"><i class="fas fa-trash"></i> Delete</a>
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

<!-- modal detail -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalDetail">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Transaksi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label>Payment Type</label>
							<input type="text" class="form-control" name="payment_type" id="payment_type" readonly>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<label>Bank</label>
							<input type="text" class="form-control" name="bank" id="bank" readonly>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<label>VA Numbers</label>
							<input type="text" class="form-control" name="va_numbers" id="va_numbers" readonly>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<label>PDF</label>
							<a href="" class="btn btn-info" target="_blank" id="pdf_url">Download</a>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<label>Status</label>
							<input type="text" class="form-control" name="status_code" id="status_code" readonly>
						</div>
					</div>
				</div>
				<div class="modal-footer bg-whitesmoke br">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	let btn_detail = $('.btn_detail');

	$(btn_detail).each(function(i) {
		$(btn_detail[i]).click(function() {
			let payment_type = $(this).data('payment_type');
			let bank = $(this).data('bank');
			let va_numbers = $(this).data('va_numbers');
			let pdf_url = $(this).data('pdf_url');
			let status_code = $(this).data('status_code');

			$('#payment_type').val(payment_type);
			$('#bank').val(bank);
			$('#va_numbers').val(va_numbers);
			$('#status_code').val(status_code);

			$('#pdf_url').attr("href", pdf_url)
		});
	});
</script>