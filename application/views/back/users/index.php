<div class="card card-widget">
    <div class="card-header">
        <h3 class="card-title">DataTable Pengguna</h3>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="listTableUsers" class="table table-bordered table-hover table-head-bg-default" style="width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>email</th>
                        <th>Level</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<?php echo modalSaveOpen(false,'','primary'); ?>
    <?php echo form_open("",array("id" => "formData")); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group m-b-20 focused">
                    <label for="full_name">Nama Lengkap :</label>
                    <input type="text" class="form-control" name="full_name" id="full_name">
                    <span class="help-block"><small id="errorFullName"></small></span>
                </div>
                <div class="form-group m-b-20">
                    <label for="email">Email :</label>
                    <input type="text" class="form-control" name="email" id="email">
                    <span class="help-block"><small id="errorEmail"></small></span>
                </div>
                <div class="form-group">
                    <label>Level Pengguna:</label>
                    <select class="form-control" name="level" id="level">
                        <option value="">--Pilih Level--</option>
                        <option value="operator">Operator</option>
                        <?php if ($this->user->level == "admin" || $this->user->level == "superadmin"): ?>
                            <option value="admin">Admin</option>
                        <?php endif ?>
                        <?php if ($this->user->level == "superadmin"): ?>
                            <option value="superadmin">Super Admin</option>
                        <?php endif ?>
                    </select>
                    <span class="help-block"><small id="errorLevel"></small></span>
                </div>
                <div class="form-group m-b-20">
                    <label for="password">Password :</label>
                    <input type="password" class="form-control" name="password" id="password">
                    <span class="help-block"><small id="errorPassword"></small></span>
                </div>
                <div class="form-group m-b-20">
                    <label for="confirm_password">Confirm Password :</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                    <span class="help-block"><small id="errorConfirmPassword"></small></span>
                </div>
            </div>
        </div>
    <?php echo form_close(); ?>
<?php echo modalSaveClose("Simpan"); ?>
<script type="text/javascript">
    var user_level = '<?php echo $this->user->level; ?>';
</script>
<?php assets_js_back("users"); ?>