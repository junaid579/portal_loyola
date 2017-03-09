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
{{-- START RETREIVING DATA IN ARRAYS FROM CONTROLLER--}}
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
{{-- END RETREIVING DATA IN ARRAYS FROM CONTROLLER--}}
{{--BEGIN BODY CONTENT--}}
<div class="row">
  <div class="col-md-12">
    <div class="portlet light bordered" id="form_wizard_1">
      <div class="portlet-title">
        <div class="caption">
          <i class=" icon-layers font-red"></i>
          <span class="caption-subject font-red bold uppercase"> Application Form -
          <span class="step-title"> Step 1 of 4 </span>
          </span>
        </div>
      </div>
      {{-- TABS START --}}
      <div class="portlet-body form">
        <form class="form-horizontal" action="admission" id="submit_form" method="POST">
          {{ csrf_field() }}
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
                  <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. 
                </div>
                <div class="alert alert-success display-none">
                  <button class="close" data-dismiss="alert"></button> Your form validation is successful! 
                </div>
                <div class="tab-pane active" id="tab1">
                  {{-- TABS END --}}
                  {{-- FORM FIELDS START --}}
                  {{-- FIRST TAB START --}}
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">First Name
                        <span class="required">*</span>
                        </label>
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
                            <option value="1">Male</option>
                            <option value="0">Female</option>
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
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Religion</label>
                        <div class="col-md-9 input-medium">
                          <select class="form-control" data-placeholder="Choose a Caste" tabindex="1" name="religion" id = "religion">
                            @foreach($religions as $religion)
                            <option value="{{ $religion->id }}"> {{ $religion->religion_name }}</option>
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
                            <option value="{{ $val->id }}"> {{ $val->caste_name }} </option>
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
                            <option value="{{ $val->id }}"> {{ $val->nationality }} </option>
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
                            <option value="{{ $val->id }}"> {{ $val->mother_tongue }} </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- FIRST TAB END --}}
                {{-- SECOND TAB  START --}}
                <div class="tab-pane" id="tab2">
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
                            <option value="{{ $val->id }}"> {{ $val->occupation_details }} </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- THIRD TAB START --}}
                <div class="tab-pane" id="tab3">
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
                        <label class="control-label col-md-3">Permanent Address
                        <span class="required">*</span>
                        </label>
                        <div class="col-md-9 input-small">
                          <textarea name="permanent_address" id="permanent_address" cols="30" rows="6"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- THIRD TAB END --}}
                {{-- FOURTH TAB START --}}
                <div class="tab-pane" id="tab4">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Class</label>
                        <div class="col-md-9 input-medium">
                          <select class="form-control" name="class_name" id="class_name" data-placeholder="Class" tabindex="1">
                            @foreach($classes as $val)
                            <option value="{{ $val->id }}"> {{ $val->class_name }}</option>
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
                            <option  data-class_id ="" selected="selected"> Select</option>
                            @foreach($sections as $val)
                            <option value="{{ $val->id }}" > {{ $val->section_name }} </option>
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
                </div>
                {{-- FOURTH TAB START --}}
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
                <button type="submit" class="btn green button-submit" name="insert_submit" value="insert">Submit</button>
              </div>
            </div>
          </div>
      </div>
      </form>
      {{-- DATA TABLE STARTS --}}
      <div class="row">
        <div class="col-md-12">
          <div class="portlet light bordered">
            <div class="portlet-title">
              <div class="row">
                <div class="col-md-6">
                  <div class="caption font-dark" style="margin-top: 10px;">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> Admissions </span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="btn-group pull-right">
                    <div class="tools"> </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="portlet-body">
              <table class="table table-striped table-bordered table-hover table-checkable order-column">
                <thead>
                  <tr>
                    <th> SNO.</th>
                    <th> First Name </th>
                    <th> Last Name </th>
                    <th> Gender </th>
                    <th> Date Of Birth</th>
                    <th> Religion </th>
                    <th> Caste </th>
                    <th> Nationality </th>
                    <th> Place Of Birth</th>
                    <th> Aadhar Number </th>
                    <th> Mother Tongue  </th>
                    <th> Father's Name </th>
                    <th> Mother's Name</th>
                    <th> Father's Income </th>
                    <th> Guardian's Name </th>
                    <th> Occupation </th>
                    <th> Mobile 1 </th>
                    <th> Mobile 2 </th>
                    <th> Email 1 </th>
                    <th> Email 2 </th>
                    <th> Present Address </th>
                    <th> Permanent Address </th>
                    <th> Class </th>
                    <th> Section </th>
                    <th> Previous School </th>
                    <th> Roll No </th>
                    <th> Status </th>
                    <th> Actions </th>
                  </tr>
                </thead>
                {{-- SEARCH FORM STARTS  --}}
                <tfoot>
                  <tr>
                    <th> - </th>
                    <th> <input type="text" name="search_first_name" id="search_first_name" value="<?php echo $search_first_name;?>" class="form-control form-filter" /></th>
                    <th> <input type="text" name="search_last_name" id="search_last_name" value="<?php echo $search_last_name;?>" class="form-control form-filter" /></th>
                    <th> <input type="text" name="search_gender" id="search_gender" value="<?php echo $search_gender;?>" class="form-control form-filter" /></th>
                    <th> <input type="text" name="search_date_of_birth" id="search_date_of_birth" value="<?php echo $search_date_of_birth;?>" class="form-control form-filter" /></th>
                    <th>
                      <select name="search_religion" id="search_religion" class="form-control form-filter">
                        <option value="" selected="selected">Select</option>
                        <?php foreach ($religions as $religion) {
                          $selected = "";
                          if ($search_religion == $religion->id) {
                          $selected = 'selected="selected"';
                          }?>
                        <option value="<?php echo $class->id;?>" <?php echo $selected; ?> > 
                          <?php echo $religion->religion_name;?>
                        </option>
                        <?php }?>
                      </select>
                    </th>
                    <th>
                      <select name="search_caste" id="search_caste" class="form-control form-filter">
                        <option value="" selected="selected">Select</option>
                        <?php foreach ($castes as $caste) {
                          $selected = "";
                          if ($search_caste == $caste->id) {
                          $selected = 'selected="selected"';
                          }?>
                        <option value="<?php echo $caste->id;?>" <?php echo $selected; ?> > 
                          <?php echo $caste->caste_name;?>
                        </option>
                        <?php }?>
                      </select>
                    </th>
                    <th>
                      <select name="search_nationality" id="search_nationality" class="form-control form-filter">
                        <option value="" selected="selected">Select</option>
                        <?php foreach ($nationalities as $nationality) {
                          $selected = "";
                          if ($search_nationality == $nationality->id) {
                          $selected = 'selected="selected"';
                          }?>
                        <option value="<?php echo $nationality->id;?>" <?php echo $selected; ?> > 
                          <?php echo $nationality->nationality;?>
                        </option>
                        <?php }?>
                      </select>
                    </th>
                    <th> <input type="text" name="search_birth_place" id="search_birth_place" value="<?php echo $search_birth_place;?>" class="form-control form-filter" /></th>
                    <th> <input type="text" name="search_aadhar_no" id="search_aadhar_no" value="<?php echo $search_aadhar_no;?>" class="form-control form-filter" /></th>
                    <th>
                      <select name="search_mother_tongue" id="search_mother_tongue" class="form-control form-filter">
                        <option value="" selected="selected">Select</option>
                        <?php foreach ($mothertongues as $mothertongue) {
                          $selected = "";
                          if ($search_mother_tongue == $mothertongue->id) {
                          $selected = 'selected="selected"';
                          }?>
                        <option value="<?php echo $mothertongue->id;?>" <?php echo $selected; ?> > 
                          <?php echo $mothertongue->mother_tongue;?>
                        </option>
                        <?php }?>
                      </select>
                    </th>
                    <th> <input type="text" name="search_father_name" id="search_father_name" value="<?php echo $search_father_name;?>" class="form-control form-filter" /></th>
                    <th> <input type="text" name="search_mother_name" id="search_mother_name" value="<?php echo $search_mother_name;?>" class="form-control form-filter" /></th>
                    <th> <input type="text" name="search_father_income" id="search_father_income" value="<?php echo $search_father_income;?>" class="form-control form-filter" /></th>
                    <th> <input type="text" name="search_guardian_name" id="search_guardian_name" value="<?php echo $search_guardian_name;?>" class="form-control form-filter" /></th>
                    <th>
                      <select name="search_occupation_id" id="search_occupation_id" class="form-control form-filter">
                        <option value="" selected="selected">Select</option>
                        <?php foreach ($occupations as $occupation) {
                          $selected = "";
                          if ($search_occupation_id == $occupation->id) {
                          $selected = 'selected="selected"';
                          }?>
                        <option value="<?php echo $occupation->id;?>" <?php echo $selected; ?> > 
                          <?php echo $occupation->occupation_details;?>
                        </option>
                        <?php }?>
                      </select>
                    </th>
                    <th> <input type="text" name="search_mobile_1" id="search_mobile_1" value="<?php echo $search_mobile_1;?>" class="form-control form-filter" /></th>
                    <th> <input type="text" name="search_mobile_2" id="search_mobile_2" value="<?php echo $search_mobile_2;?>" class="form-control form-filter" /></th>
                    <th> <input type="text" name="search_email_1" id="search_email_1" value="<?php echo $search_email_1;?>" class="form-control form-filter" /></th>
                    <th>
                    <th> <input type="text" name="search_email_2" id="search_email_2" value="<?php echo $search_email_2;?>" class="form-control form-filter" /></th>
                    <th>
                    <th> <input type="text" name="search_present_address" id="search_present_address" value="<?php echo $search_present_address;?>" class="form-control form-filter" /></th>
                    <th>
                    <th> <input type="text" name="search_permanent_address" id="search_permanent_address" value="<?php echo $search_permanent_address;?>" class="form-control form-filter" /></th>
                    <th>
                      <select name="search_class" id="search_class" class="form-control form-filter">
                        <option value="" selected="selected">Select</option>
                        <?php foreach ($classes as $class) {
                          $selected = "";
                          if ($search_class == $class->id) {
                          $selected = 'selected="selected"';
                          }?>
                        <option value="<?php echo $class->id;?>" <?php echo $selected; ?> > 
                          <?php echo $class->class_name;?>
                        </option>
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
                        <option value="<?php echo $section->id;?>" <?php echo $selected; ?> > 
                          <?php echo $section->section_name;?>
                        </option>
                        <?php }?>
                      </select>
                    </th>
                    <th> <input type="text" name="search_previous_school" id="search_previous_school" value="<?php echo $search_previous_school;?>" class="form-control form-filter" /></th>
                    <th> <input type="text" name="search_roll_no" id="search_roll_no" value="<?php echo $search_roll_no;?>" class="form-control form-filter"/></th>
                  </tr>
                </tfoot>
                {{-- SEARCH FORM ENDS --}}
                <tbody>
                  <?php $i = 1;?>
                  @foreach($alladmissions as $admissions)
                  <?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
                    ?>
                  <tr class="<?php echo $odd_even;?>">
                    <td class="SNO"> </td>
                    <td> {{ $admissions->first_name }} </td>
                    <td> {{ $admissions->last_name }} </td>
                    <td> {{ $admissions->gender }} </td>
                    <td> {{ $admissions->date_of_birth }} </td>
                    <td> {{ $religionnames[$admissions->religion] }} </td>
                    <td> {{ $castenames[$admissions->caste] }} </td>
                    <td> {{ $nationalitynames[$admissions->nationality] }} </td>
                    <td> {{ $admissions->birth_place }} </td>
                    <td> {{ $admissions->aadhar_no }} </td>
                    <td> {{ $mothertonguenames[$admissions->mother_tongue] }} </td>
                    <td> {{ $admissions->father_name }} </td>
                    <td> {{ $admissions->mother_name }} </td>
                    <td> {{ $admissions->father_income }} </td>
                    <td> {{ $admissions->guardian_name }} </td>
                    <td> {{ $occupationnames[$admissions->occupation] }} </td>
                    <td> {{ $admissions->mobile_1 }} </td>
                    <td> {{ $admissions->mobile_2 }} </td>
                    <td> {{ $admissions->email_1 }} </td>
                    <td> {{ $admissions->email_2 }} </td>
                    <td> {{ $admissions->present_address }} </td>
                    <td> {{ $admissions->permanent_address }} </td>
                    <td> {{ $classnames[$admissions->class_name] }} </td>
                    <td> {{ $sectionnames[$admissions->section_name] }} </td>
                    <td> {{ $admissions->previous_school }} </td>
                    <td> {{ $admissions->roll_no }} </td>
                    <td>    <?php if ($admissions->status == 1) {?>
                      <span class="label label-sm label-info"> Active </span>
                      <?php } else if ($admissions->status == 2) {?>
                      <span class="label label-sm label-warning"> Suspended </span>
                      <?php } else if ($admissions->status == 0) {?>
                      <span class="label label-sm label-danger"> Deleted </span>
                      <?php }?>
                    </td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"> Actions
                        <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu">
                          <li class="divider"> </li>
                          @if ($admissions->status==1)
                          <li>
                            <a href="admission/{{ $admissions->id }}/2">
                            <i class="fa fa-flag font-yellow" aria-hidden="true"></i> Suspend  </a>
                          </li>
                          <li>
                            <a href="admission/{{ $admissions->id }}/0">
                            <i class="fa fa-trash font-red" aria-hidden="true"></i> Delete  </a>
                          </li>
                          @endif
                          @if ($admissions->status==2)
                          <li>
                            <a href="admission/{{ $admissions->id }}/1">
                            <i class="icon-flag"></i> Activate  </a>
                          </li>
                          <li>
                            <a href="admission/{{ $admissions->id }}/0">
                            <i class="fa fa-trash" aria-hidden="true"></i> Delete  </a>
                          </li>
                          @endif
                          <?php if ($admissions->status == 1) {?>
                          <li>
                            <?php } else if ($admissions->status == 2) {?>
                          <li>
                            <?php }?>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  @endforeach 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>    
</div>
</div>
</div>
</div>
{{--END BODY CONTENT--}}
<?php $js = array("js/consessionType.js");?>
@include('layout.footer',array('js' =>$js))