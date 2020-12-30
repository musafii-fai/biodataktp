<style type="text/css">
	.card-primary.card-outline {
	    border-top: 2px solid #c100ce;
	}
</style>
<div class="card card-outline card-primary" style="margin-bottom: 15px;">
    <!-- <div class="card-header" style="padding: 0.5rem;"></div> -->
    <div class="card-body" style="padding: 0.5rem;">
        <center style="margin-top: -10px;">
    		<b>
    			SELAMAT DATANG DI APPLIKASI BIODATA KARTU TANDA PENDUDUK (KTP)
    			<br>
    			PEMERINTAH KOTA MEDAN
    		</b>
        </center>
    </div>
</div>
<!-- <br> -->

<div class="card card-outline card-primary" style="margin-bottom: 0rem;">
    <div class="card-header" style="padding: 0.5rem;">
    	<div class="row">
    		<div class="col-md-4">
    			<b>BIODATA ANDA</b> 
    		</div>
    		<div class="col-md-8">
    			<b>Silahkan Lengkapi Biodata Kartu Tanda Penduduk Anda.</b>
    		</div>
    	</div>
    </div>

	<?php echo form_open("",array("id" => "formData","class" => "form")); ?>
    <div class="card-body" style="padding: 0.5rem 1.25rem;">
	<?php $disabledInput = "";?>
    	<div class="row">
			<div class="col-md-6">
				<div class="card card-outline card-primary" style="margin-bottom: 0rem; border-top: 1px solid #c100ce;">
				    <div class="card-header" style="padding: 0rem;">
				    </div>
				    <div class="card-body" style="padding: 0.5rem 1.25rem;">
						<table class="table table-sm">
				    		<tr>
				    			<th>Nik</th>
				    			<td>:</td>
				    			<td>
				    				<span id="nikText" class="check-nik"></span>
				                    <input type="number" min="0" class="form-control form-control-sm manual-nik" <?php echo $disabledInput; ?>  name="nik_val" id="nik_val" value="<?php echo $this->userData->nik; ?>">
				    			</td>
				    		</tr>
				    		<tr>
				    			<th>Nama</th>
				    			<td>:</td>
				    			<td>
				                    <span id="namaText" class="check-nik"></span>
				                    <input type="text" class="form-control form-control-sm manual-nik" <?php echo $disabledInput; ?>  name="nama_val" id="nama_val" value="<?php echo $this->userData->nama; ?>">
				    			</td>
				    		</tr>
				    		<tr>
				    		<tr>
				    			<th>Tempat Lahir</th>
				    			<td>:</td>
				    			<td>
				                    <span id="tempatLahirText" class="check-nik"></span>
				                    <input type="text" class="form-control form-control-sm manual-nik" <?php echo $disabledInput; ?>  name="tempat_lahir_val" id="tempat_lahir_val" value="<?php echo $this->userData->tempat_lahir; ?>">
				    			</td>
				    		</tr>
				    			<th>Tgl Lahir</th>
				    			<td>:</td>
				    			<td>
				                    <span id="tglLahirText" class="check-nik"></span>
				                    <div class="input-group date " data-target-input="nearest">
						                <input type="text" <?php echo $disabledInput; ?>  name="tgl_lahir_val" class="form-control form-control-sm datetimepicker-input manual-nik" id="tgl_lahir_val" value="<?php echo $this->userData->tanggal_lahir; ?>" />

						                <div class="input-group-append" id="btnTglLhr" data-target="#tgl_lahir_val" data-toggle="datetimepicker">
						                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
						                </div>
						            </div>
				    			</td>
				    		</tr>
				    		<tr>
				    			<th>Jenis Kelamin</th>
				    			<td>:</td>
				    			<td>
				                    <span id="jenis_kelaminText" class="check-nik"></span>
				                    <div id="inputJenisKelamin">
					                    <select name="jenis_kelamin_val" <?php echo $disabledInput; ?>  id="jenis_kelamin_val" class="form-control form-control-sm manual-nik" style="width: 100%;">
					    					<option value="">-- Pilih jenis kelamin --</option>
					    					<?php 
					    						$selectedLK = "";
					    						$selectedPR = "";
					    						if ($this->userData->jenis_kelamin == "Laki-laki") {
					    							$selectedLK = "selected";
					    						} else if ($this->userData->jenis_kelamin == "Perempuan") {
					    							$selectedPR = "selected";
					    						}
					    					?>
					    					<option value="Laki-laki" <?php echo $selectedLK; ?>>Laki-laki</option>
					    					<option value="Perempuan" <?php echo $selectedPR; ?>>Perempuan</option>
					    				</select>
				                    </div>
				    			</td>
				    		</tr>
				    		<tr>
				    			<th>Agama</th>
				    			<td>:</td>
				    			<td>
				                    <span id="agamaText" class="check-nik"></span>
				                    <!-- <input type="text" class="form-control form-control-sm manual-nik" name="agama_val" id="agama_val"> -->
				                    <select name="agama_val" id="agama_val" <?php echo $disabledInput; ?> class="form-control form-control-sm manual-nik" style="width: 100%;">
				    					<option value="">-- Pilih Agama --</option>
				    					<?php $selectedIslam = $this->userData->agama == "Islam" ? "selected" : ""; ?>
				    					<?php $selectedKristenProtestan = $this->userData->agama == "Kristen Protestan" ? "selected" : ""; ?>
				    					<?php $selectedKatolik = $this->userData->agama == "Katolik" ? "selected" : ""; ?>
				    					<?php $selectedHindu = $this->userData->agama == "Hindu" ? "selected" : ""; ?>
				    					<?php $selectedBuddha = $this->userData->agama == "Buddha" ? "selected" : ""; ?>
				    					<?php $selectedKongHuCu = $this->userData->agama == "Kong Hu Cu" ? "selected" : ""; ?>

				    					<option value="Islam" <?php echo $selectedIslam; ?>>Islam</option>
				    					<option value="Kristen Protestan" <?php echo $selectedKristenProtestan; ?>>Kristen Protestan</option>
				    					<option value="Katolik" <?php echo $selectedKatolik; ?>>Katolik</option>
				    					<option value="Hindu" <?php echo $selectedHindu; ?>>Hindu</option>
				    					<option value="Buddha" <?php echo $selectedBuddha; ?>>Buddha</option>
				    					<option value="Kong Hu Cu" <?php echo $selectedKongHuCu; ?>>Kong Hu Cu</option>
				    				</select>
				    			</td>
				    		</tr>
				    		<tr>
				    			<th>Status Perkawinan</th>
				    			<td>:</td>
				    			<td>
				                    <span id="agamaText" class="check-nik"></span>
				                    <select name="status_perkawinan" id="status_perkawinan" <?php echo $disabledInput; ?> class="form-control form-control-sm manual-nik" style="width: 100%;">
				    					<option value="">-- Pilih Status --</option>
				    					<?php $selectedkawin = $this->userData->status_perkawinan == "kawin" ? "selected" : ""; ?>
				    					<?php $selectedbelumkawin = $this->userData->status_perkawinan == "belum kawin" ? "selected" : ""; ?>
				    					<?php $selectedceraihidup = $this->userData->status_perkawinan == "cerai hidup" ? "selected" : ""; ?>
				    					<?php $selectedceraimati = $this->userData->status_perkawinan == "cerai mati" ? "selected" : ""; ?>

				    					<option value="kawin" <?php echo $selectedkawin; ?>>kawin</option>
				    					<option value="belum kawin" <?php echo $selectedbelumkawin; ?>>belum kawin</option>
				    					<option value="cerai hidup" <?php echo $selectedceraihidup; ?>>cerai hidup</option>
				    					<option value="cerai mati" <?php echo $selectedceraimati; ?>>cerai mati</option>
				    				</select>
				    			</td>
				    		</tr>
				    	</table>
				    </div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card card-outline card-primary" style="margin-bottom: 0rem; border-top: 1px solid #c100ce;">
				    <div class="card-header" style="padding: 0rem;">
				    </div>
				    <div class="card-body" style="padding: 0.5rem 1.25rem;">
						<table class="table table-sm">
							<tr>
				    			<th>Pekerjaan</th>
				    			<td>:</td>
				    			<td>
				                    <input type="text" class="form-control form-control-sm manual-nik" <?php echo $disabledInput; ?>  name="pekerjaan" id="pekerjaan" value="<?php echo $this->userData->pekerjaan; ?>">
				    			</td>
				    		</tr>
				    		<tr>
				    			<th>Alamat</th>
				    			<td>:</td>
				    			<td>
				                    <span id="alamatText" class="check-nik"></span>
				                    <textarea id="alamat_val" name="alamat_val" <?php echo $disabledInput; ?> class="form-control form-control-sm" rows="3"><?php echo $this->userData->alamat; ?></textarea>
				    			</td>
				    		</tr>
				    		<tr>
				    			<th>Provinsi</th>
				    			<td>:</td>
				    			<td>
				                    <span id="provinsiText" class="check-nik"></span>
				                    <select id="provinsi_val" name="provinsi_val" <?php echo $disabledInput; ?> class="form-control form-control-sm">
				    					<option value="">--Pilih Provinsi--</option>
				    					<?php //var_dump($allGetProvinsi); ?>
				    					<?php if ($allGetProvinsi): ?>
				    						<?php foreach ($allGetProvinsi as $val): ?>
				    							<?php 
				    								$selected = $val->id_prov == $this->userData->id_prov ? "selected" : "";
				    							 ?>
				    							<option value="<?php echo $val->id_prov;?>" <?php echo $selected; ?>><?php echo $val->nama_provinsi;?></option>
				    						<?php endforeach ?>
				    					<?php endif ?>
				    				</select>
				    			</td>
				    		</tr>
				    		<tr>
				    			<th>Kota / Kabupaten</th>
				    			<td>:</td>
				    			<td>
				                    <span id="kotaKabText" class="check-nik"></span>
				                    <select id="kab_kota_val" name="kab_kota_val" <?php echo $disabledInput; ?> class="form-control form-control-sm">
				    					<!-- <option value="">--Pilih Kota/Kabutapen--</option> -->
				    					<?php if ($allGetKotaKab): ?>
				    						<?php foreach ($allGetKotaKab as $val): ?>
				    							<?php 
				    								$selected = $val->id_kab == $this->userData->id_kab ? "selected" : "";
				    							 ?>
				    							<option value="<?php echo $val->id_kab;?>" <?php echo $selected; ?>><?php echo $val->nama_kab;?></option>
				    						<?php endforeach ?>
				    					<?php endif ?>
				    				</select>
				    			</td>
				    		</tr>
				    		<tr>
				    			<th>Kecamatan</th>
				    			<td>:</td>
				    			<td>
				                    <span id="kecamatanText" class="check-nik"></span>
				                    <select id="kecamatan_val" name="kecamatan_val" <?php echo $disabledInput; ?> class="form-control form-control-sm">
				    					<!-- <option value="">--Pilih Kecamatan--</option> -->
				    					<?php if ($allGetKecamatan): ?>
				    						<?php foreach ($allGetKecamatan as $val): ?>
				    							<?php 
				    								$selected = $val->id_kec == $this->userData->id_kec ? "selected" : "";
				    							 ?>
				    							<option value="<?php echo $val->id_kec;?>" <?php echo $selected; ?>><?php echo $val->nama_kec;?></option>
				    						<?php endforeach ?>
				    					<?php endif ?>
				    				</select>
				    			</td>
				    		</tr>
				    		<tr>
				    			<th>Kelurahan / Desa</th>
				    			<td>:</td>
				    			<td>
				                    <span id="kelurahanText" class="check-nik"></span>

				                    <select id="kelurahan_val" name="kelurahan_val" <?php echo $disabledInput; ?> class="form-control form-control-sm">
				    					<!-- <option value="">--Pilih Kelurahan--</option> -->
				    					<?php if ($allGetKelurahan): ?>
				    						<?php foreach ($allGetKelurahan as $val): ?>
				    							<?php 
				    								$selected = $val->id_kel == $this->userData->id_kel ? "selected" : "";
				    							?>
				    							<option value="<?php echo $val->id_kel;?>" <?php echo $selected; ?>><?php echo $val->nama_kel;?></option>
				    						<?php endforeach ?>
				    					<?php endif ?>
				    				</select>
				    			</td>
				    		</tr>
				    	</table>
				    </div>
				</div>
			</div>
		</div>
    </div>
    <div class="card-footer" style="padding: 0.5rem;">
    	<div class="row">
    		<div class="col-md-4"></div>
    		<div class="col-md-4">
    			<button id="btnSave" class="btn btn-outline-primary btn-block" type="button">
		        	<i class="fa fa-save"></i> Simpan
		        </button>
    		</div>
    	</div>
	</div>
	<?php echo form_close(); ?>
</div>
<br>

<?php assets_js_public("home"); ?>

            