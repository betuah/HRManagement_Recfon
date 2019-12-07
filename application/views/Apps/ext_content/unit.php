<label for="level" class="col-sm-3 control-label text-dark">Unit</label>
<div class="input-group col-sm-9">
    <select id="unit" name="unit" class="form-control select2" style="width: 100%;"  required>
        <option value="" selected="selected" disabled><?php echo $this->session->bahasa === 'EN' ? 'Choose the Unit' : 'Pilih Unit' ?></option>
        <?php 
            foreach ($get_div as $get) { 
                if ($req === '2') {
                    if ($get->id_div > 16) { ?>
                        <option value="<?= $get->id_div ?>"><?= $get->nama_unit ?></option>                            
        <?php  } } else if ($req === '3') { 
                    if ($get->id_div > 14 && $get->id_div < 17) {    
        ?>
                        <option value="<?= $get->id_div ?>"><?= $get->nama_unit ?></option>
        <?php  } } else { 
                    if ($get->id_div > 0 && $get->id_div < 14) {    
        ?>
                        <option value="<?= $get->id_div ?>"><?= $get->nama_unit ?></option>
        <?php } } } ?>
    </select>
    <span class="input-group-addon"><i class="mdi mdi-domain mdi-lg text-teal"></i></span>
</div>

<script>
    $('.select2').select2();
</script>