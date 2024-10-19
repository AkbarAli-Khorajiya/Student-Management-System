<!DOCTYPE html>

<?php
        include "includes\header.php";
    ?>
<div class="content-container">
    <div class="row mt-20">
        <div class="column-3">
            <a href="courses.php">
                <div class="card gradient-cyan">
                    <div class="card-body">
                        <div class="card-content">
                            <div class="c-icon"><i class="fa-solid fa-book-open-reader text-white"></i></div>
                            <div class="card-content-body">
                                <h4 class="text-white ml-20" id="total_course"><?php echo $obj->total_course();?></h4>
                                <p class="text-white ml-20 extra-small-font">Total Courses</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="column-3">
            <a>
                <div class="card gradient-pink">
                    <div class="card-body">
                        <div class="card-content">
                            <div class="c-icon"><i class="fa-solid fa-door-open text-white"></i></div>
                            <div class="card-content-body">
                                <h4 class="text-white ml-20" id="total_class">60</h4>
                                <p class="text-white ml-20 extra-small-font">Total Classes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="column-3">
            <a href="students.php">
                <div class="card gradient-green">
                    <div class="card-body">
                        <div class="card-content">
                            <div class="c-icon"><i class="fa-solid fa-graduation-cap text-white"></i></div>
                            <div class="card-content-body">
                                <h4 class="text-white ml-20" id="total_student"><?php echo $obj->total_student();?></h4>
                                <p class="text-white ml-20 extra-small-font">Total Students</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="column-3">
            <a href="teachers.php">
                <div class="card gradient-orange">
                    <div class="card-body">
                        <div class="card-content">
                            <div class="c-icon"><i class="fa-solid fa-person-chalkboard text-white"></i></div>
                            <div class="card-content-body">
                                <h4 class="text-white ml-20" id="total_teacher"><?php echo $obj->total_teacher();?></h4>
                                <p class="text-white ml-20 extra-small-font">Total Teachers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
</div>
</div>

<script src="<?php echo $site_url;?>assets\js\custom.js"></script>

</body>

</html>