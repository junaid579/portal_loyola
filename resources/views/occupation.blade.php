@include('layout.header',array("pagetitle"=>"Occupation"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Occupation");
$breadcrumb_url   = array("dashboard", "occupation");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Occupation";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')



@include('layout.formopen',array('formheading'=>'Add Occupation','action'=>'occupation','fnid'=>'submit_occupation'))
@include('layout.forminputtext',array('ft'=>'Occupation','fin'=>'occupation_details','fph'=>'Occupation','fiv'=>''))
@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Occupations List'))

<form action="occupation" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th> SNO.</th>
            <th> Occupation </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th> - </th>
            <th> <input type="text" name="search_occupation_details" id="search_occupation_details" value="<?php echo $search_occupation_details;?>" class="form-control form-filter" /></th>
           
            {{-- For search buttons  --}} 
           @include('layout.search')
        </tr>
        </tfoot>
        <tbody><?php $i = 1;?>
        @foreach($alloccupations as $occupation)
            <?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
            ?>
            <tr class="<?php echo $odd_even;?>">
                <td class="SNO"> </td>
                <td> {{ $occupation->occupation_details }} </td>
                <td>    <?php if ($occupation->status == 1) {?>
                    <span class="label label-sm label-info"> Active </span>
                    <?php } else if ($occupation->status == 2) {?>
                    <span class="label label-sm label-warning"> Suspended </span>
                    <?php } else if ($occupation->status == 0) {?>
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
                                <a data-toggle="modal" href="#view-data-model" data-id="{{ $occupation->id }}" data-occupation_details="{{ $occupation->occupation_details }}"   class="view-data"><i class="icon-docs"></i> View </a>
                            </li>
                            <li>
                                <a data-toggle="modal" href="#responsive" data-id="{{ $occupation->id }}" data-occupation_details="{{ $occupation->occupation_details }}"  class="edit-data"><i class="icon-tag"></i> Edit </a>
                            </li>
                            {{-- For actions Delete and Suspend buttons function --}}
                    @include('layout.actions',array('loopobj'=>$occupation,'blade_name'=>'occupation'))
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Occupation','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Occupation','fin'=>'view_occupation_details'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Occupation','action'=>'occupation','fnid'=>'edit_form'))

@include('layout.forminputtext',array('ft'=>'Occupation','fin'=>'edit_occupation_details','fph'=>'Occupation','fiv'=>''))

@include('layout.modalformclose')

<?php $js = array("js/occupation.js");?>
@include('layout.footer',array('js' =>$js))


