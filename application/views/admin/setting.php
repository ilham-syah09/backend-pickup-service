<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1><?= $title; ?></h1>
		</div>

		<div class="section-body">
			<!-- main -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<form action="<?= base_url('admin/setting/edit'); ?>" method="post">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Garis Lintang-Bujut</label>
											<input type="hidden" name="id" value="<?= $setting->id; ?>">
											<input type="text" class="form-control" name="lintangBujur" value="<?= $setting->lintangBujur; ?>">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Batas Jarak <sup>Km</sup></label>
											<input type="number" class="form-control" name="maxJarak" value="<?= $setting->maxJarak; ?>">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Harga <sup>Per Km</sup></label>
											<input type="number" class="form-control" name="hargaKm" value="<?= $setting->hargaKm; ?>">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Harga <sup>Per Kg</sup></label>
											<input type="number" class="form-control" name="hargaKg" value="<?= $setting->hargaKg; ?>">
										</div>
									</div>
								</div>
								<button type="submit" class="btn btn-primary">Simpan</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header bg-primary text-dark">
							<h5>Lokasi Kantor</h5>
						</div>
						<div class="card-body">
							<iframe width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="<?= "https://maps.google.com/maps?q=" . $setting->lintangBujur . "&amp;output=embed"; ?>">
							</iframe>
						</div>
					</div>
				</div>
			</div>
			<!-- end main -->
		</div>
	</section>
</div>