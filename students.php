<?php include "includes\header.php"; ?>

<div class="content-container">
    <div class="row mt-20">
        <div class="row m-10">
            <!-- breadcrumb -->
            <div class="column-6">
                <b>
                    <p class="secondary breadcrumb">Dashboard/Students</p>
                </b>
            </div>
            <!-- breadcrumb -->
            <div class="column-6">
                <div class="add-data">
                    <button class="fa-regular fa-plus" id="add-student"> Add Student</button>
                </div>
            </div>
        </div>
        <div class="data-table">
            <div class="row pb-10">
                <div class="column-6">
                    <h1 class="dark">Students</h1>
                </div>
                <!-- <div class="column-6" style="display:flex;justify-content:right;align-items:start;">
                    <h3 class="dark">Total Students :<span id="total_student"></span></h3>
                </div> -->
                <div class="column-6">
                    <div class="filter">
                        <input type="search" placeholder="Search" name="student_search" id="student_search"
                            class="student_search">
                    </div>
                </div>
            </div>
            <div class="row pb-10">
                <div class="column-6" id="response_msg">
                    <!---------- -->
                </div>
            </div>
            <table class="table" id="tbl-students">
                <!-- --------- -->
            </table>
            <div class="row mt-10">
                <div class="column-6">
                    <p id="std-showEntries">
                        <!-- --- -->
                    </p>
                </div>
                <div class="column-6">
                    <div class="pagination" id="pagination-students">
                        <!-- ---------- -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <button>Previous</button><button>Next</button> -->
</div>
</div>
</div>




<!-- ---------------Add Students Model--------------- -->
<div id="add-student-modal" class="modal">
    <!-- Modal content -->
    <div class="student-modal-content">
        <div class="modal-header b-bottom">
            <h2>Add Students</h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <form class="form-inline" action="" method="post" id="form-add-students">
                <div class="nice-form-group">
                    <label for="student_name">Name:</label>
                    <div class="inside-input">
                        <input class="col-4-in" type="text" id="student_fname" class="f_name"
                            placeholder="Enter First Name" name="fname" required>
                        <input class="col-4-in" type="text" id="student_mname" class="m_name"
                            placeholder="Enter Middle Name" name="mname" required>
                        <input class="col-4-in" type="text" id="student_lname" class="l_name"
                            placeholder="Enter Last Name" name="lname" required>
                    </div>
                    <div class="inside-input">
                        <div class="col-6 pr-5">
                            <label for="email" class="dark"><strong>Email:</strong></label><br>
                            <input type="email" id="student_fname" class="c_name" placeholder="Enter email address"
                                name="email" required>
                        </div>
                        <div class="col-6 pr-5">
                            <label for="mobile" class="dark"><strong>Mobile No:</strong></label><br>
                            <input type="text" id="mobile" class="mobile" placeholder="Enter Mobile No" name="mobile"
                                required>
                        </div>
                    </div>
                </div>
                <div class="nice-form-group">

                    <div class="inside-input">
                        <div class="col-4 pr-5">
                            <label for="courses" class="dark"><strong>Course:</strong></label><br>
                            <select name="course" id="courses">
                                <?php echo $obj->list_only_courses();?>
                            </select>
                        </div>
                        <div class="col-4 pr-5">
                            <label for="class" class="dark"><strong>Class:</strong></label><br>
                            <select name="class" id="class">
                                <?php echo $obj->list_only_classes();?>
                            </select>
                        </div>
                        <div class="col-4 pr-5">
                            <label for="class" class="dark"><strong>Status:</strong></label><br>
                            <select name="status" id="status">
                                <option value="1">Active</option>
                                <option value="0">In-Active</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="nice-form-group b-bottom">
                    <label for="address">Address:</label>
                    <div class="inside-input">
                        <input class="col-4-in" type="text" id="village" class="village" placeholder="Village"
                            name="village" required>
                        <input class="col-4-in" type="text" id="city" class="city" placeholder="City" name="city"
                            required>
                        <input class="col-4-in" type="text" id="state" class="state" placeholder="State" name="state"
                            required>
                    </div>
                    <div class="inside-input">
                        <div class="col-6 pr-5">
                            <input type="text" id="country" class="country" placeholder="Country" name="country"
                                required>
                        </div>
                        <div class="col-6 pr-5">
                            <input type="text" id="pincode" class="pincode" placeholder="Pincode" name="pincode"
                                required>
                        </div>
                    </div>
                </div>

                <button type="submit">Submit</button>
            </form>
        </div>

    </div>

</div>


<!-- =================edit student model=============== -->

<div id="edit-student-modal" class="modal">

    <!-- Modal content -->
    <div class="student-modal-content">
        <div class="modal-header b-bottom">
            <h2>Add Course</h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <form class="form-inline" action="" method="post" id="form-edit-students">
                <p class="edit_error"></p>
                <div class="nice-form-group">
                    <label for="edit-student_name">Name:</label>
                    <div class="inside-input ">
                        <input class="col-4-in edit_f_name" type="text" id="edit_student_fname"
                            placeholder="Enter First Name" name="edit_fname" required>
                        <input class="col-4-in edit_m_name" type="text" id="edit_student_mname"
                            placeholder="Enter Middle Name" name="edit_mname" required>
                        <input class="col-4-in edit_l_name" type="text" id="edit_student_lname"
                            placeholder="Enter Last Name" name="edit_lname" required>
                    </div>
                    <div class="inside-input">
                        <div class="col-6 pr-5">
                            <label for="edit_student_email" class="dark"><strong>Email:</strong></label><br>
                            <input type="email" id="edit_student_email" class="edit_student_email"
                                placeholder="Enter email address" name="edit_email" required>
                        </div>
                        <div class="col-6 pr-5">
                            <label for="edit_mobile" class="dark"><strong>Mobile No:</strong></label><br>
                            <input type="text" id="edit_mobile" class="edit_mobile" placeholder="Enter Mobile No"
                                name="edit_mobile" required>
                        </div>
                    </div>
                </div>
                <div class="nice-form-group">
                    <div class="inside-input">
                        <div class="col-4 pr-5">
                            <label for="edit_courses" class="dark"><strong>Course:</strong></label><br>
                            <select name="edit_course" id="edit_courses">
                                <?php echo $obj->list_only_courses();?>
                            </select>
                        </div>
                        <div class="col-4 pr-5">
                            <label for="edit_class" class="dark"><strong>Class:</strong></label><br>
                            <select name="edit_class" id="edit_class">
                                <?php echo $obj->list_only_classes();?>
                            </select>
                        </div>
                        <div class="col-4 pr-5">
                            <label for="edit_status" class="dark"><strong>Status:</strong></label><br>
                            <select name="edit_status" id="edit_status">
                                <option value="1">Active</option>
                                <option value="0">In-Active</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="nice-form-group b-bottom">
                    <label for="edit_address">Address:</label>
                    <div class="inside-input">
                        <input class="col-4-in" type="text" id="edit_village" class="edit_village" placeholder="Village"
                            name="edit_village" required>
                        <input class="col-4-in" type="text" id="edit_city" class="edit_city" placeholder="City"
                            name="edit_city" required>
                        <input class="col-4-in" type="text" id="edit_state" class="edit_state" placeholder="State"
                            name="edit_state" required>
                    </div>
                    <div class="inside-input">
                        <div class="col-6 pr-5">
                            <input type="text" id="edit_country" class="edit_country" placeholder="Country"
                                name="edit_country" required>
                        </div>
                        <div class="col-6 pr-5">
                            <input type="text" id="edit_pincode" class="edit_pincode" placeholder="Pincode"
                                name="edit_pincode" required>
                            <input type="hidden" name="sid" id="sid" value="">
                        </div>
                    </div>
                </div>

                <button type="submit">Submit</button>
            </form>
        </div>

    </div>

</div>

<!-- ==================view modal============ -->

<div id="view-student-modal" class="modal">
    <!-- Modal content -->
    <div class="student-modal-content">
        <div class="modal-header b-bottom">
            <h2>Student Details</h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <div class="row b-bottom">
                <div class="column-6 ">
                    <div class="std pt-10 b-bottom b-right">
                        <div>
                            <h3 class="dark">Name :</h3>
                        </div>
                        <div class="ml-10">
                            <h3 id="view_student_fname"></h3>
                            <h3 id="view_student_mname"></h3>
                            <h3 id="view_student_lname"></h3>
                        </div>
                    </div>
                    <div class="std pt-10 b-bottom b-right">
                        <div>
                            <h3 class="dark">Email :</h3>
                        </div>
                        <div class="ml-10">
                            <h3 id="view_student_email"></h3>
                        </div>
                    </div>
                    <div class="std pt-10 b-bottom b-right">
                        <div>
                            <h3 class="dark">Mobile No :</h3>
                        </div>
                        <div class="ml-10">
                            <h3 id="view_mobile"></h3>
                        </div>
                    </div>
                    <div class="std pt-10 b-right">
                        <div>
                            <h3 class="dark">Address :</h3>
                        </div>
                        <div class="ml-10">
                            <span id="view_village" class="ad-font"></span>
                            <span id="view_city" class="ad-font"></span><br>
                            <span id="view_state" class="ad-font"></span>
                            <span id="view_country" class="ad-font"></span><br>
                            <span id="view_pincode" class="ad-font"></span>
                        </div>
                    </div>
                </div>
                <div class="column-6">

                    <div class="std pt-10 b-bottom ">
                        <div>
                            <h3 class="dark ml-10">Course :</h3>
                        </div>
                        <div class="ml-10">
                            <h3 id="view_courses"></h3>
                        </div>
                    </div>
                    <div class="std pt-10 b-bottom ">
                        <div>
                            <h3 class="dark ml-10">Class :</h3>
                        </div>
                        <div class="ml-10">
                            <h3 id="view_class"></h3>
                        </div>
                    </div>
                    <div class="std pt-10 b-bottom ">
                        <div>
                            <h3 class="dark ml-10">Status :</h3>
                        </div>
                        <div class="ml-10">
                            <h3 id="view_status"></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="<?php echo $site_url;?>assets\js\custom.js"></script>

</body>

</html>