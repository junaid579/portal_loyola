@include('layout.header',array("pagetitle"=>"Subjects"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Subjects");
$breadcrumb_url   = array("dashboard", "subjects");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Subjects";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')

<?php $classnames = array();
foreach ($classes as $class) {
    $classnames[$class->id] = $class->class_name;
}?>

@include('layout.formopen',array('formheading'=>'Add Subjects','action'=>'subjects','fnid'=>'submit_subjects'))
@include('layout.formselect',array('ft'=>'Classes','fin'=>'class_id','data'=>$classes,'index'=>'id','value'=>'class_name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Subject','fin'=>'subject','fph'=>'Subject','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Sequences','fin'=>'sequences','fph'=>'Sequences','fiv'=>''))
@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Subjects List'))

<form action="subjects" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th> SNO.</th>
            <th> Class </th>
            <th> Subjects </th>
            <th> Sequences </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th> - </th>
            <th>
                <select name="search_class" id="search_class" class="form-control form-filter">
                    <option value="" selected="selected">Select</option>
                    <?php foreach ($classes as $class) {
                    $selected = "";
                    if ($search_class == $class->id) {
                        $selected = 'selected="selected"';
                    }?>
                    <option value="<?php echo $class->id;?>" <?php echo $selected;
                        ?> > <?php echo $class->class_name;?></option>
                    <?php }?>
                </select>
            </th>
            <th> <input type="text" name="search_subject" id="search_subject" value="<?php echo $search_subject;?>" class="form-control form-filter" /></th>
            <th> <input type="text" name="search_sequences" id="search_sequences" value="<?php echo $search_sequences;?>" class="form-control form-filter"/></th>
            
            {{-- For search buttons  --}} 
           @include('layout.search')
        </tr>
        </tfoot>
        <tbody><?php $i = 1;?>
        @foreach($allsubjects as $subjects)
            <?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
            ?>
            <tr class="<?php echo $odd_even;?>">
                <td class="SNO"> </td>
                <td> {{ $classnames[$subjects->class_id] }} </td>
                <td> {{ $subjects->subject_name }} </td>
                <td> {{ $subjects->sequence }} </td>
                <td>    <?php if ($subjects->status == 1) {?>
                    <span class="label label-sm label-info"> Active </span>
                    <?php } else if ($subjects->status == 2) {?>
                    <span class="label label-sm label-warning"> Suspended </span>
                    <?php } else if ($subjects->status == 0) {?>
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
                                <a data-toggle="modal" href="#view-data-model" data-id="{{ $subjects->id }}" data-name="{{ $subjects->subject_name }}" data-class="{{ $classnames[$subjects->class_id] }}" data-sequence="{{ $subjects->sequence }}" class="view-data"><i class="icon-docs"></i> View </a>
                            </li>
                            <li>
                                <a data-toggle="modal" href="#responsive" data-id="{{ $subjects->id }}" data-name="{{ $subjects->subject_name }}" data-class="{{ $subjects->class_id }}" data-sequence="{{ $subjects->sequence }}" class="edit-data"><i class="icon-tag"></i> Edit </a>
                            </li>
                           {{-- For actions Delete and Suspend buttons function --}}
                    @include('layout.actions',array('loopobj'=>$subjects,'blade_name'=>'subjects'))
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Subject','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Classes','fin'=>'view_classes'))
@include('layout.forminputvalue',array('ft'=>'Subject','fin'=>'view_subject'))
@include('layout.forminputvalue',array('ft'=>'Sequences','fin'=>'view_sequences'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Subject','action'=>'subjects','fnid'=>'edit_form'))
@include('layout.formselect',array('ft'=>'Classes','fin'=>'edit_classes','data'=>$classes,'index'=>'id','value'=>'class_name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Subject','fin'=>'edit_subject','fph'=>'Subject','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Sequences','fin'=>'edit_sequences','fph'=>'Sequences','fiv'=>''))
@include('layout.modalformclose')
<?php $js = array("js/subjects.js");?>
@include('layout.footer',array('js' =>$js))


