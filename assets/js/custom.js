let site_url = 'http://localhost/project/StudentManagementSystem/';

$(document).ready(function () {


    //////
    // $('#passwordcheck').hide();

    // $("#email").keyup(function () {

    //     alert( $('#email').val());
    //     const email = document.getElementById("email"); 
    //     let regex =/^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
    //     let s = email.value;
    //     if (regex.test(s)) {

    //     } else {

    //     }
    // });

    //----------signin validation-------------------

    $('#loginform').submit(function (e) {
        e.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();
        $('.error').remove();
        if (email.length < 1) {
            $('.email').after('<span class="error">please enter email Id</span>');
            return false;
        }
        else {
            var pattern = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
            if (!(pattern.test(email))) {
                $('.email').after('<span class="error">please enter valid email Id</span>');
                return false;
            }
        }
        if (password.length < 5) {
            $('.password').after('<span class="error">Password must be alteast 5 character long</span>');
            return false;
        }
        //------------------signin ajaxcall----------------

        var data = $('#loginform').serialize();
        $.ajax({
            type: "POST",
            url: site_url + "config/ajaxFunction.php?ch=1",
            data: data,
            encode: true,
        }).done(function (data) {
            if (data == 1) {
                window.location = site_url + "dashboard.php";
            }
            else {
                $('.alert').html(data);
            }
        });
    });


    //--------------logout ajaxcall---------------------

    $("#logout").click(function () {
        $.ajax({
            type: "GET",
            url: site_url + "config/ajaxFunction.php?ch=2",
            encode: true,
        }).done(function (data) {
            console.log(data);
            if (data == 1) {
                window.location = site_url;
            }
        });
    });

    // ===================List course===========

    function list_all_courses(pageNo,search) {
        if(pageNo == undefined)
        {
            page_No = 1;
        }
        else{
            page_No = pageNo;
        }

        if(search == undefined)
        {
            search = '';
        }
        else{
            search = search;
        }
        $.ajax({
            type: "POST",
            url: site_url + "config/ajaxFunction.php?ch=3",
            data : {page_no : page_No, search:search},
            encode: true,
        }).done(function (data) {
            var dataArr = data.split('||');
            $('#tbl-courses').html(dataArr[0]);
            $('#total_course').html(dataArr[1])            
            $('#pagination-courses').html(dataArr[2]);
            $('#course-showEntries').html(dataArr[3]);
        });
    }

    list_all_courses();

    $('#tbl-courses').on("click", ".course-delete", function () {
        if (confirm("Are you sure want to delete this course?") == true) {
            var id = this.id;
            $.post(site_url + "config/ajaxFunction.php",
                {
                    ch: "4",
                    id: id
                },
                function (data, status) {
                    if (data == 1) {
                        list_all_courses();
                        $('#response_msg').html('<div class="alert alert-success"><span class="alert-message"><strong>Success! </strong>Course deleted successfully.</span> </div>'
                        );
                    }
                    else {
                        $('#response_msg').html(data);
                    }
                    setTimeout(() => {
                        $('#response_msg').html('');
                    }, 5000);
                });
        }
    });
    /////

    // ===================search course===============
    $('.course_search').keyup(function (e) {
        e.preventDefault();

        const data = $('#course_search').val();
        
        if (data == 'active' || data == 'Active') {
            var status = 1;
        }
        if (data == 'in-active' || data == 'In-active' || data == 'In-Active') {
            var status = 0;
        }
        if (data.length == 0) 
        {
            list_all_courses();
        }else
        {           
            list_all_courses(1,data);
        }

        $.post(site_url + "config/ajaxFunction.php",
            {
                ch: "14",
                search: data,
                course_status: status
            },
            function (data, status) {
                console.log(data);
                $('#tbl-courses').html(data);
            }
        );

    });

    // ================Add Course============ //


    $("#add-course").click(function () {
        $('#add-course-modal').show();

    });

    $(".close").click(function () {
        $('#add-course-modal').hide();
        $('#edit-course-modal').hide();
        $('#edit-teacher-modal').hide();

    });

    $('#form-add-course').submit(function (e) {
        e.preventDefault();

        var c_name = $('#course_name').val();
        if (c_name.length < 1) {
            $('.c_name').after('<span class="error">please enter course name</span>');
            return false;
        }

        var data = $('#form-add-course').serialize();
        $.ajax({
            type: "POST",
            url: site_url + "config/ajaxFunction.php?ch=5",
            data: data,
            encode: true,
        }).done(function (data) {
            console.log(data);
            if (data == 1) {
                list_all_courses();
                $('#response_msg').html(
                    '<div class="alert alert-success"><span class="alert-message"><strong>Success! </strong>Course Added successfully.</span> </div>'
                );
                $('#add-course-modal').hide();
                $('#form-add-course')[0].reset();
            } else {
                $('#response_msg').html(data);
            }
            setTimeout(() => {
                $('#response_msg').html('');
            }, 5000);
        });
    });

    // ================edit Course============ //


    $('#tbl-courses').on("click", ".course-edit", function () {
        // $('#edit-course-modal').show();

        var id = this.id;
        $.post(site_url + "config/ajaxFunction.php",
            {
                ch: "6",
                id: id
            },
            function (data, status) {
                console.log(data);
                const arr = data.split('||');
                if (arr[0] == '1') {
                    var obj = $.parseJSON(arr[1]);
                    $('#edit_course_name').val(obj.name);
                    $('#edit_status').val(obj.status);
                    $('#cid').val(obj.id);

                    $('#edit-course-modal').show();
                }
                else {
                    $('#response_msg').html(data);
                }
                setTimeout(() => {
                    $('#response_msg').html('');
                }, 5000);
            });
    });

    // ===============update course================

    $('#form-edit-course').submit(function (e) {
        e.preventDefault();

        var c_name = $('#edit_course_name').val();
        if (c_name.length < 1) {
            $('.edit_c_name').after('<span class="error">please enter course name</span>');
            return false;
        }

        var data = $('#form-edit-course').serialize();
        $.ajax({
            type: "POST",
            url: site_url + "config/ajaxFunction.php?ch=7",
            data: data,
            encode: true,
        }).done(function (data) {
            console.log(data);
            if (data == 1) {
                list_all_courses();
                $('#response_msg').html(
                    '<div class="alert alert-success"><span class="alert-message"><strong>Success! </strong>Course updated successfully.</span> </div>'
                );
                $('#edit-course-modal').hide();
                $('#form-edit-course')[0].reset();
            } else {
                $('#response_msg').html(data);
            }
            setTimeout(() => {
                $('#response_msg').html('');
            }, 5000);
        });
    });



    // ===================List Students===========

    function list_all_Students(pageNo, search) {
        if(pageNo == undefined)
        {
            page_No = 1;
        }
        else{
            page_No = pageNo;
        }

        if(search == undefined)
        {
            search = '';
        }
        else{
            search = search;
        }

        $.ajax({
            type: "POST",
            url: site_url + "config/ajaxFunction.php?ch=8",
            data : {page_no : page_No, search:search},
            encode: true,
        }).done(function (data) {
            var dataArr = data.split('||');
            $('#tbl-students').html(dataArr[0]);
            $('#total_student').html(dataArr[1]);
            $('#pagination-students').html(dataArr[2]);
            $('#std-showEntries').html(dataArr[3]);

        });
    }

    list_all_Students();


    /////

    // =============Add Student=================

    $('#add-student').click(function () {
        $('#add-student-modal').show();
    });


    $('.close').click(function () {
        $('#add-student-modal').hide();
        $('#edit-student-modal').hide();
        $('#view-student-modal').hide();
        $('#add-teacher-modal').hide();
        $('#edit-teacher-modal').hide();

    });

    $('#form-add-students').submit(function (e) {
        e.preventDefault();

        let data = $('#form-add-students').serialize();
        $.ajax({
            type: "POST",
            url: site_url + "config/ajaxFunction.php?ch=9",
            data: data,
            encode: true,
        }).done(function (data) {
            console.log(data);
            if (data == 1) {
                list_all_Students();
                $('#response_msg').html(
                    '<div class="alert alert-success"><span class="alert-message"><strong>Success! </strong>Student Added successfully.</span> </div>'
                );
                $('#add-student-modal').hide();
                $('#form-add-students')[0].reset();

            }
            else {
                $('#response_msg').html(data);
            }

            setTimeout(() => {
                $('#response_msg').html('');
            }, 5000);

        });

    });
    ////


    // ===================search Student ===============

    $('.student_search').keyup(function (e) {
        e.preventDefault();

        const data = $('#student_search').val();
        if (data == 'active' || data == 'Active') {
            data = 1;
        }
        if (data == 'in-active' || data == 'In-active' || data == 'In-Active' || data == 'in-Active') {
            data = 0;
        }
        if (data.length == 0) 
        {
            list_all_Students();
        }else
        {           
            list_all_Students(1,data);
        }

    });

    // ============Delete Students=============


    $('#tbl-students').on("click", ".students-delete", function () {
        if (confirm("Are you sure want to delete this students?") == true) {
            var id = this.id;
            $.post(site_url + "config/ajaxFunction.php",
                {
                    ch: "10",
                    id: id
                },
                function (data, status) {
                    if (data == 1) {
                        list_all_Students();
                        $('#response_msg').html('<div class="alert alert-success"><span class="alert-message"><strong>Success! </strong>Student deleted successfully.</span> </div>'
                        );
                    }
                    else {
                        $('#response_msg').html(data);
                    }
                    setTimeout(() => {
                        $('#response_msg').html('');
                    }, 5000);
                });
        }
    });

    // =====================edit Student==========================

    $('#tbl-students').on("click", ".students-edit", function () {
        // $('#edit-course-modal').show();

        var id = this.id;
        $.post(site_url + "config/ajaxFunction.php",
            {
                ch: "11",
                id: id
            },
            function (data, status) {
                console.log(data);
                const arr = data.split('||');
                if (arr[0] == '1') {
                    var obj = $.parseJSON(arr[1]);
                    $('#edit_student_fname').val(obj.fname);
                    $('#edit_student_mname').val(obj.mname);
                    $('#edit_student_lname').val(obj.lname);
                    $('#edit_student_email').val(obj.email);
                    $('#edit_mobile').val(obj.mobile);
                    $('#edit_courses').val(obj.course_id);
                    $('#edit_class').val(obj.class_id);
                    $('#edit_status').val(obj.status);
                    $('#edit_village').val(obj.village);
                    $('#edit_city').val(obj.city);
                    $('#edit_state').val(obj.state);
                    $('#edit_country').val(obj.country);
                    $('#edit_pincode').val(obj.pincode);
                    $('#sid').val(obj.id);

                    $('#edit-student-modal').show();
                }
                else {
                    $('#response_msg').html(data);
                }
                setTimeout(() => {
                    $('#response_msg').html('');
                }, 5000);
            });
    });


    // ===================Update Student=======================

    $('#form-edit-students').submit(function (e) {
        e.preventDefault();

        var fname = $('#edit_student_fname').val();
        var mname = $('#edit_student_mname').val();
        var lname = $('#edit_student_lname').val();
        var email = $('#edit_email').val();
        var mobile = $('#edit_mobile').val();
        var village = $('#edit_village').val();
        var city = $('#edit_city').val();
        var state = $('#edit_state').val();
        var country = $('#edit_country').val();
        var pincode = $('#edit_pincode').val();

        if (fname.length < 1 && mname.length < 1 && lname.length < 1) {
            $('.edit_error').after('<span class="error">* Please enter full name</span>');
            return false;
        }
        var data = $('#form-edit-students').serialize();
        $.ajax({
            type: "POST",
            url: site_url + "config/ajaxFunction.php?ch=12",
            data: data,
            encode: true,
        }).done(function (data) {
            console.log(data);
            if (data == 1) {
                list_all_Students();
                $('#response_msg').html(
                    '<div class="alert alert-success"><span class="alert-message"><strong>Success! </strong>Course updated successfully.</span> </div>'
                );
                $('#edit-student-modal').hide();
                $('#form-edit-students')[0].reset();
            } else {
                $('#response_msg').html(data);
            }
            setTimeout(() => {
                $('#response_msg').html('');
            }, 5000);
        });
    });

    // =================View Student =============

    $('#tbl-students').on("click", ".students-view", function () {
        // $('#edit-course-modal').show();

        var id = this.id;
        $.post(site_url + "config/ajaxFunction.php",
            {
                ch: "13",
                id: id
            },
            function (data, status) {
                console.log(data);
                const arr = data.split('||');
                if (arr[0] == '1') {
                    var obj = $.parseJSON(arr[1]);
                    if (obj.status == 1) {
                        var status = "Active";
                    }
                    else {
                        var status = "In-Active";
                    }
                    $('#view_student_fname').html(obj.fname);
                    $('#view_student_mname').html(obj.mname);
                    $('#view_student_lname').html(obj.lname);
                    $('#view_student_email').html(obj.email);
                    $('#view_mobile').html(obj.mobile);
                    $('#view_courses').html(obj.course_name);
                    $('#view_class').html(obj.class_name);
                    $('#view_status').html(status);
                    $('#view_village').html(obj.village);
                    $('#view_city').html(obj.city);
                    $('#view_state').html(obj.state);
                    $('#view_country').html(obj.country);
                    $('#view_pincode').html(obj.pincode);

                    $('#view-student-modal').show();
                }
                else {
                    $('#response_msg').html(data);
                }
                setTimeout(() => {
                    $('#response_msg').html('');
                }, 5000);
            });
    });


    // ===================List Teachers===========

    function list_all_Teachers(pageNo,search) {

        if(pageNo == undefined)
        {
            page_No = 1;
        }
        else{
            page_No = pageNo;
        }

        if(search == undefined)
        {
            search = '';
        }
        else{
            search = search;
        }

        $.ajax({
            type: "POST",
            url: site_url + "config/ajaxFunction.php?ch=16",
            data: {page_no:page_No,search:search},
            encode: true,
        }).done(function (data) {
            var dataArr = data.split('||');
            $('#tbl-teachers').html(dataArr[0]);
            $('#total_teacher').html(dataArr[1]);
            $('#pagination-teachers').html(dataArr[2]);
            $('#teacher-showEntries').html(dataArr[3]);

        });
    }

     list_all_Teachers();

    /////

    // =============Add Teachers=================

    $('#add-teacher').click(function () {
        $('#add-teacher-modal').show();
    });

    $('#form-add-teacher').submit(function (e) {
        e.preventDefault();

        var data = $('#form-add-teacher').serialize();
        console.log(data);
        $.ajax({
            type: "POST",
            url: site_url + "config/ajaxFunction.php?ch=20",
            data: data,
            encode: true,
        }).done(function (data) {
            console.log(data);
            if (data == 1) {
                list_all_Teachers();
                $('#response_msg').html(
                    '<div class="alert alert-success"><span class="alert-message"><strong>Success! </strong>Teacher added successfully.</span> </div>'
                );
                $('#add-teacher-modal').hide();
                $('#form-add-teacher')[0].reset();

            }
            else {
                $('#response_msg').html(data);
            }

            setTimeout(() => {
                $('#response_msg').html('');
            }, 5000);

        });

    });
    ////

    // ===================search teacher ===============

    $('.teacher_search').keyup(function (e) {
        e.preventDefault();

        const data = $('#teacher_search').val();
        if (data == 'active' || data == 'Active') {
            data = 1;
        }
        if (data == 'in-active' || data == 'In-active' || data == 'In-Active' || data == 'in-Active') {
            data = 0;
        }
        if (data.length==0) {
            list_all_Teachers();
        }
        else{
            list_all_Teachers(1,data);
        }

    });


    // ============Delete Teachers=============

    $('#tbl-teachers').on("click", ".teacher-delete", function () {
        if (confirm("Are you sure want to delete this teacher?") == true) {
            var id = this.id;
            $.post(site_url + "config/ajaxFunction.php",
                {
                    ch: "17",
                    id: id
                },
                function (data, status) {
                    if (data == 1) {
                        list_all_Teachers();
                        $('#response_msg').html('<div class="alert alert-success"><span class="alert-message"><strong>Success! </strong>Teacher deleted successfully.</span> </div>'
                        );
                    }
                    else {
                        $('#response_msg').html(data);
                    }
                    setTimeout(() => {
                        $('#response_msg').html('');
                    }, 5000);
                });
        }
    });


    // =====================edit Student==========================

    $('#tbl-teachers').on("click", ".teacher-edit", function () {
        // $('#edit-course-modal').show();

        var id = this.id;
        $.post(site_url + "config/ajaxFunction.php",
            {
                ch: "18",
                id: id
            },
            function (data, status) {
                console.log(data);
                const arr = data.split('||');
                if (arr[0] == '1') {
                    var obj = $.parseJSON(arr[1]);
                    $('#edit_teacher_fname').val(obj.fname);
                    $('#edit_teacher_mname').val(obj.mname);
                    $('#edit_teacher_lname').val(obj.lname);
                    $('#edit_teacher_email').val(obj.email);
                    $('#edit_mobile').val(obj.mobile);
                    $('#edit_courses').val(obj.course_id);
                    $('#edit_class').val(obj.class_id);
                    $('#edit_status').val(obj.status);
                    $('#edit_village').val(obj.village);
                    $('#edit_city').val(obj.city);
                    $('#edit_state').val(obj.state);
                    $('#edit_country').val(obj.country);
                    $('#edit_pincode').val(obj.pincode);
                    $('#tid').val(obj.id);

                    $('#edit-teacher-modal').show();
                }
                else {
                    $('#response_msg').html(data);
                }
                setTimeout(() => {
                    $('#response_msg').html('');
                }, 5000);
            });
    });


    // ===================Update Teacher=======================

    $('#form-edit-teacher').submit(function (e) {
        e.preventDefault();

        var fname = $('#edit_teacher_fname').val();
        var mname = $('#edit_teacher_mname').val();
        var lname = $('#edit_teacher_lname').val();
        var email = $('#edit_email').val();
        var mobile = $('#edit_mobile').val();
        var village = $('#edit_village').val();
        var city = $('#edit_city').val();
        var state = $('#edit_state').val();
        var country = $('#edit_country').val();
        var pincode = $('#edit_pincode').val();

        if (fname.length < 1 && mname.length < 1 && lname.length < 1) {
            $('.edit_error').after('<span class="error">* Please enter full name</span>');
            return false;
        }
        var data = $('#form-edit-teacher').serialize();
        $.ajax({
            type: "POST",
            url: site_url + "config/ajaxFunction.php?ch=19",
            data: data,
            encode: true,
        }).done(function (data) {
            console.log(data);
            if (data == 1) {
                list_all_Teachers();
                $('#response_msg').html(
                    '<div class="alert alert-success"><span class="alert-message"><strong>Success! </strong>Course updated successfully.</span> </div>'
                );
                $('#edit-teacher-modal').hide();
                $('#form-edit-teacher')[0].reset();
            } else {
                $('#response_msg').html(data);
            }
            setTimeout(() => {
                $('#response_msg').html('');
            }, 5000);
        });
    });

    // =============== Change Password===============

    $('#change-pass-form').hide();

    $('#confirm-pass-form').submit(function (e) {
        e.preventDefault();
        var con_pass = $('#confirm-password').val();
        if(con_pass.length<1)
        {
            $('.alert').html('<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Enter Password.</span> </div>');
            return false;
        }
        var data = $('#confirm-pass-form').serialize();
        $.ajax({
            type: "POST",
            url: site_url + "config/ajaxFunction.php?ch=22",
            data: data,
            encode: true,
        }).done(function (data) {
            if (data == 1) {
                $('#change-pass-form').show();
                $('#confirm-pass-form').hide();
            }
            else {
                $('.alert').html(data);
            }
        })
        setTimeout(() => {
            $('.alert').html('');
        }, 5000);

    });


    $('#change-pass-form').submit(function (e) {
        e.preventDefault();
        const new_pass = $('#new-password').val();
        const c_password = $('#con-password').val();
        if (new_pass.length >= 5) {

            if (new_pass == c_password) {

                var data = $('#change-pass-form').serialize();
                // alert(data);
                $.ajax({
                    type: "POST",
                    url: site_url + "config/ajaxFunction.php?ch=23",
                    data: data,
                    encode: true,
                }).done(function (data) {
                    if (data == 1) {
                        window.location = site_url + "dashboard.php";
                    }
                    else {
                        $('.alert').html('<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Something went wrong.</span> </div>');
                    }
                })
                setTimeout(() => {
                    $('.alert').html('');
                }, 5000);
            }
            else {

                $('.alert').html('<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Password must be same.</span> </div>');
                setTimeout(() => {
                    $('.alert').html('');
                }, 5000);
            }
        }
        else{

            $('.alert').html('<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Password must be alteast 5 character long.</span> </div>');

        }

    });
/////

// ==================pagination====================

    $('#pagination-students').on('click','a',function(){
        var pageNo = this.id;

        const data = $('#student_search').val();

        if (data.length == 0) {
            list_all_Students(pageNo,'');
        }else
        {   
            list_all_Students(pageNo,data);
        }

    });

    $('#pagination-teachers').on('click','a',function(){
        var pageNo = this.id;

        const data = $('#teacher_search').val();

        if (data.length == 0) {
            list_all_Teachers(pageNo,'');
        }else
        {   
            list_all_Teachers(pageNo,data);
        }

    });

    $('#pagination-courses').on('click','a',function(){
        var pageNo = this.id;

        const data = $('#course_search').val();

        if (data.length == 0) {
            list_all_courses(pageNo,'');
        }else
        {   
            list_all_courses(pageNo,data);
        }

    });

// ===============password show==============

    $('#eye').click(function(e){
        e.preventDefault();
        var eyeicon = $('#eye');
        var confirm_password = $('#confirm-password');


            if (confirm_password.prop('type') == 'password') {
                confirm_password.prop('type','text');
                eyeicon.attr("class","fa-solid fa-eye-slash password");
            }
            else {
                confirm_password.prop('type','password');
                eyeicon.attr("class","fa-solid fa-eye password");
            }         

    });
    $('#eye2').click(function(e){
        e.preventDefault();
        var eyeicon = $('#eye2');
        var chg_password = $('#new-password');

            if (chg_password.prop('type') == 'password') {
                chg_password.prop('type','text');
                eyeicon.attr("class","fa-solid fa-eye-slash password");
            }
            else {
                chg_password.prop('type','password');
                eyeicon.attr("class","fa-solid fa-eye password");
            }
    });
    $('#eye3').click(function(e){
        e.preventDefault();
        var eyeicon = $('#eye3');
        var con_password = $('#con-password');

            if (con_password.prop('type') == 'password') {
                con_password.prop('type','text');
                eyeicon.attr("class","fa-solid fa-eye-slash password");
            }
            else {
                con_password.prop('type','password');
                eyeicon.attr("class","fa-solid fa-eye password");
            }
    });

    // ---
});






