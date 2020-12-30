<div class="row">
	<div class="col-md-6">
		<div class="card full-height">
			<div class="card-header">
				<div class="card-title text-success">
					Cetak Excel

					<button type="button" class="btn btn-success btn-sm float-right" id="printExcelAll">
						<i class="fas fas fa-print"></i> &nbsp; Print Keseluruhan Excel
					</button>
				</div>
			</div>

            <?php echo form_open("",array("id" => "formExcel")); ?>
			<div class="card-body">
				<ol class="activity-feed">
					<li class="feed-item feed-item-secondary">
						<time class="date" datetime="9-25">NIK</time>
						<select name="nik" id="nik_excel" class="form-control">
							<option value="">--Pilih Nik--</option>
							<?php if ($dataKTP): ?>
								<?php foreach ($dataKTP as $val): ?>
									<option value="<?php echo $val->nik; ?>"><?php echo $val->nik; ?></option>
								<?php endforeach ?>
							<?php endif ?>
						</select>
					</li>
					<li class="feed-item feed-item-success">
						<time class="date" datetime="9-24">Nama</time>
						<select name="nama" id="nama_excel" class="form-control">
							<option value="">--Pilih Nama--</option>
							<?php if ($dataKTP): ?>
								<?php foreach ($dataKTP as $val): ?>
									<option value="<?php echo $val->nama; ?>"><?php echo $val->nama; ?></option>
								<?php endforeach ?>
							<?php endif ?>
						</select>
					</li>
					<li class="feed-item feed-item-info">
						<time class="date" datetime="9-23">Jenis Kelamin</time>
						<select name="jenis_kelamin" id="jenis_kelamin_excel" class="form-control">
							<option value="">--Pilih Jenis Kelamin--</option>
							<option value="Laki-laki">Laki-laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</li>
				</ol>
			</div>
			<div class="card-footer">
				<center>
					<button type="button" class="btn btn-success" id="printExcel">
						<i class="fas fas fa-print"></i> Print Excel
					</button>
				</center>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>

	<div class="col-md-6">
		<div class="card full-height">
			<div class="card-header">
				<div class="card-title text-warning">
					Cetak PDF

					<button type="button" class="btn btn-warning btn-sm float-right" id="printPdfAll">
						<i class="fas fas fa-print"></i> &nbsp; Print Keseluruhan PDF
					</button>
				</div>
			</div>

            <?php echo form_open("",array("id" => "formPdf")); ?>
			<div class="card-body">
				<ol class="activity-feed">
					<li class="feed-item feed-item-secondary">
						<time class="date" datetime="9-25">NIK</time>
						<select name="nik" id="nik_pdf" class="form-control">
							<option value="">--Pilih Nik--</option>
							<?php if ($dataKTP): ?>
								<?php foreach ($dataKTP as $val): ?>
									<option value="<?php echo $val->nik; ?>"><?php echo $val->nik; ?></option>
								<?php endforeach ?>
							<?php endif ?>

						</select>
					</li>
					<li class="feed-item feed-item-success">
						<time class="date" datetime="9-24">Nama</time>
						<select name="nama" id="nama_pdf" class="form-control">
							<option value="">--Pilih Nama--</option>
							<?php if ($dataKTP): ?>
								<?php foreach ($dataKTP as $val): ?>
									<option value="<?php echo $val->nama; ?>"><?php echo $val->nama; ?></option>
								<?php endforeach ?>
							<?php endif ?>
						</select>
					</li>
					<li class="feed-item feed-item-info">
						<time class="date" datetime="9-23">Jenis Kelamin</time>
						<select name="jenis_kelamin" id="jenis_kelamin_pdf" class="form-control">
							<option value="">--Pilih Jenis Kelamin--</option>
							<option value="Laki-laki">Laki-laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</li>
				</ol>
			</div>
			<div class="card-footer">
				<center>
					<button type="button" class="btn btn-warning" id="printPdf">
						<i class="fas fas fa-print"></i> Print PDF
					</button>
				</center>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#printExcelAll").click(function() {
		url = '<?php echo base_url();?>admin/laporan/cetakExcel/true';
        window.open(url);
	})

	$("#printExcel").click(function() {
        $.ajax({
            url: '<?php echo base_url();?>admin/laporan/btnPrint',
            type:'POST',
            data:$("#formExcel").serialize(),
            dataType:'JSON',
            success: function(json) {
                if (json.status == true) {
                   	
                   	var get = "?nik="+json.data.nik+"&nama="+json.data.nama+"&jk="+json.data.jenis_kelamin;
        
                    url = '<?php echo base_url();?>admin/laporan/cetakExcel/false'+get;
                    window.open(url);
                } else {
                    Swal.fire({
                            type: 'error',
                            html: json.message,
                        })
                }
                    
            }
        });
    });

	$("#printPdfAll").click(function() {
		url = '<?php echo base_url();?>admin/laporan/cetakPdf/true';
        window.open(url);
	})

    $("#printPdf").click(function() {
        $.ajax({
            url: '<?php echo base_url();?>admin/laporan/btnPrint',
            type:'POST',
            data:$("#formPdf").serialize(),
            dataType:'JSON',
            success: function(json) {
                if (json.status == true) {
                   	
                   	var get = "?nik="+json.data.nik+"&nama="+json.data.nama+"&jk="+json.data.jenis_kelamin;
        
                    url = '<?php echo base_url();?>admin/laporan/cetakPdf/false'+get;
                    window.open(url);
                } else {
                    Swal.fire({
                            type: 'error',
                            html: json.message,
                        })
                }
                    
            }
        });
    });

</script>