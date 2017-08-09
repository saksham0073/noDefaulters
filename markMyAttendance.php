<html>
<head>
  <center>
  <h1> Mark Your Attendance!</h1>

  <!--JQUERY LIBRARY CONNECT-->
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
  <!--CALENDER CODE-->
  <script language="javascript" type="text/javascript" src="calendar.js"></script>
  <link href="calendar.css" rel="stylesheet" type="text/css">
  </center>
  <!--ATTENDANCE ARRAY-->
 <script>
{
      function attendanceCounter()
      {
        var i=0;
        var attendance = new Array();
        for(i;i<5;i++)
        {
          attendance[i] = document.getElementById("sub"+i).value;
          //document.getElementById("d").innerHTML=attendance;
        }
        //1)I wanna loop through the attendance array and 2)each index value should be checked to see if it has a p or a and then set that index value to be 1 or 0
        for(var i=0;i<5;i++)
        {
          var para = attendance[i];
            if(para=="p")
            {
              attendance[i]=1;
            }
            else
            {
              attendance[i]=0;
            }
        }
        //I wanna add the value of the index to the subject fields
        for(var i=0;i<5;i++)
        {
           document.getElementById("d").innerHTML=attendance;
        }
        //1)use jquery to 2)convert attendance array to json and 3)send via ajax
        //2)
        var myJSON = JSON.stringify(attendance);
        //3)
      var request = new XMLHttpRequest();
      request.open("POST","markedAttendance.php",true);
      request.send(myJSON);
    }
}
 </script>

  <?php?>

</head>

<body>
  <form>
    <input type="text" name="datum1" placeholder="select date to mark attendance">
    <a href="#" onClick="setYears(1900, 2040);
     showCalender(this, 'datum1');">
    <img id="calenderImg" src="calender.png"></a>
    <!-- Calender Script  -->
    <table id="calenderTable">
        <tbody id="calenderTableHead">
          <tr>
            <td colspan="4" align="center">
	          <select onChange="showCalenderBody(createCalender(document.getElementById('selectYear').value,
	           this.selectedIndex, false));" id="selectMonth">
	              <option value="0">Jan</option>
	              <option value="1">Feb</option>
	              <option value="2">Mar</option>
	              <option value="3">Apr</option>
	              <option value="4">May</option>
	              <option value="5">Jun</option>
	              <option value="6">Jul</option>
	              <option value="7">Aug</option>
	              <option value="8">Sep</option>
	              <option value="9">Oct</option>
	              <option value="10">Nov</option>
	              <option value="11">Dec</option>
	          </select>
            </td>
            <td colspan="2" align="center">
			    <select onChange="showCalenderBody(createCalender(this.value,
				document.getElementById('selectMonth').selectedIndex, false));" id="selectYear">
				</select>
			</td>
            <td align="center">
			    <a href="#" onClick="closeCalender();"><font color="#003333" size="+1">X</font></a>
			</td>
		  </tr>
       </tbody>
       <tbody id="calenderTableDays">
         <tr style="">
           <td>Sun</td><td>Mon</td><td>Tue</td><td>Wed</td><td>Thu</td><td>Fri</td><td>Sat</td>
         </tr>
       </tbody>
       <tbody id="calender"></tbody>
    </table>
<!-- End Calender Script  -->
  </form>
  <br><br><br><br>
  <!-- Mark Your Attendance FOR EACH SUBJECT CODE-->
  <form  action="markMyAttendance.php" method="POST">
  CC <select id="sub0">
          <option value="p">
            Present
          </option>
          <option value="a">
            Absent
          </option>
        </select>
        <br>
  IS <select id="sub1">
          <option value="p">
            Present
          </option>
          <option value="a">
            Absent
          </option>
        </select>
        <br>
  WT <select id="sub2">
          <option value="p">
            Present
          </option>
          <option value="a">
            Absent
          </option>
        </select>
        <br>
  SPM <select id="sub3">
          <option value="p">
            Present
          </option>
          <option value="a">
            Absent
          </option>
        </select>
        <br><th>
  ECOM <select id="sub4">
          <option value="p">
            Present
          </option>
          <option value="a">
            Absent
          </option>
        </select>
        <br>
  </form>
  <div id="d"></div>
  <div id="d1"></div>
<input type="submit" onclick="attendanceCounter()">
  <!--<button id="subject1" onclick="activateButton()">DMBI</button>
  <button class="subjects">AIT</button>-->
</body>
</html>
