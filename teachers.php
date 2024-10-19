<?php
        include "includes\header.php";
    ?>

<div class="content-container">
    <div class="row mt-20">
        <div class="row m-10">
            <!-- breadcrumb -->
            <div class="column-6">
                <b>
                    <p class="secondary breadcrumb">Dashboard/Teachers</p>
                </b>
            </div>
            <!-- breadcrumb -->
            <div class="column-6">
                <div class="add-data">
                    <button class="fa-solid fa-plus" id="add-teacher"> Add Teacher</button>
                </div>
            </div>
        </div>
        <div class="data-table">
            <div class="row pb-10">
                <div class="column-6">
                    <h1 class="dark">Teachers</h1>
                </div>
                <div class="column-6">
                    <div class="filter">
                        <input type="search" placeholder="Search" name="teacher_search" class="teacher_search"
                            id="teacher_search">
                    </div>
                </div>
            </div>
            <div class="row pb-10">
                <div class="column-6" id="response_msg">
                    <!---------- -->
                </div>
                
            </div>
            <table class="table" id="tbl-teachers">
                <!-- ---------------- -->
                <?php //echo $obj->list_all_teachers(); ?>
                </tbody>
            </table>
            <div class="row mt-10">
            <div class="column-6">
                    <p id="teacher-showEntries">
                        <!-- --- -->
                    </p>
                </div>
                <div class="column-6">
                <div class="pagination" id="pagination-teachers">
                        <!-- ----- -->
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>



<!-- ---------------Add teacher Model--------------- -->
<div id="add-teacher-modal" class="modal">
    <!-- Modal content -->
    <div class="teacher-modal-content">
        <div class="modal-header b-bottom">
            <h2>Add Teacher</h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <form class="form-inline" action="" method="post" id="form-add-teacher">
                <div class="nice-form-group">
                    <label for="teacher_name">Name:</label>
                    <div class="inside-input">
                        <input class="col-4-in" type="text" id="teacher_fname" class="f_name"
                            placeholder="Enter First Name" name="fname" required>
                        <input class="col-4-in" type="text" id="teacher_mname" class="m_name"
                            placeholder="Enter Middle Name" name="mname" required>
                        <input class="col-4-in" type="text" id="teacher_lname" class="l_name"
                            placeholder="Enter Last Name" name="lname" required>
                    </div>
                    <div class="inside-input">
                        <div class="col-6 pr-5">
                            <label for="email" class="dark"><strong>Email:</strong></label><br>
                            <input type="email" id="teacher_fname" class="c_name" placeholder="Enter email address"
                                name="email" required>
                        </div>
                        <div class="col-6 pr-10">
                            <label for="mobile" class="dark"><strong>Mobile No:</strong></label><br>
                            <input type="text" id="mobile" class="mobile" placeholder="Enter Mobile No" name="mobile"
                                required>
                        </div>
                    </div>
                </div>
                <div class="nice-form-group">

                    <div class="inside-input">
                        <div class="col-6 pr-5">
                            <label for="courses" class="dark"><strong>Course:</strong></label><br>
                            <select name="course" id="courses">
                                <?php echo $obj->list_only_courses();?>
                            </select>
                        </div>
                        <div class="col-6 pr-10">
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
                        <div class="col-6 pr-10">
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

<div id="edit-teacher-modal" class="modal">

    <!-- Modal content -->
    <div class="teacher-modal-content">
        <div class="modal-header b-bottom">
            <h2>Add Course</h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <form class="form-inline" action="" method="post" id="form-edit-teacher">
                <p class="edit_error"></p>
                <div class="nice-form-group">
                    <label for="edit-teacher_name">Name:</label>
                    <div class="inside-input ">
                        <input class="col-4-in edit_f_name" type="text" id="edit_teacher_fname"
                            placeholder="Enter First Name" name="edit_fname" required>
                        <input class="col-4-in edit_m_name" type="text" id="edit_teacher_mname"
                            placeholder="Enter Middle Name" name="edit_mname" required>
                        <input class="col-4-in edit_l_name" type="text" id="edit_teacher_lname"
                            placeholder="Enter Last Name" name="edit_lname" required>
                    </div>
                    <div class="inside-input">
                        <div class="col-6 pr-5">
                            <label for="edit_teacher_email" class="dark"><strong>Email:</strong></label><br>
                            <input type="email" id="edit_teacher_email" class="edit_teacher_email"
                                placeholder="Enter email address" name="edit_email" required>
                        </div>
                        <div class="col-6 pr-10">
                            <label for="edit_mobile" class="dark"><strong>Mobile No:</strong></label><br>
                            <input type="text" id="edit_mobile" class="edit_mobile" placeholder="Enter Mobile No"
                                name="edit_mobile" required>
                        </div>
                    </div>
                </div>
                <div class="nice-form-group">
                    <div class="inside-input">
                        <div class="col-6 pr-5">
                            <label for="edit_courses" class="dark"><strong>Course:</strong></label><br>
                            <select name="edit_course" id="edit_courses">
                                <?php echo $obj->list_only_courses();?>
                            </select>
                        </div>
                        <div class="col-6 pr-10">
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
                        <div class="col-6 pr-10">
                            <input type="text" id="edit_pincode" class="edit_pincode" placeholder="Pincode"
                                name="edit_pincode" required>
                            <input type="hidden" name="tid" id="tid" value="">
                        </div>
                    </div>
                </div>

                <button type="submit">Submit</button>
            </form>
        </div>

    </div>

</div>


<script src="<?php echo $site_url;?>assets\js\custom.js"></script>

</body>

</html>