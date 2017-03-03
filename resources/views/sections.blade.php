@include('layout.header',array("pagetitle"=>"Sections"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Sections");
$breadcrumb_url   = array("dashboard", "sections");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Sections";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')
<?php $classnames = array();
foreach ($classes as $class) {
    $classnames[$class->id] = $class->class_name;
}?>

@include('layout.formopen',array('formheading'=>'Add Sections','action'=>'sections','fnid'=>'submit_sections'))
@include('layout.formselect',array('ft'=>'Classes','fin'=>'class_id','data'=>$classes,'index'=>'id','value'=>'class_name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Section','fin'=>'section','fph'=>'Section','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Sequences','fin'=>'sequences','fph'=>'Sequences','fiv'=>''))
@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Sections List'))

<form action="sections" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_method" value="post">
<input type="hidden" name="_token" value="<?php echo csrf_token();?>">
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
        <tr>
            <th> SNO.</th>
            <th> Class </th>
            <th> Sections </th>
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
            <th> <input type="text" name="search_section" id="search_section" value="<?php echo $search_section;?>" class="form-control form-filter" /></th>
            <th> <input type="text" name="search_sequences" id="search_sequences" value="<?php echo $search_sequences;?>" class="form-control form-filter"/></th>
             {{-- For search buttons  --}} 
           @include('layout.search',['blade_name'=>'sections'])
        </tr>
    </tfoot>
    <tbody><?php $i = 1;?>
@foreach($allsections as $sections)
<?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
?>
        <tr class="<?php echo $odd_even;?>">
            <td class="SNO"> </td>
            <td> {{ $classnames[$sections->class_id] }} </td>
            <td> {{ $sections->section_name }} </td>
            <td> {{ $sections->sequence }} </td>
            <td>    <?php if ($sections->status == 1) {?>
	<span class="label label-sm label-info"> Active </span>
	<?php } else if ($sections->status == 2) {?>
	<span class="label label-sm label-warning"> Suspended </span>
	<?php } else if ($sections->status == 0) {?>
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
                            <a data-toggle="modal" href="#view-data-model" data-id="{{ $sections->id }}" data-name="{{ $sections->section_name }}" data-class="{{ $classnames[$sections->class_id] }}" data-sequence="{{ $sections->sequence }}" class="view-data"><i class="icon-docs"></i> View </a>
                        </li>
                        <li>
                            <a data-toggle="modal" href="#responsive" data-id="{{ $sections->id }}" data-name="{{ $sections->section_name }}" data-class="{{ $sections->class_id }}" data-sequence="{{ $sections->sequence }}" class="edit-data"><i class="icon-tag"></i> Edit </a>
                        </li>
                        {{-- For actions Delete and Suspend buttons function --}}
                    @include('layout.actions',array('loopobj'=>$sections,'blade_name'=>'sections'))
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Section','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Classes','fin'=>'view_classes'))
@include('layout.forminputvalue',array('ft'=>'Section','fin'=>'view_section'))
@include('layout.forminputvalue',array('ft'=>'Sequences','fin'=>'view_sequences'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Section','action'=>'sections','fnid'=>'edit_form'))
@include('layout.formselect',array('ft'=>'Classes','fin'=>'edit_classes','data'=>$classes,'index'=>'id','value'=>'class_name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Section','fin'=>'edit_section','fph'=>'Section','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Sequences','fin'=>'edit_sequences','fph'=>'Sequences','fiv'=>''))        @include('layout.modalformclose')
<?php $js = array("js/sections.js");?>
@include('layout.footer',array('js' =>$js))


