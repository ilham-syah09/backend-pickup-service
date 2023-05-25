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
											<input type="hidden" name="lati" value="<?= $setting->lati; ?>" id="lati">
											<input type="hidden" name="longi" value="<?= $setting->longi; ?>" id="longi">
											<input type="text" class="form-control" name="lintangBujur" value="<?= $setting->lintangBujur; ?>" id="lintangBujur">
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
							<div id="map" style="width: 100%; height: 70vh;"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- end main -->
		</div>
	</section>
</div>

<script>
	const googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
		maxZoom: 20,
		subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
	});

	const googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
		maxZoom: 20,
		subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
	});


	const peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	});

	const googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
		maxZoom: 20,
		subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
	});

	const map = L.map('map', {
		center: [$("#lati").val(), $("#longi").val()],
		zoom: 14,
		layers: [googleStreets],
	});

	const baseLayers = {
		'Default': peta3,
		'Street': googleStreets,
		'Dark': googleHybrid,
		'Satelite': googleSat,
	};

	const layerControl = L.control.layers(baseLayers).addTo(map);

	var curLocation = [$("#lati").val(), $("#longi").val()];

	map.attributionControl.setPrefix(false);

	var marker = new L.marker(curLocation, {
		draggable: 'true',
	});

	var circle = L.circle(curLocation, {
		color: 'red',
		radius: <?= $setting->maxJarak * 1000; ?>, //jangkauang radius dalam meter
	}).addTo(map);

	var marker = L.marker(curLocation, {
		draggable: true,
	}).addTo(map);

	// mengambil coordinat saat digeser
	marker.on('dragend', function(e) {
		var position = marker.getLatLng();
		marker.setLatLng(position, {
			curLocation
		}).bindPopup(position).update();

		$("#lati").val(position.lat);
		$("#longi").val(position.lng);
		$('#lintangBujur').val(`${position.lat}, ${position.lng}`)
	});

	// mengambil coordinat saat diclick
	map.on("click", function(e) {
		var lat = e.latlng.lat;
		var lng = e.latlng.lng;
		if (!marker) {
			marker = L.marker(e.latlng).addTo(map);
		} else {
			marker.setLatLng(e.latlng);
		}

		$("#lati").val(lat);
		$("#longi").val(lng);
		$('#lintangBujur').val(`${lat}, ${lng}`)
	});

	map.addLayer(marker);
</script>