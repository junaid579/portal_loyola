<div class="form-group">
    <label class="col-md-3 control-label">{{ $ft }}</label>
    <div class="col-md-4">
        <select id="{{ $fin }}" name="{{ $fin }}" class="form-control input-large">
			<?php for ($i = $startcount; $i <= $endcount; $i++) {?>
				<option value="<?php echo $i;?>" <?php if($i==$fiv){?> selected="selected" <?php  } ?>><?php echo $i;?></option>
			<?php }?>
        </select>
    </div>
</div>