@include('layout.header',array("pagetitle"=>"Stationery Groups"))
@include('layout.topmenu')
@include('layout.leftsidemenu')


<?php $breadcrumb = array("Home", "Stationery Groups");
$breadcrumb_url   = array("dashboard", "Stationery Groups");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Stationery Groups";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')

<?php $stationeryGroupMasterNames = array();
foreach ($stationeryGroupMasters as $stationeryGroupMaster) {
    $stationeryGroupMasterNames[$stationeryGroupMaster->id] = $stationeryGroupMaster->group_name;
}?>
<?php $stationeryItemNames = array();
foreach ($stationeryItems as $stationeryItem) {
    $stationeryItemNames[$stationeryItem->id] = $stationeryItem->stationery_name;
}
?>

@include('layout.formopen',array('formheading'=>'Add Stationery Group','action'=>'stationerygroups','fnid'=>'submit_stationeryGroups'))
@include('layout.formselect',array('ft'=>'Stationery Groups Master','fin'=>'group_id','data'=>$stationeryGroupMasters,'index'=>'id','value'=>'group_name','fiv'=>''))
@include('layout.formselect',array('ft'=>'Stationery Item','fin'=>'stationery_id','data'=>$stationeryItems,'index'=>'id','value'=>'stationery_name','fiv'=>''))

@include('layout.forminputtext',array('ft'=>'Quantity','fin'=>'quantity','fph'=>'Quantity','fiv'=>''))
@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Stationery Groups List'))

<form action="stationerygroups" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th> SNO.</th>
            <th> Stationery Groups Master </th>
            <th> Stationery Item </th>
            <th> Quantity </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th> - </th>
            <th>
                <select name="search_stationeryGroupMaster" id="search_stationeryGroupMaster" class="form-control form-filter">
                    <option value="" selected="selected">Select</option>
                    <?php foreach ($stationeryGroupMasters as $stationeryGroupMaster) {
                        $selected = "";
                        if ($search_stationeryGroupMaster == $stationeryGroupMaster->id) {
                            $selected = 'selected="selected"';
                        }?>
                        <option value="<?php echo $stationeryGroupMaster->id;?>" <?php echo $selected;
                        ?> > <?php echo $stationeryGroupMaster->group_name;?></option>
                    <?php }?>
                </select>
            </th>
            <th>
                <select name="search_stationeryItem" id="search_stationeryItem" class="form-control form-filter">
                    <option value="" selected="selected">Select</option>
                    <?php foreach ($stationeryItems as $stationeryItem) {
                    $selected = "";
                    if ($search_stationeryItem == $stationeryItem->id) {
                        $selected = 'selected="selected"';
                    }?>
                    <option value="<?php echo $stationeryItem->id;?>" <?php echo $selected;
                        ?> > <?php echo $stationeryItem->stationery_name;?></option>
                    <?php }?>
                </select>
            </th>
            <th> <input type="text" name="search_quantity" id="search_quantity" value="<?php echo $search_quantity;?>" class="form-control form-filter"/></th>
            
            {{-- For search buttons  --}} 
           @include('layout.search')
        </tr>
        </tfoot>
        <tbody><?php $i = 1;?>
        @foreach($allstationeryGroups as $stationeryGroups)
        <?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
        ?>
        <tr class="<?php echo $odd_even;?>">
            <td class="SNO"> </td>
            <td> {{ $stationeryGroupMasterNames[$stationeryGroups->group_id] }} </td>
            <td> {{ $stationeryItemNames[$stationeryGroups->stationery_id] }}</td>

            <td> {{ $stationeryGroups->quantity }} </td>
            <td>    <?php if ($stationeryGroups->status == 1) {?>
                    <span class="label label-sm label-info"> Active </span>
                <?php } else if ($stationeryGroups->status == 2) {?>
                    <span class="label label-sm label-warning"> Suspended </span>
                <?php } else if ($stationeryGroups->status == 0) {?>
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
                            <a data-toggle="modal" href="#view-data-model" data-id="{{ $stationeryGroups->id }}" data-stationeryItem="{{ $stationeryItemNames[$stationeryGroups->stationery_id] }}" data-stationeryGroupMaster="{{ $stationeryGroupMasterNames[$stationeryGroups->group_id] }}" data-quantity="{{ $stationeryGroups->quantity }}" class="view-data"><i class="icon-docs"></i> View </a>
                        </li>
                        <li>
                            <a data-toggle="modal" href="#responsive" data-id="{{ $stationeryGroups->id }}" data-stationeryItem="{{  $stationeryGroups->stationery_id }}" data-stationeryGroupMaster="{{ $stationeryGroups->group_id }}" data-quantity="{{ $stationeryGroups->quantity }}" class="edit-data"><i class="icon-tag"></i> Edit </a>
                        </li>
                        {{-- For actions Delete and Suspend buttons function --}}
                    @include('layout.actions',array('loopobj'=>$stationeryGroups,'blade_name'=>'stationerygroups'))
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Stationery Group','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Stationery group Master','fin'=>'view_stationeryGroupMaster'))
@include('layout.forminputvalue',array('ft'=>'Stationery Item','fin'=>'view_stationeryItem'))
@include('layout.forminputvalue',array('ft'=>'Quantity','fin'=>'view_quantity'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Stationery Group','action'=>'stationerygroups','fnid'=>'edit_form'))
@include('layout.formselect',array('ft'=>'Stationery group Master','fin'=>'edit_stationeryGroupMaster','data'=>$stationeryGroupMasters,'index'=>'id','value'=>'group_name','fiv'=>''))
@include('layout.formselect',array('ft'=>'Stationery Item','fin'=>'edit_stationeryItem','data'=>$stationeryItems,'index'=>'id','value'=>'stationery_name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Quantity','fin'=>'edit_quantity','fph'=>'Quantity','fiv'=>''))        @include('layout.modalformclose')
<?php $js = array("js/stationeryGroups.js");?>
@include('layout.footer',array('js' =>$js))


