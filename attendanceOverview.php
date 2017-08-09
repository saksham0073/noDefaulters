<html>
<body>
    <?php
      //connection to Db code
    {
      $conn = new mysqli("localhost","root","","student_attendance");
      if ($conn->connect_error)
      {
        die("Connection failed: " . $conn->connect_error);
      }
    }
      //login validation code
    { $uname = $_POST["userName"];
      $psw = $_POST["password"];

      $sql = "SELECT userName, name, password FROM student_info WHERE userName='$uname' AND password='$psw' ";
      //i want to verify if the user's username and password matches and only them permit them
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

        if($row["userName"]==$uname && $row["password"]==$psw)
        {
          echo "logged in";
        }
        else
        {
          echo "invalid username - password combination";
          goto here;
        }
    }
      //total attendance overview code
    {
      $calculatingAttendance = mysqli_query($conn,"SELECT totalLecturesAttended, totalLectures FROM attendance_info WHERE userName='$uname' ");
      // attendance calculating logic
      if(mysqli_num_rows($result) > 0)
      {
          while($row = mysqli_fetch_array($calculatingAttendance))
          {
          $tl = $row["totalLectures"];
          $la = $row["totalLecturesAttended"];
          $calcAttendance = round((100/$tl)*$la);
          echo "<br> Your Current Attendance is :$calcAttendance% <br>";
          }
      }
      else
      {
        echo "0 results";
      }
    }
        /*
        // column name array. Prob: the show columns is showing info IDW
        $sql = "SHOW COLUMNS FROM attendance_info ";
        $result = mysqli_query($conn,$sql);
        //I want to add the column names to each index of the array
        /*$subNames = array();
        while($subNames = mysqli_fetch_array($result))
        {
        for($i=0;$i<5;$i++)
          {
            echo $subNames[];
            echo $subNames[$i];
          }
        }
        //extract subject details from DB
        $sql = "SELECT subCCtotalLecturesAttended, subIStotalLecturesAttended, subWTtotalLecturesAttended, subSPMtotalLecturesAttended, subECOMtotalLecturesAttended,
        subCC, subIS, subWT, subSPM, subECOM FROM attendance_info WHERE userName='$uname'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
          {
        //output the value of each column and add it as meter value
        $value = 2;
        echo "<meter value=$value min=0 max=$>2 out of 10</meter>";
        */

        $sql = "SELECT userName, subCCtotalLecturesAttended, subIStotalLecturesAttended, subWTtotalLecturesAttended, subSPMtotalLecturesAttended, subECOMtotalLecturesAttended,
        subCC, subIS, subWT, subSPM, subECOM FROM attendance_info WHERE userName='$uname'";
        function checkDefaulter()
        {
          if($calcAttendance<75)
          {
            echo "Defaulter Alert!  <br>";
          }
        }

        if($result=mysqli_query($conn,$sql))
        {
          while($row=mysqli_fetch_array($result))
            {
            echo "<br> Attendance for each subject is:<br>";

            $subCCtl = $row["subCC"];
            $subCCtla = $row["subCCtotalLecturesAttended"];
            $calcAttendance = round((100/$subCCtl)*$subCCtla);
            echo "<h3> CC: ".$row["subCCtotalLecturesAttended"]."/".$row["subCC"]." = ".$calcAttendance."% </h3>";
            checkDefaulter();
            $subIStl = $row["subIS"];
            $subIStla = $row["subIStotalLecturesAttended"];
            $calcAttendance = round((100/$subIStl)*$subIStla);
            echo "<h3>IS: ".$row["subIStotalLecturesAttended"]."/".$row["subIS"]." = ".$calcAttendance."%</h3>";
            checkDefaulter();
            $subWTtl = $row["subWT"];
            $subWTtla = $row["subWTtotalLecturesAttended"];
            $calcAttendance = round((100/$subWTtl)*$subWTtla);
            echo "<h3>WT: ".$row["subWTtotalLecturesAttended"]."/".$row["subWT"]." = ".$calcAttendance."%</h3>";
            checkDefaulter();
            $subSPMtl = $row["subSPM"];
            $subSPMtla = $row["subSPMtotalLecturesAttended"];
            $calcAttendance = round((100/$subSPMtl)*$subSPMtla);
            echo "<h3>SPM: ".$row["subSPMtotalLecturesAttended"]."/".$row["subSPM"]." = ".$calcAttendance."%</h3>";
            checkDefaulter();
            $subECOMtl = $row["subECOM"];
            $subECOMtla = $row["subECOMtotalLecturesAttended"];
            $calcAttendance = round((100/$subECOMtl)*$subECOMtla);
            echo "<h3>ECOM: ".$row["subECOMtotalLecturesAttended"]."/".$row["subECOM"]." = ".$calcAttendance."%</h3>";
            checkDefaulter();

          }
        }
        else {
          # code...
        }

      //updating the total lectures attended code
      {
        $totalLecturesAttended = mysqli_query($conn," SELECT (subCC + subIS + subWT + subSPM + subECOM) AS totalLecturesAttended FROM  attendance_info WHERE userName = '$uname' ");
        while($row = mysqli_fetch_array($totalLecturesAttended))
        {

          $val = $row["totalLecturesAttended"];
          mysqli_query ($conn,"UPDATE attendance_info SET totalLecturesAttended = $val WHERE userName = '$uname' ");
        }
      }
        here:
        $conn->close();
  ?>
</body>
</html>
