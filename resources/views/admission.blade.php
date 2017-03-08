@include('layout.header',array("pagetitle"=>"Student Admission Form"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Student Admission");
$breadcrumb_url   = array("dashboard", "Student Admission");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Student Admission";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')

{{-- RETREIVING DATA IN ARRAYS FROM CONTROLLER--}}
<?php $classnames = array();
foreach ($classes as $class) {
    $classnames[$class->id] = $class->class_name;
}?>

<?php $sectionnames = array();
foreach ($sections as $section) {
    $sectionnames[$section->id] = $section->section_name;
}?>

<?php $occupationnames = array();
foreach ($occupations as $occupation) {
    $occupationnames[$occupation->id] = $occupation->occupation_details;
}?>
<?php $castenames = array();
foreach ($castes as $caste) {
    $castenames[$caste->id] = $caste->caste_name;
}?>

<?php $religionnames = array();
foreach ($religions as $religion) {
    $religionnames[$religion->id] = $religion->religion_name;
}?>

<?php $mothertonguenames = array();
foreach ($mothertongues as $mothertongue) {
    $mothertonguenames[$mothertongue->id] = $mothertongue->mother_tongue;
}?>

<?php $nationalitynames = array();
foreach ($nationalities as $nationality) {
    $nationalitynames[$nationality->id] = $nationality->nationality;
}?>
{{--BEGIN BODY CONTENT--}}

<div class="row">
<div class="col-md-12">
    <div class="portlet light bordered" id="form_wizard_1">
        <div class="portlet-title">
            <div class="caption">
                <i class=" icon-layers font-red"></i>
                <span class="caption-subject font-red bold uppercase"> Application Form -
                    <span class="step-title"> Step 1 of 3 </span>
                </span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal" action="admission" id="submit_form" method="POST">
                <div class="form-wizard">
                    <div class="form-body">
                        <ul class="nav nav-pills nav-justified steps">
                            <li>
                                <a href="#tab1" data-toggle="tab" class="step">
                                    <span class="number"> 1 </span>
                                    <span class="desc">
                                        <i class="fa fa-check"></i> Student Details </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab2" data-toggle="tab" class="step">
                                    <span class="number"> 2 </span>
                                    <span class="desc">
                                        <i class="fa fa-check"></i> Parent's Details </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab3" data-toggle="tab" class="step active">
                                    <span class="number"> 3 </span>
                                    <span class="desc">
                                        <i class="fa fa-check"></i> Communication Details </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab4" data-toggle="tab" class="step">
                                    <span class="number"> 4 </span>
                                    <span class="desc">
                                        <i class="fa fa-check"></i> Education Details </span>
                                </a>
                            </li>
                        </ul>
                        <div id="bar" class="progress progress-striped" role="progressbar">
                            <div class="progress-bar progress-bar-success"> </div>
                        </div>
                        <div class="tab-content">
                            <div class="alert alert-danger display-none">
                                <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. </div>
                            <div class="alert alert-success display-none">
                                <button class="close" data-dismiss="alert"></button> Your form validation is successful! </div>
                            <div class="tab-pane active" id="tab1">
                               {{-- <h4 class="form-section uppercase font-purple">Student Info</h4>--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">First Name</label>
                                            <div class="col-md-9 input-medium input-medium">
                                                <input type="text" class="form-control" name = "first_name" id="first_name" placeholder="First Name">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Last Name</label>
                                            <div class="col-md-9 input-medium">
                                                <input type="text" class="form-control" name = "last_name" id="last_name" placeholder="Last Name">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Gender</label>
                                            <div class="col-md-9 input-medium">
                                                <select class="form-control" name = "genderi" id="genderi"  >
                                                    <option value="">Male</option>
                                                    <option value="">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Date of Birth</label>
                                            <div class="col-md-9 input-medium">
                                                <div class="input-group date date-picker" data-date="01-01-1980" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                    <input type="text" class="form-control" name = "date_of_birth" id="date_of_birth" readonly="">
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Religion</label>
                                            <div class="col-md-9 input-medium">
                                                <select class="form-control" data-placeholder="Choose a Caste" tabindex="1" name="religion" id = "religion">
                                                @foreach($religions as $religion)
                                                 <option value="id"> {{ $religion->religion_name }} </option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Caste</label>
                                            <div class="col-md-9 input-medium">
                                                <select class="form-control" data-placeholder="Choose a Caste" tabindex="1" name="caste" id="caste">
                                                @foreach($castes as $val)
                                                 <option value="id"> {{ $val->caste_name }} </option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>

                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Nationality</label>
                                            <div class="col-md-9 input-medium">
                                                <select class="form-control" data-placeholder="Choose a Caste" tabindex="1" name="nationality" id="nationality">
                                                @foreach($nationalities as $val)
                                                 <option value="id"> {{ $val->nationality }} </option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Place of Birth</label>
                                            <div class="col-md-9 input-medium">
                                                <input type="text" class="form-control" name="birth_place" id="birth_place" placeholder="Place of Birth"> 
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Aadhar Number</label>
                                            <div class="col-md-9 input-medium">
                                                <input type="text" class="form-control" id="aadhar_no" name="aadhar_no" placeholder="1234 5678 9012">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Mother Tongue</label>
                                            <div class="col-md-9 input-medium">
                                                <select class="form-control" data-placeholder="Choose a Caste" tabindex="1" name="mother_tongue" id="mother_tongue">
                                                @foreach($mothertongues as $val)
                                                 <option value="id"> {{ $val->mother_tongue }} </option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">
                               {{-- <h4 class="form-section uppercase font-purple">Parents Info</h4>--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Fathers Name</label>
                                            <div class="col-md-9 input-medium input-medium">
                                                <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Fathers Name">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Mothers Name</label>
                                            <div class="col-md-9 input-medium">
                                                <input type="text" class="form-control" id="mother_name" name="mother_name" placeholder="Mothers Name">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Fathers Income</label>
                                            <div class="col-md-9 input-medium input-medium">
                                                <input type="text" class="form-control" id="father_income" name="father_income" placeholder="Fathers Income">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Guardians Name</label>
                                            <div class="col-md-9 input-medium">
                                                <input type="text" class="form-control" id="guardian_name" name="guardian_name" placeholder="Guardians Name">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Fathers Occupation</label>
                                            <div class="col-md-9 input-medium input-medium">
                                                <select class="form-control" name="occupation" id="occupation" data-placeholder="Choose a Caste" tabindex="1">
                                                @foreach($occupations as $val)
                                                 <option value="id"> {{ $val->occupation }} </option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->

                                    <!--/span-->
                                </div>
                            </div>
                            <div class="tab-pane" id="tab3">
                               {{-- <h4 class="form-section uppercase font-purple">Address Info</h4>--}}
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Mobile Number 1</label>
                                            <div class="col-md-9 input-medium">
                                                <input type="text" class="form-control" id="mobile_1" name="mobile_1" placeholder="Mobile Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">E-Mail 1</label>
                                            <div class="col-md-9 input-medium">
                                                <input type="text" class="form-control" id="email_1" name="email_1" placeholder="E-Mail">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Mobile Number 2</label>
                                            <div class="col-md-9 input-medium">
                                                <input type="text" id="mobile_2" name="mobile_2" class="form-control" placeholder="Mobile Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">E-Mail 2</label>
                                            <div class="col-md-9 input-medium">
                                                <input type="text" class="form-control" id="email_2" name="email_2" placeholder="E-Mail">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Present Address</label>
                                            <div class="col-md-9 input-small">
                                                <textarea name="present_address" id="present_address" cols="30" rows="6"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Permanent Address</label>
                                            <div class="col-md-9 input-small">
                                                <textarea name="permanent_address" id="permanent_address" cols="30" rows="6"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                            </div>

                            <div class="tab-pane" id="tab4">
                            {{-- <h4 class="form-section uppercase font-purple">Address Info</h4>--}}
                            <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Class</label>
                                            <div class="col-md-9 input-medium">
                                                <select class="form-control" name="class_name" id="class_name" data-placeholder="Class" tabindex="1">
                                                @foreach($classes as $val)
                                                 <option value="id"> {{ $val->class_name }} </option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Section</label>
                                            <div class="col-md-9 input-medium">
                                                <select class="form-control" name="section_name" id="section_name" data-placeholder="Section" tabindex="1">
                                                @foreach($sections as $val)
                                                 <option value="id"> {{ $val->section_name }} </option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Previous School</label>
                                            <div class="col-md-9 input-medium">
                                                <input type="text" class="form-control" name="previous_school" id="previous_school" placeholder="Previous School">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Roll No</label>
                                            <div class="col-md-9 input-medium">
                                                <input type="text" class="form-control" name="roll_no" id="roll_no" placeholder="Roll Number">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                                <!--/row-->
                            </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <a href="javascript:;" class="btn default button-previous">
                                    <i class="fa fa-angle-left"></i> Back </a>
                                <a href="javascript:;" class="btn btn-outline green button-next"> Continue
                                    <i class="fa fa-angle-right"></i>
                                </a>
                                <a href="javascript:;" class="btn green button-submit"> Submit
                                    <i class="fa fa-check"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

{{--END BODY CONTENT--}}

<?php $js = array("js/consessionType.js");?>
@include('layout.footer',array('js' =>$js))