<?php include "includes\header.php"; ?>

<div class="content-container">
    <div class="row mt-20">
        <div class="row m-10">
            <!-- breadcrumb -->
            <div class="column-6">
                <b>
                    <p class="secondary breadcrumb">Dashboard/Courses</p>
                </b>
            </div>
            <!-- breadcrumb -->
            <div class="column-6">
                <div class="add-data">
                    <button class="fa-regular fa-plus" id="add-course"> Add Course</button>
                </div>
            </div>
        </div>
        <div class="data-table">
            <div class="row pb-10">
                <div class="column-6">
                    <h1 class="dark">Courses </h1>
                </div>
                <!-- <div class="column-6" style="display:flex;justify-content:right;align-items:start;">
                    <h3 class="dark">Total Courses :<span id="total_course"></span></h3>
                </div> -->
                <div class="column-6">
                    <div class="filter">
                        <input type="search" placeholder="Search" class="course_search" name="course_search" id="course_search">
                    </div>
                </div>
            </div>
            <div class="row pb-10">
                <div class="column-6" id="response_msg">
                        <!---------- -->
                </div>
                
            </div>
            <table class="table" id="tbl-courses">

            </table>
            <div class="row mt-10">
                <div class="column-6">
                    <p id="course-showEntries">
                        <!-- --- -->
                    </p>
                </div>
                <div class="column-6">
                    <div class="pagination" id="pagination-courses">
                        <!-- ---------- -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>


<!-- ---------------Add Course Model--------------- -->
<div id="add-course-modal" class="modal">

    <!-- Modal content -->
    <div class="course-modal-content">
        <div class="modal-header b-bottom">
            <h2>Add Course</h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <form class="form-inline" action="" method="post" id="form-add-course">
                <div class="nice-form-group">
                    <label for="course_name">Course Name:</label>
                    <input type="text" id="course_name" class="c_name" placeholder="Enter Course Name" name="course_name">
                </div>

                <div class="nice-form-group b-bottom">
                    <label for="status">Status:</label>
                    <select name="status" id="status">
                        <option value="1" class="opt">Active</option>
                        <option value="0" class="opt">In-active</option>
                    </select>
                </div>                              
                <button type="submit">Submit</button>
            </form>
        </div>

    </div>

</div>

<!-- ---------------Edit Course Model--------------- -->
<div id="edit-course-modal" class="modal">

    <!-- Modal content -->
    <div class="course-modal-content">
        <div class="modal-header b-bottom">
            <h2>Add Course</h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <form class="form-inline" action="" method="post" id="form-edit-course">

                <div class="nice-form-group">
                    <label for="edit_course_name">Course Name:</label>
                    <input type="text" id="edit_course_name" class="edit_c_name" placeholder="Enter Course Name" name="edit_course_name">
                </div>

                <div class="nice-form-group b-bottom">
                    <label for="edit_status">Status:</label>
                    <select name="edit_status" id="edit_status">
                        <option value="1" class="opt">Active</option>
                        <option value="0" class="opt">In-active</option>
                    </select>
                </div>               
                <input type="hidden" name="cid" id="cid" value="">               
                <button type="submit">Submit</button>
            </form>
        </div>

    </div>

</div>


<script src="<?php echo $site_url;?>assets\js\custom.js"></script>

</body>

</html>