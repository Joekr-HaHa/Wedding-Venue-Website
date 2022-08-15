<!--The results should include the venue name,
capacity, licensed, catering cost per person, price of week/weekend day, total price, the number of times
that the venue had been booked before (to show the user how much the venue is popular), and the day of
week (Monday, Tuesday, …) for the selected date-->

<!DOCTYPE html>
<html lang ="en"><!--relevant imports for ajax and boostrap-->
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<title>Wedding Booking</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
 
<style>
body {
	font-family: "Apple Chancery", Times, serif;
	/*background-color: #D6D6D6;*/
    background-image: url('flowers.jpeg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
}
.center {
	text-align:center;
}
body,td,th {
    border:3px;
	color: #06F; 
}
.larger {
	font-size:larger;
	
}
table {
    background-color:#FFFFFF;
	margin-left:auto;
	margin-right:auto;
    border-collapse:collapse;
    width:80%;
    border-style:outset;
    border-width:0.3em;
    border-color:#ff66cc;
}
.separate{
    border-left:solid;
    border-color:#ff66cc;
    border-width:0.18em; 
}
td{
    width:60%;
}
tr { 
  border: solid;
  border-width: 1px 0;
}
table.table1{
  font-size:1.5em;
  text-align:center;
  width:60%;/*60%*/ 
  margin-left:auto;
  margin-right:auto;
  border-style:outset;
  border-width:0.3em;
  border-color:#6666dd;}
th.head{
    width:auto;
    color:#ffffff;
    font-size:0.5em;
  border-style:inset;
  border-width:0.15em;
  border-color:#ff66cc;
  background-color:#ff66cc;}
td.cell1{
    width:auto;
    color:#ffffff;
    font-size:0.5em;
  border-style:inset;
  border-width:0.15em;
  border-color:#ff66cc;
  background-color:#ff66cc;}
td.cell2{
    width:auto;
    color:#ff66cc;
    font-size:0.5em;
  border-style:inset;
  border-width:0.15em;
  border-color:#ff66cc;
  background-color:#ffffff;
}
td:hover{
  background-color:#ffbbff;}

</style>
<script>
  //loads navbar from external file mynavbar.html to the navbar id in this file
    $.get("myNavbar.html", function(data) {
$("#myNavbar").html(data);});
//loads footer from external file footer.html to the footer id in this file
$.get("footer.html", function(data) {
$("#footer").html(data);});
    </script>
<script>
  let datey={};//defines datey and name as global, as these will need to be used in the onchange function for the dates
  let name="";
$(document).ready(function() {
            $("#submit").click(function() {//when the submit button clicked, will show a loading spinner until table appears
                let load='<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only"></span></div></div>'
                $("#table").html(load);//gets all inputted values from form
                let c1 = $("#c1").val();
                let c2 = $("#c2").val();
                let c3 = $("#c3").val();
                let c4 = $("#c4").val();
                let c5 = $("#c5").val();
                let min = $("#minCapacity").val();
                let max = $("#maxCapacity").val();
                let date = $("#date").val();
                let endDate = $("#endDate").val();
                $.ajax({//ajax for sending data to process-wedding-request.php for querying database
                    url: "process-wedding-request.php",
                    type: "GET",
                    data: {c1:c1,c2:c2,c3:c3,c4:c4,c5:c5,
                    min:min,max:max,date:date,endDate:endDate},
                    success: function (responseData) {//once response received from process-wedding-request
                        let len = responseData.length;
                        let insertedHtml="<br><br><br><br><h1><table>";//html string to be inserted
                        let headings=["Capacity","Grade","Licensed","Cost","Weekend Price","Weekday Price","No. Of Bookings","Day(s) Unavailable","Book"];
                        for(let i=0;i<headings.length;i++){//adds headings to table to be inserted
                        insertedHtml+="<th class=\"head\">"+headings[i]+"</th>";
                        }
                        let dates={};//to store the unavailable dates for each venue
                        let numGrades={};//to store each unique grade for each venue within the user inputted restrictions
                        //let insertedHtml = "<table><tr><th></th><th>Name</th><th>DOB</th></tr>";
                        for (let i = 0; i < len; i++) {//gets all elements from the sql response json
                            name = responseData[i].name;
                            let capacity = responseData[i].capacity;
                            let grade = responseData[i].grade;
                            let licensed = responseData[i].licensed;
                            let cost = responseData[i].cost;
                            let weekend_price = responseData[i].weekend_price;
                            let weekday_price = responseData[i].weekday_price;
                            let popularity=responseData[i].popularity;
                            let day_booked=responseData[i].booking_date;
                            
                            //make an array of unavailable dates for every location
                            if(dates[name]==undefined){
                              dates[name]=[];
                            }
                            let flag=false;//checks if day booked already in unavailable dates
                            for(let k=0;k<dates[name].length;k++){
                              if(dates[name][k]==day_booked){
                                flag=true;
                              }
                            }
                            if((day_booked>=date&&day_booked<=endDate)&&!flag){//if day booked is an unavailable date and not already in unavailable dates dictionary, add it
                            dates[name].push(day_booked);}
                            if(numGrades[name]==undefined){
                              numGrades[name]=[];
                            }
                            flag=false;
                            for(let k=0;k<numGrades[name].length;k++){
                              if(numGrades[name][k]==grade){
                                flag=true;
                              }
                            }
                            if(!flag){//if the catering grade not already in the dictionary for catering grades, add it
                            numGrades[name].push(grade);}}
                        datey=dates;
                        let nameLast="";//used to store name of venue to last be displayed in table
                        let lastGrade=0;//used to store catering grade to last be displayed in table
                        //let places=Object.keys(datey);
                        let multiDate=false;
                        let doDate=true;//whether dates should be displayed
                        for(let j=0;j<len;j++){
                            name = responseData[j].name;
                            let capacity = responseData[j].capacity;
                            let grade = responseData[j].grade;
                            let licensed = responseData[j].licensed;
                            let cost = responseData[j].cost;
                            let weekend_price = responseData[j].weekend_price;
                            let weekday_price = responseData[j].weekday_price;
                            let popularity=responseData[j].popularity;
                            let day_booked=responseData[j].booking_date;
                            if(datey[name].length==0){//displays available if no unavailable dates for a venue, needs to change dates for each location
                              day_booked="Available all days";
                            }
                            if(datey[name].length>=1){//will display unavailable dates if there are some
                              multiDate=true;
                            }
                            if(name!=nameLast){//if the venue name is new, will output the new venue name
                              insertedHtml+="<tr><td colspan="+9+" style=\"text-align:center;vertical-align:middle\">"+name+"</td></tr>";
                              lastGrade=0;
                              doDate=true;
                              multiDate=false;
                            }
                            if(grade==lastGrade){//continues to next response if catering grade is the same as last, to avoid repeated data
                              nameLast=name;
                              gradeLast=grade;
                              continue;
                            }
                            //adds relevant data to html to be inserted
                            insertedHtml += "<tr>" +
                               // "<td class=\"cell1\">" + name + "</td>" +
                                "<td class=\"cell2\">" + capacity + "</td>" +
                                "<td class=\"cell1\">" + grade + "</td>" +
                                "<td class=\"cell2\">" + licensed + "</td>" +
                                "<td class=\"cell1\">" + cost + "</td>" +
                                "<td class=\"cell2\">" + weekend_price + "</td>" +
                                "<td class=\"cell1\">" + weekday_price + "</td>" +
                                "<td class=\"cell2\">" + popularity + "</td>";
                                if(false){
                                insertedHtml+="<td class=\"cell1\">" + day_booked + "</td>";}
                                if(datey[name].length!=0&&doDate){//if there are unavailable dates, output them
                                  insertedHtml+="<td class=\"cell1\" rowspan="+numGrades[name].length+">";
                                  for(let k=0;k<datey[name].length;k++){//date formatting
                                    insertedHtml+=(new Date(datey[name][k]).toLocaleDateString('en-UK'));
                                    insertedHtml+="\n";
                                  }
                                  insertedHtml+="</td>";
                                  doDate=false;
                                }
                                let date1=date;
                                for(let y=0;y<datey[name].length;y++){
                                  if(datey[name][y]==date){//if an unavailable date is the same as the minimum, then the minimum is shifted up by one, to not include it
                                    date1=new Date(date);
                                    date1.setDate(date1.getDate()+1)
                                    let month=date1.getMonth()+1;
                                    let day=date1.getDate();
                                    if(month<10){
                                      month="0"+month;
                                    }
                                    if(day<10){
                                      day="0"+day;
                                    }
                                    date1=date1.getFullYear()+"-"+month+"-"+day;
                                    //date1.format('yyyy-mm-dd');
                                    //datel=date1;
                                    break;
                                  }
                                }
                                //date picker element for available dates
                                insertedHtml+="<td class=\"cell2\"><input name=\"tableDate\" type=\"date\" \
                                class=\""+name+"\" id=\"tableDate\" value=\""+date1+"\" size=\"3\" \
                                min=\""+date1+"\" max=\""+endDate+"\" onchange=\"stuffs(event)\" style=\"font-size:larger;\"/></td>" +
                                "</tr>";
                                nameLast=name;
                                lastGrade=grade;
                                /*
                                insertedHtml+="\
                                <datalist id=\"available_dates\">"
                                for(let j=0;j<dates.length;j++){
                                    insertedHtml+="<option>"+dates[j]+"</option>";}
                                insertedHtml+="</datalist>";*/
                        }
                        insertedHtml += "</table>";
                        //puts the insertedhtml in the table id in the page
                        $("#table").html(insertedHtml);
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.status + ': ' + xhr.statusText);
                    },
                    dataType: "json"
                });
            });
        });
        //called by date picker on click
        function stuffs(e){//will return unavailable if user selects date that is unavailable
          let flag=false;
          //alert(e.target);
          let el=e.target;

          //alert(el.className);
          //el=(el.toString()).split(" ");
          let name=el.className;
          //alert(el.className);
          //alert(datey[name]);
                            for(let k=0;k<datey[name].length;k++){
                              if(datey[name][k]==e.target.value){
                                flag=true;
                              }
                            }
                            if(flag){
                              e.target.value=e.target.min;//sets value of datepicker to the minimum, so unavailable date not selected
                              alert("Date Unavailable");
                            }
        }
    </script>
</head>
<body id="mainBody">
<div id="myNavbar"><!--for navbar to be imported into-->
        </div>
<br><br>
<div class="card center-block" style="margin:auto; max-width:50%; position:relative"><!-- card element w/ white background for text to be put on it-->
<div class="card-data">
<h3 class="center">COA123 - Web Programming</h3>
<h2 class="center">Individual Coursework - Wedding Booking</h2>

<h1 class="center">Task 4 - Wedding (wedding.php)</h1>
</div>
</div>
<br><br>
  <form action="weddingtest2.php" method="get" id="weddingtest2" onsubmit="return false"><!--form which will take the user input data to be passed to process-wedding-request.php to get sql query result-->
    <table border="1">
      <tr>
        <th scope="col">Key</th>
        <th scope="col" class="separate">Value</th>
      </tr>
      <tr>
        <td><label for="minCapacity">Minimum capacity of venue (minCapacity)</label></td>
        <td class="separate">
          <input name="minCapacity" type="text" class="larger" id="minCapacity" value="150" size="12" />
        </td>
      </tr>
      <tr>
        <td><label for="maxCapacity">Maximum capacity of venue (maxCapacity)</label></td>
        <td class="separate"><input name="maxCapacity" type="text" class="larger" id="maxCapacity" value="220" size="12" /></td>
      </tr>
      <tr>
        <td><label for="c1">Cost at grade 1 (c1) </label></td>
        <td class="separate"><input name="c1" type="text" class="larger" id="c1" value="5" size="5" /></td>
      </tr>
      <tr>
        <td><label for="c2">Cost at grade 2 (c2) </label></td>
        <td class="separate"><input name="c2" type="text" class="larger" id="c2" value="10" size="5" /></td>
      </tr>
      <tr>
        <td><label for="c3">Cost at grade 3 (c3) </label></td>
        <td class="separate"><input name="c3" type="text" class="larger" id="c3" value="15" size="5" /></td>
      </tr>
      <tr>
        <td><label for="c4">Cost at grade 4 (c4) </label></td>
        <td class="separate"><input name="c4" type="text" class="larger" id="c4" value="20" size="5" /></td>
      </tr>
      <tr>
        <td><label for="c5">Cost at grade 5 (c5) </label></td>
        <td class="separate"><input name="c5" type="text" class="larger" id="c5" value="25" size="5" /></td>
      </tr>
      <tr>
        <td><label for="start">Start Date</label></td>

        <td class="separate">
          <input name="date" type="date" class="larger" id="date" value="2022-05-26" size="3" />
        </td>
      </tr>
      <tr>
        <td><label for="end">End Date</label></td>

        <td class="separate">
          <input name="endDate" type="date" class="larger" id="endDate" value="2022-05-28" size="3" />
        </td>
      </tr>
      <tr>
        <td>List names and prices of available licensed venues with given capacity</td>
        <td><input type="submit" name="submit" id="submit" value="Submit" class="larger" /></td>
      </tr>
    </table>
  </form>
  <div id="table"><!-- for table with sql query return values to be imported to-->
        </div>
        <div id="footer"></div><!-- id for footer to be imported to-->
</body>
</html>
<!--
/*
if(isset($_GET['submit'])){
/*echo "<script>
 $(document).ready(function(){
    $(\"#table\").load(\"table.php\");
});
  </script>";}
/*echo" <script>
          let c1=".$c1.";
          let c2=".$c2.";
          let c3=".$c3.";
          let c4=".$c4.";
          let c5=".$c5.";
          let min=".$min.";
          let max=".$max.";
          let date=".$date.";
          let endDate=".$endDate.";
          $.ajax({
              url: \"table.php\",
              type: \"GET\",
              data: {c1:c1,c2:c2,c3:c3,c4:c4,c5:c5,min:min,max:max,date:date,endDate:endDate},
              success: function (responseData) {
                console.log('hiya');
                console.log(responseData);
                $(\"#table\").html(json_decode(responseData));
                  }
              },
              error: function (xhr, status, error) {
                $(\"#table\").html(<h1>bruh</h1>);
                  console.log(xhr.status + ': ' + xhr.statusText);
              },
              dataType: \"json\"
          });
</script>";}*/

//echo "<table>Hiya</table>";
/*
$c1=$_GET['c1'];
$c2=$_GET['c2'];
$c3=$_GET['c3'];
$c4=$_GET['c4'];
$c5=$_GET['c5'];
$min=$_GET['minCapacity'];
$max=$_GET['maxCapacity'];
$date=$_GET['date'];
$endDate=$_GET['endDate'];
//echo "<h1>".$c1,$c2,$c3,$c4,$c5,$min,$max,$date."</h1>";
/*venue name,
capacity, licensed, catering cost per person, price of week/weekend day, 
total price, the number of times
that the venue had been booked before 
(to show the user how much the venue is popular), and the day of
week (Monday, Tuesday, …) for the selected date*/
/*

$username = "coa123wuser";
$password = "grt64dkh!@2FD";
$servername = "sci-mysql";
$dbname = "coa123wdb";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT venue.name,venue.capacity,catering.grade,licensed,catering.cost,venue.weekend_price,venue.weekday_price,COUNT(venue_booking.venue_id)
FROM venue_booking LEFT JOIN venue ON venue_booking.venue_id=venue.venue_id LEFT JOIN catering ON catering.venue_id=venue.venue_id
WHERE venue_booking.booking_date NOT BETWEEN DATE('".$date."') AND DATE('".$endDate."')
AND (catering.grade IN (SELECT catering.grade FROM catering WHERE catering.cost<".$c1." AND catering.grade=1)
OR catering.grade IN (SELECT catering.grade FROM catering WHERE catering.cost<".$c2." AND catering.grade=2)
OR catering.grade IN (SELECT catering.grade FROM catering WHERE catering.cost<".$c3." AND catering.grade=3)
OR catering.grade IN (SELECT catering.grade FROM catering WHERE catering.cost<".$c4." AND catering.grade=4)
OR catering.grade IN (SELECT catering.grade FROM catering WHERE catering.cost<".$c5." AND catering.grade=5))
AND venue.capacity<".$max." AND venue.capacity>".$min."
GROUP BY venue.name, venue.capacity,catering.grade,licensed,catering.cost,venue.weekend_price,venue.weekday_price
ORDER BY COUNT(venue_booking.venue_id) DESC;";
$result=mysqli_query($conn,$query);

$allDataArray=array();
while ($row= mysqli_fetch_array($result)){
        $allDataArray[] = $row;
        }

$str="<h1 class=\"center\">Day of the week for ".$date." is ".date('D', strtotime($date))."</h1><br><br><table class=\"table1\">";
$headings=array("name","capacity","grade","licensed","cost","weekend_price","weekday_price","COUNT(venue_booking.venue_id)");
for($i=0;$i<count($headings);$i++){
    $str.="<th class=\"head\">".$headings[$i]."</th>";
}
for($i=0;$i<count($allDataArray);$i++){
    $str.="<tr>";
for($j=0;$j<count($headings);$j++){
$color="cell2";
if($headings[$j]=="name"){
    $color="cell1";
}
$str.="<td class=".$color.">".$allDataArray[$i][$headings[$j]]."</td>";}
$str.="</tr>";
}
$str.="</table>";
echo $str;


}?>-->