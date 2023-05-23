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
											<th>Alamat Pengiriman</th>
											<th>Foto</th>
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
												<td><?= $data->berat; ?></td>
												<td><?= $data->catatan; ?></td>
												<td>
													<a href="<?= base_url('admin/paket/alamat/' . $data->id); ?>" class="btn btn-info" target="_blank">Lihat</a>
												</td>
												<td>
													<?php if ($data->foto != null) : ?>
														<img src="<?= base_url('uploads/paket/') . $data->foto; ?>" alt="<?= $data->namPaket; ?>" class="img-thumbnail" width="400">
													<?php endif; ?>
												</td>
												<td><?= $data->status; ?></td>
												<td>
													<div class="dropdown">
														<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															Action
														</button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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