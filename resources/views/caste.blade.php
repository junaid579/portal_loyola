@include('layout.header',array("pagetitle"=>"Caste"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Caste");
$breadcrumb_url   = array("dashboard", "caste");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Caste";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')



@include('layout.formopen',array('formheading'=>'Add Caste','action'=>'caste','fnid'=>'submit_caste'))
@include('layout.forminputtext',array('ft'=>'Caste Name','fin'=>'caste_name','fph'=>'Caste Name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Caste Code','fin'=>'caste_code','fph'=>'Caste Code','fiv'=>''))
@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Castes List'))

<form action="caste" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th> SNO.</th>
            <th> Caste Name </th>
            <th> Caste Code </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th> - </th>
            <th> <input type="text" name="search_caste_name" id="search_caste_name" value="<?php echo $search_caste_name;?>" class="form-control form-filter" /></th>
            <th> <input type="text" name="search_caste_code" id="search_caste_code" value="<?php echo $search_caste_code;?>" class="form-control form-filter" /></th>
            
                 {{-- For search buttons  --}} 
           @include('layout.search',['blade_name'=>'caste'])
            </th>
        </tr>
        </tfoot>
        <tbody><?php $i = 1;?>
        @foreach($allcastes as $castes)
            <?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
            ?>
            <tr class="<?php echo $odd_even;?>">
                <td class="SNO"> </td>
                <td> {{ $castes->caste_name }} </td>
                <td> {{ $castes->caste_code }} </td>
                <td>    <?php if ($castes->status == 1) {?>
                    <span class="label label-sm label-info"> Active </span>
                    <?php } else if ($castes->status == 2) {?>
                    <span class="label label-sm label-warning"> Suspended </span>
                    <?php } else if ($castes->status == 0) {?>
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
                                <a data-toggle="modal" href="#view-data-model" data-id="{{ $castes->id }}" data-caste_name="{{ $castes->caste_name }}" data-caste_code="{{ $castes->caste_code }}" "  class="view-data"><i class="icon-docs"></i> View </a>
                            </li>
                            <li>
                                <a data-toggle="modal" href="#responsive" data-id="{{ $castes->id }}" data-caste_name="{{ $castes->caste_name }}" data-caste_code="{{ $castes->caste_code }}" " class="edit-data"><i class="icon-tag"></i> Edit </a>
                            </li>
                             {{-- For actions Delete and Suspend buttons function --}}
                    @include('layout.actions',array('loopobj'=>$castes,'blade_name'=>'caste'))
                           
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Castes','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Caste Name','fin'=>'view_caste_name'))
@include('layout.forminputvalue',array('ft'=>'Caste Code ','fin'=>'view_caste_code'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Castes','action'=>'caste','fnid'=>'edit_form'))

@include('layout.forminputtext',array('ft'=>'Caste Name','fin'=>'edit_caste_name','fph'=>'Caste Name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Caste Code','fin'=>'edit_caste_code','fph'=>'Caste Code','fiv'=>''))

@include('layout.modalformclose')



<?php $js = array("js/caste.js");?>
@include('layout.footer',array('js' =>$js))


