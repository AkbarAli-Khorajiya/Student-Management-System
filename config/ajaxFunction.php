<?php
    error_reporting(0);
    session_start();
    class aJAXFunction{
        private $server = 'localhost';
        private $user = 'root';
        private $password = '';
        private $database = 'sms';
        private $conn;
        public function __construct()
        {
            
            $conn = mysqli_connect($this->server,$this->user,$this->password,$this->database);

            if (!$conn)
            {
                die ("<h1>Database Connection Failed</h1>". mysqli_connect_error());
            }
            return $this->conn = $conn;
        }
        public function total_student(){
            $stmt = "SELECT * FROM students";
            $result = mysqli_query($this->conn,$stmt);
            $num = mysqli_num_rows($result);

            return $num;
        }
        public function total_teacher(){
            $stmt = "SELECT * FROM teachers";
            $result = mysqli_query($this->conn,$stmt);
            $num = mysqli_num_rows($result);

            return $num;
        }
        public function total_course(){
            $stmt = "SELECT * FROM courses";
            $result = mysqli_query($this->conn,$stmt);
            $num = mysqli_num_rows($result);

            return $num;
        }
        
        public function signin($post){
            $email = $post['email'];
            $password = $post['password'];
            $stmt = "select * from users where email = '$email'";
            $result = mysqli_query($this->conn,$stmt);
            $row = mysqli_num_rows($result);
            if($row==1){
                $num = mysqli_fetch_assoc($result);
                if(password_verify($password,$num['password']))
                {   
                    $_SESSION['user_name'] = $num['name'];
                    $_SESSION['user_email'] = $num['email'];
                    $_SESSION['user_id'] = 1;
                    return 1;
                } 
                else{
                    return '<span class="alert-message"><strong>Error! </strong>Invalid Password</span>';
                }               
            }
            else{
                return '<span class="alert-message"><strong>Error! </strong>Invalid Credential</span>';
            }
        }

        public function logout(){
            session_unset();
            session_destroy();
            return 1;
        }

        public function list_only_courses(){
            $stmt = "select * from courses order by name";
            $result = mysqli_query($this->conn,$stmt);
            $str = "";
            while($row = mysqli_fetch_assoc($result))
            {
                $str .='<option value="'.$row['id'].'" class="opt">'.$row['name'].'</option>';
            }
            return $str;

        }
        public function list_only_classes(){
            $stmt = "select * from classes order by id";
            $result = mysqli_query($this->conn,$stmt);
            $str = "";
            while($row = mysqli_fetch_assoc($result))
            {
                $str .='<option value="'.$row['id'].'" class="opt">'.$row['name'].'</option>';
            }
            return $str;

        }
        
        public function list_all_courses($post){
            if(isset($post['page_no']))
            {
                $pageNo = $post['page_no'];
            }
            else{
                $pageNo = 1;
            }
            $pageLimit = 5;
            $start = ($pageNo-1) * $pageLimit;
            if(isset($post['search']))
            {
          
                $search = $post['search'];
                $stmt = "SELECT * FROM  courses WHERE name LIKE '$search%' OR status LIKE '$search' ORDER BY name LIMIT $start,$pageLimit";
            
            }
            else{
                $stmt = "SELECT * FROM courses ORDER BY name LIMIT $start,$pageLimit";
            }            

            $result = mysqli_query($this->conn,$stmt);
            $num = mysqli_num_rows($result);
            if($num>0){
                $str = '<thead>
                    <th>Sr.</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>';
                $i=$start_record = $start+1;
                while($row = mysqli_fetch_assoc($result))
                {
                    if($row['status']==1)
                    {
                        $status = 'Active';
                    }
                    else{
                        $status = 'In-Active';
                    }
                    $str .= '<tr>
                        <td><b>'.$i.'</b></td>
                        <td>'.$row['name'].'</td>
                        <td id="'.$status.'">'.$status.'</td>
                        <td>
                            
                            <a href="javascript:void(0)" id="'.$row['id'].'" class="course-edit"><button class="btn btn-warning btn-sm ml-10"><i class="fa fa-pencil"></i> EDIT</button></a>
                            <a href="javascript:void(0)" id="'.$row['id'].'" class="course-delete"><button class="btn btn-danger btn-sm ml-10"><i class="fa fa-trash"></i> DILETE</button></a>
                        </td>
                    </tr>
                    ';
                    $i++;
                }
                $end_record = $i-1;
                $str .= '</tbody>||';
            }
            else{
                $str = 'Data Not Found';
            }
            if(isset($post['search']))
            {
          
                $search = $post['search'];
                $query =  mysqli_query($this->conn,"SELECT * FROM  courses WHERE name LIKE '$search%' OR status LIKE '$search' ORDER BY name");
          
            }
            else{
                $query = mysqli_query($this->conn,"SELECT * FROM courses");
            }
            $num = mysqli_num_rows($query);
            $totalPage = ceil($num / $pageLimit);
            $str .= $num.'||';
            for($i=1;$i<=$totalPage;$i++)
            {
                if($i==$pageNo)
                {
                    $active = 'active';
                }
                else{
                    $active = '';
                }
                $str .= '<a id="'.$i.'"><button class="'.$active.'">'.$i.'</button></a>';
            }
            $show_records = 'Showing '.$start_record.' to '.$end_record.' of '.$num.' entries';
            return $str.'||'.$show_records;
        }

        public function delete_course($post){
           
            $stmt = "select id from courses where id = ".$post['id']." order by id limit 1" ;
            $result = mysqli_query($this->conn,$stmt);
            $row = mysqli_num_rows($result);
            if($row>0){
                $stmt = "delete from courses where id = ".$post['id'];
                if( mysqli_query($this->conn,$stmt))
                {
                    return 1;
                }
                else
                {
                    return '<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Something went wrong.</span> </div>';
                }
            }
            else{
                return '<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Data does not exist.</span> </div>';
            }

        }

        public function add_course($post){
            $course_name = strtoupper($post['course_name']);
            $stmt = "INSERT INTO `courses` ( `name`, `status`) VALUES ('".$course_name."', '".$post['status']."')" ;
            if(mysqli_query($this->conn,$stmt))
            {
                return 1;
            }
            else
            {
                return '<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Something went wrong.</span> </div>';
            }
            
        }

        public function course_search($post){
            $course_name =strtoupper($post['search']);
            $status = $post['course_status'];
            $stmt = "SELECT * FROM  courses WHERE name LIKE '$course_name%' OR status LIKE '$status' ORDER BY name";
            $result = mysqli_query($this->conn,$stmt);
            $num = mysqli_num_rows($result);
            if($num>0){
                $str = '<thead>
                    <th>Sr.</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>';
                $i = 1;
                while($row = mysqli_fetch_assoc($result))
                {
                    if($row['status']==1)
                    {
                        $status = 'Active';
                    }
                    else{
                        $status = 'In-Active';
                    }
                    $str .= '<tr>
                        <td><b>'.$i.'</b></td>
                        <td>'.$row['name'].'</td>
                        <td id="'.$status.'">'.$status.'</td>
                        <td>
                            
                            <a href="javascript:void(0)" id="'.$row['id'].'" class="course-edit"><button class="btn btn-warning btn-sm ml-10"><i class="fa fa-pencil"></i> EDIT</button></a>
                            <a href="javascript:void(0)" id="'.$row['id'].'" class="course-delete"><button class="btn btn-danger btn-sm ml-10"><i class="fa fa-trash"></i> DILETE</button></a>
                        </td>
                    </tr>
                    ';
                    $i++;
                }
                $str .= '</tbody>';
            }
            else{
                $str = 'Data Not Found';
            }
            return $str;
            
        }

        public function edit_course($post){
            $stmt = "select * from courses where id = ".$post['id'];
            $result = mysqli_query($this->conn,$stmt);
            $row = mysqli_num_rows($result);
            if($row>0)
            {
                $data = mysqli_fetch_assoc($result);
                return '1||'.json_encode($data);
            }
            else {
                return '<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Data does not exist.</span> </div>';
            }
        }
        
        public function update_course($post){
            
            $stmt = "UPDATE `courses` SET `name` = '".$post['edit_course_name']."', `status` = '".$post['edit_status']."' WHERE `courses`.`id` = ".$post['cid'];
            if(mysqli_query($this->conn,$stmt))
            {
                return 1;
            }
            else
            {
                return '<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Something went wrong.</span> </div>';
            }
            
        }

        public function list_all_students($post){
           
            if(isset($post['page_no']))
            {
                $pageNo = $post['page_no'];
            }
            else{
                $pageNo = 1;
            }
            $pageLimit = 5;

            $start = ($pageNo-1) * $pageLimit;
            if(isset($post['search']))
            {
          
                $search = $post['search'];
                $stmt = "SELECT s.id,s.fname,s.mname,s.lname,s.status,c.name course_name,cl.name class_name FROM `students` s LEFT JOIN courses c ON c.id=s.course_id LEFT JOIN classes cl ON cl.id = s.class_id WHERE s.fname LIKE '$search%' OR s.mname LIKE '$search%' OR s.lname LIKE '$search%' OR c.name LIKE '$search%' OR cl.name LIKE '$search%' OR s.status LIKE '$search' ORDER BY s.fname LIMIT $start,$pageLimit";
            
            }
            else{
                $stmt = "SELECT s.id,s.fname,s.mname,s.lname,s.status,c.name course_name,cl.name class_name FROM `students` s LEFT JOIN courses c ON c.id=s.course_id LEFT JOIN classes cl ON cl.id = s.class_id ORDER BY s.fname LIMIT $start,$pageLimit";
            }

            $result = mysqli_query($this->conn,$stmt);
            $num = mysqli_num_rows($result);
            if($num>0){
                $str = '<thead>
                    <th>Sr.</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Course</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>';
                $i=$start_record = $start+1;

                while($row = mysqli_fetch_assoc($result))
                {   $name = $row['fname']." ".$row['mname']." ".$row['lname'];
                    if($row['status']==1)
                    {
                        $status = 'Active';
                    }
                    else{
                        $status = 'In-Active';
                    }
                    $str .= '<tr>
                        <td><b>'.$i.'</b></td>
                        <td>'.$name.'</td>
                        <td>'.$row['course_name'].'</td>
                        <td>'.$row['class_name'].'</td>
                        <td id="'.$status.'">'.$status.'</td>
                        <td>
                            <a href="javascript:void(0)" id="'.$row['id'].'" class="students-view"><button class="btn btn-info btn-sm ml-10 mb-5"><i class="fa fa-pencil"></i> VIEW</button></a>
                            <a href="javascript:void(0)" id="'.$row['id'].'" class="students-edit"><button class="btn btn-warning btn-sm ml-10 mb-5"><i class="fa fa-pencil"></i> EDIT</button></a>
                            <a href="javascript:void(0)" id="'.$row['id'].'" class="students-delete"><button class="btn btn-danger btn-sm ml-10"><i class="fa fa-trash"></i> DILETE</button></a>
                        </td>
                    </tr>
                    ';
                    $i++;
                }
                $end_record = $i-1;
                $str .= '</tbody>||';
            }
            else{
                $str = 'Data Not Found';
            }
            if(isset($post['search']))
            {
          
                $search = $post['search'];
                $query =  mysqli_query($this->conn,"SELECT s.id,s.fname,s.mname,s.lname,s.status,c.name course_name,cl.name class_name FROM `students` s LEFT JOIN courses c ON c.id=s.course_id LEFT JOIN classes cl ON cl.id = s.class_id WHERE s.fname LIKE '$search%' OR s.mname LIKE '$search%' OR s.lname LIKE '$search%' OR c.name LIKE '$search%' OR cl.name LIKE '$search%' OR s.status LIKE '$search' ORDER BY s.fname");
          
            }
            else{
                $query = mysqli_query($this->conn,"SELECT * FROM students");
            }
            $num = mysqli_num_rows($query);
            $totalPage = ceil($num / $pageLimit);
            $str .= $num.'||';
            for($i=1;$i<=$totalPage;$i++)
            {
                if($i==$pageNo)
                {
                    $active = 'active';
                }
                else{
                    $active = '';
                }
                $str .= '<a id="'.$i.'"><button class="'.$active.'">'.$i.'</button></a>';
            }
            $show_records = 'Showing '.$start_record.' to '.$end_record.' of '.$num.' entries';
            return $str.'||'.$show_records;
        }
        
        public function add_students($post) {
            
            $fname = ucfirst($post['fname']);
            $mname = ucfirst($post['mname']);
            $lname = ucfirst($post['lname']);
            $email = $post['email'];
            $mobile = $post['mobile'];
            $village = ucfirst($post['village']);
            $city = ucfirst($post['city']);
            $state = ucfirst($post['state']);
            $country = ucfirst($post['country']);
            $pincode = $post['pincode'];
            $course_id = $post['course'];
            $class_id = $post['class'];
            $status = $post['status'];

            $stmt ="INSERT INTO `students` (`fname`, `mname`, `lname`, `email`, `mobile`, `village`, `city`, `state`, `country`, `pincode`, `course_id`, `class_id`, `status`) VALUES ('$fname', '$mname', '$lname', '$email', '$mobile', '$village', '$city', '$state', '$country', '$pincode', '$course_id', '$class_id', '$status')";

            if (mysqli_query($this->conn,$stmt)) {
                return 1;
            }
            else{
                return '<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Something went wrong.</span> </div>';
            }
        }

        public function delete_student($post){
           
            $stmt = "select id from students where id = ".$post['id']." order by id limit 1" ;
            $result = mysqli_query($this->conn,$stmt);
            $row = mysqli_num_rows($result);
            if($row>0){
                $stmt = "delete from students where id = ".$post['id'];
                if(mysqli_query($this->conn,$stmt))
                {
                    return 1;
                }
                else
                {
                    return '<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Something went wrong.</span> </div>';
                }
            }
            else{
                return '<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Data does not exist.</span> </div>';
            }

        }

        public function edit_student($post){
            $stmt = "select * from students where id = ".$post['id'];
            $result = mysqli_query($this->conn,$stmt);
            $row = mysqli_num_rows($result);
            if($row>0)
            {
                $data = mysqli_fetch_assoc($result);
                return '1||'.json_encode($data);
            }
            else {
                return '<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Data does not exist.</span> </div>';
            }
        }

        public function update_student($post){
            $fname = ucfirst($post['edit_fname']);
            $mname = ucfirst($post['edit_mname']);
            $lname = ucfirst($post['edit_lname']);
            $email = $post['edit_email'];
            $mobile = $post['edit_mobile'];
            $village = ucfirst($post['edit_village']);
            $city = ucfirst($post['edit_city']);
            $state = ucfirst($post['edit_state']);
            $country = ucfirst($post['edit_country']);
            $pincode = $post['edit_pincode'];
            $course_id = $post['edit_course'];
            $class_id = $post['edit_class'];
            $status = $post['edit_status'];

            $stmt = "UPDATE `students` SET `fname` = '$fname', `mname` = '$mname', `lname` = '$lname', `email` = '$email', `mobile` = '$mobile', `village` = '$village', `city` = '$city', `state` = '$state', `country` = '$country', `pincode` = '$pincode', `course_id` = '$course_id', `class_id` = '$class_id', `status` = '$status' WHERE `id` =".$post['sid'];
            if(mysqli_query($this->conn,$stmt))
            {
                return 1;
            }
            else
            {
                return '<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Something went wrong.</span> </div>';
            }
            
        }

        public function student_detail($post){
            $stmt = "select s.id,s.fname,s.mname,s.lname,s.email,s.mobile,s.village,s.city,s.state,s.country,s.pincode,c.name course_name,cl.name class_name,s.status from students s LEFT JOIN courses c ON c.id=s.course_id LEFT JOIN classes cl ON cl.id = s.class_id WHERE s.id =".$post['id'];
            $result = mysqli_query($this->conn,$stmt);
            $row = mysqli_num_rows($result);
            if($row>0)
            {
                $data = mysqli_fetch_assoc($result);
                return '1||'.json_encode($data);
            }
            else {
                return '<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Data does not exist.</span> </div>';
            }

        }

        public function list_all_teachers($post){

            if(isset($post['page_no']))
            {
                $pageNo = $post['page_no'];
            }
            else{
                $pageNo = 1;
            }
            $pageLimit = 5;

            $start = ($pageNo-1) * $pageLimit;
            if(isset($post['search']))
            {
          
                $search = $post['search'];
                $stmt = "SELECT  t.id,t.fname,t.mname,t.lname,t.email,t.mobile,t.status,t.village,t.city,t.state,t.country,c.name course_name FROM `teachers` t JOIN courses c ON c.id=t.course_id WHERE t.fname LIKE '$search%' OR t.mname LIKE '$search%' OR t.lname LIKE '$search%' OR t.email LIKE '$search%' OR t.mobile LIKE '$search%' OR t.village LIKE '$search%' OR t.city LIKE '$search%' OR t.state LIKE '$search%' OR t.country LIKE '$search%' OR c.name LIKE '$search%' OR t.status LIKE '$search' ORDER BY t.fname LIMIT $start,$pageLimit";
            
            }
            else{
                $stmt = "SELECT t.id,t.fname,t.mname,t.lname,t.email,t.mobile,t.status,t.village,t.city,t.state,t.country,c.name course_name FROM `teachers` t JOIN courses c ON c.id=t.course_id ORDER BY t.fname LIMIT $start,$pageLimit";
            }

            $result = mysqli_query($this->conn,$stmt);
            $num = mysqli_num_rows($result);
           
            if($num>0){
                $str = '<thead>
                    <th>Sr.</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Action</th>
                </thead>
                <tbody>';
                $i=$start_record = $start+1;

                while($row = mysqli_fetch_assoc($result))
                {   $name = $row['fname']." ".$row['mname']." ".$row['lname'];
                    $address = $row['village']." ".$row['city']."<br>".$row['state']." ".$row['country'];
                    if($row['status']==1)
                    {
                        $status = 'Active';
                    }
                    else{
                        $status = 'In-Active';
                    }
                    $str .= '<tr>
                        <td><b>'.$i.'</b></td>
                        <td>'.$name.'</td>
                        <td>'.$row['course_name'].'</td>
                        <td id="'.$status.'">'.$status.'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['mobile'].'</td>
                        <td>'.$address.'</td>

                        <td>
                            <a href="javascript:void(0)" id="'.$row['id'].'" class="teacher-edit"><button class="btn btn-warning btn-sm ml-10 mb-5"><i class="fa fa-pencil"></i> EDIT</button></a>
                            <a href="javascript:void(0)" id="'.$row['id'].'" class="teacher-delete"><button class="btn btn-danger btn-sm ml-10"><i class="fa fa-trash"></i> DILETE</button></a>
                        </td>
                    </tr>
                    ';
                    $i++;
                }
                $str .= '</tbody>||';
                $end_record = $i-1;
            }
            else{
                $str = 'Data Not Found';
            }
            if(isset($post['search']))
            {
          
                $search = $post['search'];
                $query =  mysqli_query($this->conn,"SELECT  t.id,t.fname,t.mname,t.lname,t.email,t.mobile,t.status,t.village,t.city,t.state,t.country,c.name course_name FROM `teachers` t JOIN courses c ON c.id=t.course_id WHERE t.fname LIKE '$search%' OR t.mname LIKE '$search%' OR t.lname LIKE '$search%' OR t.email LIKE '$search%' OR t.mobile LIKE '$search%' OR t.village LIKE '$search%' OR t.city LIKE '$search%' OR t.state LIKE '$search%' OR t.country LIKE '$search%' OR c.name LIKE '$search%' OR t.status LIKE '$search' ORDER BY t.fname");
          
            }
            else{
                $query = mysqli_query($this->conn,"SELECT * FROM teachers");
            }
            $num = mysqli_num_rows($query);
            $totalPage = ceil($num / $pageLimit);
            $str .= $num.'||';
            for($i=1;$i<=$totalPage;$i++)
            {
                if($i==$pageNo)
                {
                    $active = 'active';
                }
                else{
                    $active = '';
                }
                $str .= '<a id="'.$i.'"><button class="'.$active.'">'.$i.'</button></a>';
            }
            $show_records = 'Showing '.$start_record.' to '.$end_record.' of '.$num.' entries';
            return $str.'||'.$show_records;
        }

        public function add_teachers($post) {
            
            $fname = ucfirst($post['fname']);
            $mname = ucfirst($post['mname']);
            $lname = ucfirst($post['lname']);
            $email = $post['email'];
            $mobile = $post['mobile'];
            $village = ucfirst($post['village']);
            $city = ucfirst($post['city']);
            $state = ucfirst($post['state']);
            $country = ucfirst($post['country']);
            $pincode = $post['pincode'];
            $course_id = $post['course'];
            $status = $post['status'];

            $stmt ="INSERT INTO `teachers` (`fname`, `mname`, `lname`, `email`, `mobile`, `village`, `city`, `state`, `country`, `pincode`, `course_id`, `status`) VALUES ('$fname', '$mname', '$lname', '$email', '$mobile', '$village', '$city', '$state', '$country', '$pincode', '$course_id', '$status')";

            if (mysqli_query($this->conn,$stmt)) {
                return 1;
            }
            else{
                return '<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Something went wrong.</span> </div>';
            }
        }

        public function teacher_search($post){

            $teacher_fname =$post['teacher_fname'];
            $teacher_mname =$post['teacher_mname'];
            $teacher_lname =$post['teacher_lname'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $course_name =$post['teacher_course'];
            $village =$post['village'];
            $city =$post['city'];
            $state =$post['state'];
            $country =$post['country'];
            $status = $post['teacher_status'];

            $stmt = "SELECT  t.id,t.fname,t.mname,t.lname,t.email,t.mobile,t.status,t.village,t.city,t.state,t.country,c.name course_name FROM `teachers` t JOIN courses c ON c.id=t.course_id WHERE t.fname LIKE '$teacher_fname%' OR t.mname LIKE '$teacher_mname%' OR t.lname LIKE '$teacher_lname%' OR t.email LIKE '$email%' OR t.mobile LIKE '$mobile%' OR t.village LIKE '$village%' OR t.city LIKE '$city%' OR t.state LIKE '$state%' OR t.country LIKE '$country%' OR c.name LIKE '$course_name%' OR t.status LIKE '$status' ORDER BY t.fname,t.mname,t.lname";
            $result = mysqli_query($this->conn,$stmt);
            $num = mysqli_num_rows($result);
            if($num>0){
                $str = '<thead>
                    <th>Sr.</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Action</th>
                </thead>
                <tbody>';
                $i = 1;
                while($row = mysqli_fetch_assoc($result))
                {   $name = $row['fname']." ".$row['mname']." ".$row['lname'];
                    $address = $row['village']." ".$row['city']."<br>".$row['state']." ".$row['country'];
                    if($row['status']==1)
                    {
                        $status = 'Active';
                    }
                    else{
                        $status = 'In-Active';
                    }
                    $str .= '<tr>
                        <td><b>'.$i.'</b></td>
                        <td>'.$name.'</td>
                        <td>'.$row['course_name'].'</td>
                        <td id="'.$status.'">'.$status.'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['mobile'].'</td>
                        <td>'.$address.'</td>

                        <td>
                            <a href="javascript:void(0)" id="'.$row['id'].'" class="teacher-edit"><button class="btn btn-warning btn-sm ml-10 mb-5"><i class="fa fa-pencil"></i> EDIT</button></a>
                            <a href="javascript:void(0)" id="'.$row['id'].'" class="teacher-delete"><button class="btn btn-danger btn-sm ml-10"><i class="fa fa-trash"></i> DILETE</button></a>
                        </td>
                    </tr>
                    ';
                    $i++;
                }
                $str .= '</tbody>';
            }
            else{
                $str = 'Data Not Found';
            }
            return $str;
            
        }


        public function delete_teacher($post){
           
            $stmt = "select id from teachers where id = ".$post['id']." order by id limit 1" ;
            $result = mysqli_query($this->conn,$stmt);
            $row = mysqli_num_rows($result);
            if($row>0){
                $stmt = "delete from teachers where id = ".$post['id'];
                if(mysqli_query($this->conn,$stmt))
                {
                    return 1;
                }
                else
                {
                    return '<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Something went wrong.</span> </div>';
                }
            }
            else{
                return '<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Data does not exist.</span> </div>';
            }

        }

        public function edit_teacher($post){
            $stmt = "select * from teachers where id = ".$post['id'];
            $result = mysqli_query($this->conn,$stmt);
            $row = mysqli_num_rows($result);
            if($row>0)
            {
                $data = mysqli_fetch_assoc($result);
                return '1||'.json_encode($data);
            }
            else {
                return '<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Data does not exist.</span> </div>';
            }
        }

        public function update_teacher($post){

            $fname = ucfirst($post['edit_fname']);
            $mname = ucfirst($post['edit_mname']);
            $lname = ucfirst($post['edit_lname']);
            $email = $post['edit_email'];
            $mobile = $post['edit_mobile'];
            $village = ucfirst($post['edit_village']);
            $city = ucfirst($post['edit_city']);
            $state = ucfirst($post['edit_state']);
            $country = ucfirst($post['edit_country']);
            $pincode = $post['edit_pincode'];
            $course_id = $post['edit_course'];
            $status = $post['edit_status'];

            $stmt = "UPDATE `teachers` SET `fname` = '$fname', `mname` = '$mname', `lname` = '$lname', `email` = '$email', `mobile` = '$mobile', `village` = '$village', `city` = '$city', `state` = '$state', `country` = '$country', `pincode` = '$pincode', `course_id` = '$course_id', `status` = '$status' WHERE `id` =".$post['tid'];
            if(mysqli_query($this->conn,$stmt))
            {
                return 1;
            }
            else
            {
                return '<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Something went wrong.</span> </div>';
            }
            
        }

        public function confirm_password($post){

            $email = $post['email'];
            $password = $post['password'];
            $stmt = "select * from users where email = '$email'";
            $result = mysqli_query($this->conn,$stmt);
            $row = mysqli_num_rows($result);
            if($row==1){
                $num = mysqli_fetch_assoc($result);
                if(password_verify($password,$num['password']))
                { 
                    return '1';
                }
                else{
                    return '<div class="alert alert-danger"><span class="alert-message"><strong>Error! </strong>Wrong password.</span> </div>';
                }
            }            
        }

        public function change_password($post){

            $email = $post['email'];
            $password = $post['password'];
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $stmt = "UPDATE users SET password = '$hash' WHERE email = '$email'";
            $result = mysqli_query($this->conn,$stmt);
            if($result==1){
                session_destroy();
                return 1;
            }            
            else{
                return 0;
            }
        }

    }

// -------------------------------

    $obj = new aJAXFunction();

    switch($_REQUEST['ch'])
    {
        case 1:
            echo $obj->signin($_POST);
            break;
        case 2:
            echo $obj->logout();
            break;
        case 3:
            echo $obj->list_all_courses($_POST);
            break;
        case 4:
            echo $obj->delete_course($_POST);
            break;
        case 5:
            echo $obj->add_course($_POST);
            break;
        case 6:
            echo $obj->edit_course($_POST);
            break;
        case 7:
            echo $obj->update_course($_POST);
            break;
        case 8:
            echo $obj->list_all_students($_POST);
            break;
        case 9:
            echo $obj->add_students($_POST);
            break;
        case 10:
            echo $obj->delete_student($_POST);
            break;
        case 11:
            echo $obj->edit_student($_POST);
            break;
        case 12:
            echo $obj->update_student($_POST);
            break;
        case 13:
            echo $obj->student_detail($_POST);
            break;
        case 14:
            echo $obj->course_search($_POST);
            break;
        // case 15:
        //     echo $obj->student_search($_POST);
        //     break;
        case 16:
            echo $obj->list_all_teachers($_POST);
            break;
        case 17:
            echo $obj->delete_teacher($_POST);
            break;
        case 18:
            echo $obj->edit_teacher($_POST);
            break;
        case 19:
            echo $obj->update_teacher($_POST);
            break;
        case 20:
            echo $obj->add_teachers($_POST);
            break;
        case 21:
            echo $obj->teacher_search($_POST);
            break;
        case 22:
            echo $obj->confirm_password($_POST);
            break;
        case 23:
            echo $obj->change_password($_POST);
            break;
            
    }
    
    // <!-- <a href="javascript:void(0)" id="'.$row['id'].'" class="course-view"><i class="fa fa-eye"></i></a> -->
?>