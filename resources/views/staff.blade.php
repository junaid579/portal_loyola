@include('layout.header',array("pagetitle"=>"Staff"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Staff");
$breadcrumb_url   = array("dashboard", "staff");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Staff";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')



@include('layout.formopen',array('formheading'=>'Add Staff','action'=>'staff','fnid'=>'submit_staff'))
@include('layout.forminputtext',array('ft'=>'First Name','fin'=>'f_name','fph'=>'First Name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Last Name','fin'=>'l_name','fph'=>'Last Name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Mobile','fin'=>'mobile','fph'=>'Mobile','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'email','fin'=>'email','fph'=>'email','fiv'=>''))

@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Staff List'))

<form action="staff" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_method" value="post">
<input type="hidden" name="_token" value="<?php echo csrf_token();?>">
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
        <tr>
            <th> SNO.</th>
            <th> First Name </th>
            <th> Last Name </th>
            <th> Mobile </th>
            <th> e-mail </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th> - </th>
            <th> <input type="text" name="search_f_name" id="search_f_name" value="<?php echo $search_f_name;?>" class="form-control form-filter" /></th>
            <th> <input type="text" name="search_l_name" id="search_l_name" value="<?php echo $search_l_name;?>" class="form-control form-filter" /></th>
            <th> <input type="text" name="search_mobile" id="search_mobile" value="<?php echo $search_mobile;?>" class="form-control form-filter" /></th>
            <th> <input type="text" name="search_email" id="search_email" value="<?php echo $search_email;?>" class="form-control form-filter" /></th>
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
                <a  class="btn btn-sm red btn-outline filter-cancel" href="staff"><i class="fa fa-times"></i> Reset</a>
            </th>
        </tr>
    </tfoot>
    <tbody><?php $i = 1;?>
@foreach($allstaff as $staff)
<?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
?>
        <tr class="<?php echo $odd_even;?>">
            <td class="SNO"> </td>
            <td> {{ $staff->f_name }} </td>
            <td> {{ $staff->l_name }} </td>
            <td> {{ $staff->mobile }} </td>
            <td> {{ $staff->email }} </td>
            <td>    <?php if ($staff->status == 1) {?>
    <span class="label label-sm label-info"> Active </span>
    <?php } else if ($staff->status == 2) {?>
    <span class="label label-sm label-warning"> Suspended </span>
    <?php } else if ($staff->status == 0) {?>
    <span class="label label-sm label-danger"> Deleted </span>
    <?php }?>
</td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"> Actions
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu">
                        <li>
                            <a data-toggle="modal" href="#view-data-model" data-id="{{ $staff->id }}" data-f_name="{{ $staff->f_name }}" data-l_name="{{ $staff->l_name }}" data-mobile="{{ $staff->mobile }}" data-email="{{ $staff->email }}"  class="view-data"><i class="icon-docs"></i> View </a>
                        </li>
                        <li>
                            <a data-toggle="modal" href="#responsive" data-id="{{ $staff->id }}" data-f_name="{{ $staff->f_name }}" data-l_name="{{ $staff->l_name }}" data-mobile="{{ $staff->mobile }}" data-email="{{ $staff->email }}" class="edit-data"><i class="icon-tag"></i> Edit </a>
                        </li>
                        <li class="divider"> </li>
<?php if ($staff->status == 1) {?>
    <li>
    <?php } else if ($staff->status == 2) {?>
    <li>
    <?php }?>
</ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Staff','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'First Name','fin'=>'view_f_name'))
@include('layout.forminputvalue',array('ft'=>'Last Name','fin'=>'view_l_name'))
@include('layout.forminputvalue',array('ft'=>'Mobile','fin'=>'view_mobile'))
@include('layout.forminputvalue',array('ft'=>'email','fin'=>'view_email'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Staff member','action'=>'staff','fnid'=>'edit_form'))

@include('layout.forminputtext',array('ft'=>'First Name','fin'=>'edit_f_name','fph'=>'First Name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Last Name','fin'=>'edit_l_name','fph'=>'Last Name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Mobile','fin'=>'edit_mobile','fph'=>'Mobile','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'email','fin'=>'edit_email','fph'=>'email','fiv'=>''))

       @include('layout.modalformclose')

@include('layout.footer')

<script src="{{ URL::asset('js/staff.js') }}" type="text/javascript"></script>


