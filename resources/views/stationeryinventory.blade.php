@include('layout.header',array("pagetitle"=>"Stationery Inventory"))
@include('layout.topmenu')
@include('layout.leftsidemenu')


<?php $breadcrumb = array("Home", "Stationery Inventory");
$breadcrumb_url   = array("dashboard", "Stationery Inventory");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Stationery Inventory";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')

<?php $stationeryInventoryMasterNames = array();
foreach ($stationeryInventoryMasters as $stationeryInventoryMaster) {
    $stationeryInventoryMasterNames[$stationeryInventoryMaster->id] = $stationeryInventoryMaster->inventory_desc;
}?>
<?php $stationeryItemNames = array();
foreach ($stationeryItems as $stationeryItem) {
    $stationeryItemNames[$stationeryItem->id] = $stationeryItem->stationery_name;
}
?>

@include('layout.formopen',array('formheading'=>'Add Stationery Inventory','action'=>'stationeryinventory','fnid'=>'submit_stationeryGroups'))
@include('layout.formselect',array('ft'=>'Stationery Inventory Master','fin'=>'inventory_id','data'=>$stationeryInventoryMasters,'index'=>'id','value'=>'inventory_desc','fiv'=>''))
@include('layout.formselect',array('ft'=>'Stationery Item','fin'=>'item_id','data'=>$stationeryItems,'index'=>'id','value'=>'stationery_name','fiv'=>''))

@include('layout.forminputtext',array('ft'=>'Count','fin'=>'count','fph'=>'Count','fiv'=>''))
@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Stationery Inventory List'))

<form action="stationeryinventory" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th> SNO.</th>
            <th> Stationery Inventory Master </th>
            <th> Stationery Item </th>
            <th> Count </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th> - </th>
            <th>
                <select name="search_stationeryInventoryMaster" id="search_stationeryInventoryMaster" class="form-control form-filter">
                    <option value="" selected="selected">Select</option>
                    <?php foreach ($stationeryInventoryMasters as $stationeryInventoryMaster) {
                    $selected = "";
                    if ($search_stationeryInventoryMaster == $stationeryInventoryMaster->id) {
                        $selected = 'selected="selected"';
                    }?>
                    <option value="<?php echo $stationeryInventoryMaster->id;?>" <?php echo $selected;
                        ?> > <?php echo $stationeryInventoryMaster->inventory_desc;?></option>
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
            <th> <input type="text" name="search_count" id="search_count" value="<?php echo $search_count;?>" class="form-control form-filter"/></th>
             {{-- For search buttons  --}} 
           @include('layout.search',['blade_name'=>'stationeryinventory'])
        </tr>
        </tfoot>
        <tbody><?php $i = 1;?>
        @foreach($allstationeryInventory as $stationeryInventory)
            <?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
            ?>
            <tr class="<?php echo $odd_even;?>">
                <td class="SNO"> </td>
                <td> {{ $stationeryInventoryMasterNames[$stationeryInventory->inventory_id] }} </td>
                <td> {{ $stationeryItemNames[$stationeryInventory->item_id] }}</td>

                <td> {{ $stationeryInventory->count }} </td>
                <td>    <?php if ($stationeryInventory->status == 1) {?>
                    <span class="label label-sm label-info"> Active </span>
                    <?php } else if ($stationeryInventory->status == 2) {?>
                    <span class="label label-sm label-warning"> Suspended </span>
                    <?php } else if ($stationeryInventory->status == 0) {?>
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
                                <a data-toggle="modal" href="#view-data-model" data-id="{{ $stationeryInventory->id }}" data-stationeryItem="{{ $stationeryItemNames[$stationeryInventory->item_id] }}" data-stationeryInventoryMaster="{{ $stationeryInventoryMasterNames[$stationeryInventory->inventory_id] }}" data-count="{{ $stationeryInventory->count }}" class="view-data"><i class="icon-docs"></i> View </a>
                            </li>
                            <li>
                                <a data-toggle="modal" href="#responsive" data-id="{{ $stationeryInventory->id }}" data-stationeryItem="{{  $stationeryInventory->item_id }}" data-stationeryInventoryMaster="{{ $stationeryInventory->inventory_id }}" data-count="{{ $stationeryInventory->count }}" class="edit-data"><i class="icon-tag"></i> Edit </a>
                            </li>
                             {{-- For actions Delete and Suspend buttons function --}}
                    @include('layout.actions',array('loopobj'=>$stationeryInventory,'blade_name'=>'stationeryinventory'))
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Stationery Inventory','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Stationery Inventory Master','fin'=>'view_stationeryInventoryMaster'))
@include('layout.forminputvalue',array('ft'=>'Stationery Item','fin'=>'view_stationeryItem'))
@include('layout.forminputvalue',array('ft'=>'count','fin'=>'view_count'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Stationery Inventory','action'=>'stationeryinventory','fnid'=>'edit_form'))
@include('layout.formselect',array('ft'=>'Stationery Inventory Master','fin'=>'edit_stationeryInventoryMaster','data'=>$stationeryInventoryMasters,'index'=>'id','value'=>'inventory_desc','fiv'=>''))
@include('layout.formselect',array('ft'=>'Stationery Item','fin'=>'edit_stationeryItem','data'=>$stationeryItems,'index'=>'id','value'=>'stationery_name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'count','fin'=>'edit_count','fph'=>'count','fiv'=>''))        @include('layout.modalformclose')
<?php $js = array("js/stationeryinventory.js");?>
@include('layout.footer',array('js' =>$js))


