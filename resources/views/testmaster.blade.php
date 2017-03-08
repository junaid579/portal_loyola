@include('layout.header',array("pagetitle"=>"Tests"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Tests");
$breadcrumb_url   = array("dashboard", "testmaster");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Tests";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')
<?php $classnames = array();
foreach ($classes as $class) {
    $classnames[$class->id] = $class->class_name;
}?>

<?php $sectionnames = array();
foreach ($sections as $section) {
    $sectionnames[$section->id] = $section->section_name;
}?>

<?php $subjectnames = array();
foreach ($subjects as $subject) {
    $subjectnames[$subject->id] = $subject->subject_name;
}?>



@include('layout.formopen',array('formheading'=>'Add Tests','action'=>'testmaster','fnid'=>'submit_testmaster'))
@include('layout.formselect',array('ft'=>'Classes','fin'=>'class_id','data'=>$classes,'index'=>'id','value'=>'class_name','fiv'=>''))
@include('layout.formselect',array('ft'=>'Sections','fin'=>'section_id','data'=>$sections,'index'=>'id','value'=>'section_name','fiv'=>''))
@include('layout.formselect',array('ft'=>'Subjects','fin'=>'subject_id','data'=>$subjects,'index'=>'id','value'=>'subject_name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Test Name','fin'=>'test_name','fph'=>'Test Name','fiv'=>''))

@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Tests List'))

<form action="testmaster" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_method" value="post">
<input type="hidden" name="_token" value="<?php echo csrf_token();?>">
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
        <tr>
            <th> SNO.</th>
            <th> Class </th>
            <th> Section </th>
            <th> Subject </th>
            <th> Tests </th>
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
             <th>
                <select name="search_section" id="search_section" class="form-control form-filter">
                <option value="" selected="selected">Select</option>
   
<?php foreach ($sections as $section) {
    $selected = "";
    if ($search_section == $section->id) {
        $selected = 'selected="selected"';
    }?>
    <option value="<?php echo $section->id;?>" <?php echo $selected;
    ?> > <?php echo $section->section_name;?></option>
    <?php }?>
                </select>
            </th>
            <th>
                <select name="search_section" id="search_section" class="form-control form-filter">
                <option value="" selected="selected">Select</option>
   
<?php foreach ($subjects as $subject) {
    $selected = "";
    if ($search_subject == $subject->id) {
        $selected = 'selected="selected"';
    }?>
    <option value="<?php echo $subject->id;?>" <?php echo $selected;
    ?> > <?php echo $subject->subject_name;?></option>
    <?php }?>
                </select>
            </th>
              <th> <input type="text" name="search_test_name" id="search_test_name" value="<?php echo $search_test_name;?>" class="form-control form-filter" /></th>
             {{-- For search buttons  --}} 
           @include('layout.search',['blade_name'=>'testmaster'])
        </tr>
    </tfoot>
    <tbody><?php $i = 1;?>
@foreach($alltestmaster as $testmaster)
<?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
?>
        <tr class="<?php echo $odd_even;?>">
            <td class="SNO"> </td>
            <td> {{ $classnames[$testmaster->class_id] }} </td>
            <td> {{ $sectionnames[$testmaster->section_id] }} </td>
            <td> {{ $subjectnames[$testmaster->subject_id] }} </td>
            <td> {{ $testmaster->test_name }} </td>
            <td>    <?php if ($testmaster->status == 1) {?>
	<span class="label label-sm label-info"> Active </span>
	<?php } else if ($testmaster->status == 2) {?>
	<span class="label label-sm label-warning"> Suspended </span>
	<?php } else if ($testmaster->status == 0) {?>
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
                            <a data-toggle="modal" href="#view-data-model" data-id="{{ $testmaster->id }}" data-name="{{ $testmaster->test_name }}" data-class="{{ $classnames[$testmaster->class_id] }}" data-section="{{ $sectionnames[$testmaster->section_id] }}" data-subject="{{ $subjectnames[$testmaster->subject_id] }}"  class="view-data"><i class="icon-docs"></i> View </a>
                        </li>
                        <li>
                            <a data-toggle="modal" href="#responsive" data-id="{{ $testmaster->id }}" data-name="{{ $testmaster->test_name }}" data-class="{{ $testmaster->class_id }}" data-section="{{ $testmaster->section_id }}" data-subject="{{ $testmaster->subject_id }}"  class="edit-data"><i class="icon-tag"></i> Edit </a>
                        </li>
                        {{-- For actions Delete and Suspend buttons function --}}
                    @include('layout.actions',array('loopobj'=>$testmaster,'blade_name'=>'testmaster'))
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Test Name','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Classes','fin'=>'view_classes'))
@include('layout.forminputvalue',array('ft'=>'Sections','fin'=>'view_sections'))
@include('layout.forminputvalue',array('ft'=>'Subjects','fin'=>'view_sujects'))

@include('layout.forminputvalue',array('ft'=>'Test Name','fin'=>'view_test_name'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Test Name','action'=>'testmaster','fnid'=>'edit_form'))
@include('layout.formselect',array('ft'=>'Classes','fin'=>'edit_classes','data'=>$classes,'index'=>'id','value'=>'class_name','fiv'=>''))
@include('layout.formselect',array('ft'=>'Sections','fin'=>'edit_sections','data'=>$sections,'index'=>'id','value'=>'section_name','fiv'=>''))
@include('layout.formselect',array('ft'=>'Subjects','fin'=>'edit_subjects','data'=>$subjects,'index'=>'id','value'=>'subject_name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Test Name','fin'=>'edit_test_name','fph'=>'Test Name','fiv'=>''))
   @include('layout.modalformclose')
<?php $js = array("js/testmaster.js");?>
@include('layout.footer',array('js' =>$js))


