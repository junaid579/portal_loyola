<th>
	<select name="search_status" id="search_status" class="form-control form-filter">
		<option value="" <?php if ($search_status == "") {?> selected="selected"  <?php }?>>Select</option>
		<option value="1" <?php if ($search_status == "1") {?> selected="selected"  <?php }?> >Active</option>
		<option value="2" <?php if ($search_status == "2") {?> selected="selected"  <?php }?> >Suspended</option>
		<option value="0" <?php if ($search_status == "0") {?> selected="selected"  <?php }?> >Deleted</option>
	</select>
</th>
<th>
	<button type="submit" name="search_submit" id="search_submit" class="btn btn-sm green btn-outline filter-submit margin-bottom" value="Search"><i class="fa fa-search"></i> Search</button>
	<a  class="btn btn-sm red btn-outline filter-cancel" href="{{ $blade_name }}"><i class="fa fa-times"></i> Reset</a>
</th>