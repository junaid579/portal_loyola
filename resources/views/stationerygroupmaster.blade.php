@include('layout.header',array("pagetitle"=>"Stationery groups"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Stationery groups");
$breadcrumb_url   = array("dashboard", "ConsessionType");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Stationery groups";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')



@include('layout.formopen',array('formheading'=>'Add Stationery groups','action'=>'stationerygroupmaster','fnid'=>'submit_stationeryGroup'))
@include('layout.forminputtext',array('ft'=>'Stationery groups','fin'=>'group_name','fph'=>'Stationery groups','fiv'=>''))
@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Stationery groups List'))

<form action="stationerygroupmaster" method="POST" encType="multipart/form-data">
    <input Type="hidden" name="_method" value="post">
    <input Type="hidden" name="_token" value="<?php echo csrf_token();?>">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th> SNO.</th>
            <th> Stationery groups </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th> - </th>
            <th> <input Type="text" name="search_group_name" id="search_group_name" value="<?php echo $search_group_name;?>" class="form-control form-filter" /></th>
            
            {{-- For search buttons  --}} 
           @include('layout.search',['blade_name'=>'stationerygroupmaster'])
        </tr>
        </tfoot>
        <tbody><?php $i = 1;?>
        @foreach($allstationeryGroup as $stationeryGroup)
            <?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
            ?>
            <tr class="<?php echo $odd_even;?>">
                <td class="SNO"> </td>
                <td> {{ $stationeryGroup->group_name }} </td>
                <td>    <?php if ($stationeryGroup->status == 1) {?>
                    <span class="label label-sm label-info"> Active </span>
                    <?php } else if ($stationeryGroup->status == 2) {?>
                    <span class="label label-sm label-warning"> Suspended </span>
                    <?php } else if ($stationeryGroup->status == 0) {?>
                    <span class="label label-sm label-danger"> Deleted </span>
                    <?php }?>
                </td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" Type="button" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu">
                            <li>
                                <a data-toggle="modal" href="#view-data-model" data-id="{{ $stationeryGroup->id }}" data-group_name="{{ $stationeryGroup->group_name }}"   class="view-data"><i class="icon-docs"></i> View </a>
                            </li>
                            <li>
                                <a data-toggle="modal" href="#responsive" data-id="{{ $stationeryGroup->id }}" data-group_name="{{ $stationeryGroup->group_name }}"  class="edit-data"><i class="icon-tag"></i> Edit </a>
                            </li>
                            {{-- For actions Delete and Suspend buttons function --}}
                    @include('layout.actions',array('loopobj'=>$stationeryGroup,'blade_name'=>'stationerygroupmaster'))
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Stationery groups','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Stationery groups','fin'=>'view_group_name'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Stationery group','action'=>'stationerygroupmaster','fnid'=>'edit_form'))

@include('layout.forminputtext',array('ft'=>'Stationery groups','fin'=>'edit_group_name','fph'=>'Stationery groups','fiv'=>''))

@include('layout.modalformclose')

<?php $js = array("js/stationeryGroup.js");?>
@include('layout.footer',array('js' =>$js))


