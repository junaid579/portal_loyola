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
<div class="row">
    <div class="col-md-12">                    
        <div class="portlet light bordered" id="form_wizard_1">               
            <div class="portlet-body form">
                <form class="form-horizontal" action="#" id="submit_form" method="POST">
                    <div class="form-wizard">
                        <div class="form-body">
                            <ul class="nav nav-pills nav-justified steps">
                                <li>
                                <a href="#tab1" data-toggle="tab" class="step">
                                <span class="number"> 1 </span>
                                <span class="desc">
                                <i class="fa fa-check"></i> Personal Details </span>
                                </a>
                                </li>
                                <li>
                                <a href="#tab2" data-toggle="tab" class="step">
                                <span class="number"> 2 </span>
                                <span class="desc">
                                <i class="fa fa-check"></i> Communication Details</span>
                                </a>
                                </li>
                                <li>
                                <a href="#tab3" data-toggle="tab" class="step">
                                <span class="number"> 2 </span>
                                <span class="desc">
                                <i class="fa fa-check"></i> Educational Details</span>
                                </a>
                                </li>
                                            
                            </ul>
                            <div id="bar" class="progress progress-striped" role="progressbar">
                                <div class="progress-bar progress-bar-success"> </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">First Name</label>
                                            <div class="col-md-9">
                                                <input type="text" name = "f_name" id = "f_name" class="form-control" placeholder="First Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Last Name</label>
                                            <div class="col-md-9">
                                                <input type="text" name = "l_name" id = "l_name" class="form-control" placeholder="Last Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Date Of Birth</label>
                                            <div class="col-md-9">
                                                <div class="input-group input-medium date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                    <input type="text" class="form-control" readonly="">
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Gender</label>
                                            <div class="col-md-9">
                                                <select name="foo" class="form-control">
                                                    <option value="1">Male</option>
                                                    <option value="1">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Father's Name</label>
                                            <div class="col-md-9">
                                                <input type="text" name = "father_name" id = "father_name" class="form-control" placeholder="Father's Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Occupation</label>
                                            <div class="col-md-9">
                                                <select name="foo" class="form-control">
                                                    <option value="1">Farmer</option>
                                                    <option value="1">Option 2</option>
                                                    <option value="1">Option 3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Father's Income</label>
                                            <div class="col-md-9">
                                                <input type="text" name = "father_income" id = "father_income" class="form-control" placeholder="Father's Income">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Aadhar Number</label>
                                            <div class="col-md-9">
                                                <input type="text" name = "aadhar_no" id = "aadhar_no" class="form-control" placeholder="Aadhar Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Mother's Name </label>
                                            <div class="col-md-9">
                                                <input type="text" name = "mother_name" id = "mother_name" class="form-control" placeholder="Mother's Name ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Guardian's Name</label>
                                            <div class="col-md-9">
                                                <input type="text" name = "guardian_name" id = "guardian_name" class="form-control" placeholder="Guardian's Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Nationality</label>
                                            <div class="col-md-9">
                                                <select name="foo" class="form-control">
                                                    <option value="1">Indian</option>
                                                    <option value="1">Option 2</option>
                                                    <option value="1">Option 3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Mother Tongue</label>
                                            <div class="col-md-9">
                                                <select name="foo" class="form-control">
                                                    <option value="1">Telugu</option>
                                                    <option value="1">Option 2</option>
                                                    <option value="1">Option 3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Religion</label>
                                            <div class="col-md-9">
                                                <select name="foo" class="form-control">
                                                    <option value="1">Hinduism</option>
                                                    <option value="1">Option 2</option>
                                                    <option value="1">Option 3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Caste</label>
                                            <div class="col-md-9">
                                                <select name="foo" class="form-control">
                                                    <option value="1">OC</option>
                                                    <option value="1">Option 2</option>
                                                    <option value="1">Option 3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Place of Birth</label>
                                            <div class="col-md-9">
                                                <input type="text" name = "birth_place" id = "birth_place" class="form-control" placeholder="Place of Birth">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Mobile </label>
                                            <div class="col-md-9">
                                                <input type="text" name = "mobile_1" id = "mobile_1" class="form-control" placeholder="Mobile 1">
                                            </div>
                                        </div>
                                    </div>                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">email</label>
                                            <div class="col-md-9">
                                                <input type="text" name = "email_id" id = "email_id" class="form-control" placeholder="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Present Address</label>
                                            <div class="col-md-9">
                                                 <textarea rows="10" cols="50" placeholder="Enter your Present Address">
                                                
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Permanent Address</label>
                                            <div class="col-md-9">
                                                 <textarea rows="10" cols="50" placeholder="Enter your Permanent Address">
                                               
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab3">                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Section</label>
                                            <div class="col-md-9">
                                                <select name="foo" class="form-control">
                                                    <option value="1">Farmer</option>
                                                    <option value="1">Option 2</option>
                                                    <option value="1">Option 3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Section</label>
                                            <div class="col-md-9">
                                                <select name="foo" class="form-control">
                                                    <option value="1">Farmer</option>
                                                    <option value="1">Option 2</option>
                                                    <option value="1">Option 3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Roll Number</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Previous School</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"> </div>
                                        </div>
                                    </div>               
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
                </form>
            </div>
        </div>
    </div>
</div>

<?php $js = array("js/consessionType.js");?>
@include('layout.footer',array('js' =>$js))