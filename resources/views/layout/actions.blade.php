
<li class="divider"> </li>
@if ($loopobj->status==1)
    <li>
        <a href="{{ $blade_name }}/{{ $loopobj->id }}/2">
            <i class="fa fa-flag font-yellow" aria-hidden="true"></i> Suspend  </a>
    </li>
    <li>
        <a href="{{ $blade_name }}/{{ $loopobj->id }}/0">
            <i class="fa fa-trash font-red" aria-hidden="true"></i> Delete  </a>
    </li>
@endif
@if ($loopobj->status==2)
    <li>
        <a href="{{ $blade_name }}/{{ $loopobj->id }}/1">
            <i class="icon-flag"></i> Activate  </a>
    </li>
    <li>
        <a href="{{ $blade_name }}/{{ $loopobj->id }}/0">
            <i class="fa fa-trash" aria-hidden="true"></i> Delete  </a>
    </li>
    @endif
<?php if ($loopobj->status == 1) {?>
	<li>
	<?php } else if ($loopobj->status == 2) {?>
	<li>
	<?php }?>
</ul>