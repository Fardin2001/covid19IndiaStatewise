<!DOCTYPE html>
<html>
<head><!--https://api.covid19india.org/data.json-->
	<title>CovidIndia</title>
	<?php include 'links.php'; ?>
 	<?php include 'style.php'; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body onload="fetch();">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex justify-content-center">
 <h1 class="navbar-brand line" href="#">INDIA'S COVID-19 LIVE STATS</h1>
 <h6 style="color:#fff;">Developed by findfardin</h6>
</nav>
<section class=" corona-update container-fluid">
	<div class="mb-4">
		<h2 class="text-center text-uppercase pt-3 pb-0">covid-19 live updates of India</h2>
	</div>
	<!--All India-->
	<div class="row text-center">
		<div class="col-lg-2 col-md-2 col-12">
			<h5 class="font-weight-bold pt-0">All over India</h5>
			<h3 class="count pb-2" id="AOI"><img src="../image/INDIA.jpg" id="India"></h3>
		</div>

		<div class="col-lg-2 col-md-2 col-12">
			<h5 class="font-weight-bold">Total confirmed</h5>
			<h3 class="count pb-2" id="TC"></h3>
		</div>

		<div class="col-lg-2 col-md-2 col-12">
			<h5 class="font-weight-bold">Total active</h5>
			<h3 class="count pb-2" id="TA"></h3>
		</div>

		<div class="col-lg-2 col-md-2 col-12">
			<h5 class="font-weight-bold">Total recovered</h5>
			<h3 class="count pb-2" id="TR"></h3>
		</div>

		<div class="col-lg-2 col-md-2 col-12">
			<h5 class="font-weight-bold">Total deaths</h5>
			<h3 class="count pb-2" id="TD"></h3>
		</div>

		<div class="col-lg-2 col-md-2 col-12">
			<h5 class="font-weight-bold">Last update</h5>
			<h3 class="count pb-2" id="LU"></h3>
		</div>
</div>

<!--SEARCH BOX-->
<div class="text-center">
		<!--Search box-->
		<input class=" text-center mb-3 pl-5 pr-5 pt-2 pb-2 search-box" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for countries.." title="Search here">
		<p>[Please avoid spaces after name]</p>
		<div class="scrollLeft"><p>Scroll left-></p></div>
</div>
<!--TABLE HEADING-->
<div class="text-center table-responsive">
	<table class="table table-bordered table-striped table-dark" id="corona_table">
		<tr>
			
			<th>State</th>
			<th>Last update</th>
			<th>Confirmed</th>
			<th>Active</th>
			<th>Recovered</th>
			<th>Deaths</th>
		</tr>
		</table>
</div>
</section>
<!--Access the data statewise from API-->
<?php 
	//this method is working on localhost and not on live web
	 // $x=file_get_contents('https://api.covid19india.org/data.json');
	 // $json=json_decode($x,true);//decode it using json
	 // $state=$json['statewise'];//state data
	 // // echo "<pre>";
	 // // print_r($state);

//HERE IS THE ALTERNATIVE OF ABOVE WORK
		$x = 'https://api.covid19india.org/data.json';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $x);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec ($ch);
    curl_close ($ch); 
    $json=json_decode($content,true);//decode it using json
	$state=$json['statewise'];//state data -->
	// echo "<pre>";
 //    print_r($state);

	 ?>
<script type="text/javascript">
var corona_table = document.getElementById('corona_table');//take table
/*Passing php states array to  javascript variable*/	
	var state = <?php echo json_encode($state); ?>;
	for(i=1;i<(state.length);i++){

	  var y=corona_table.insertRow();//row insert
	  //Data insertion
	  y.insertCell(0);
	corona_table.rows[i].cells[0].innerHTML= state[i]['state'];	

	y.insertCell(1);
	corona_table.rows[i].cells[1].innerHTML= state[i]['lastupdatedtime'];	

	y.insertCell(2);
	corona_table.rows[i].cells[2].innerHTML= state[i]['confirmed'];	

	y.insertCell(3);
	corona_table.rows[i].cells[3].innerHTML= state[i]['active'];	

	y.insertCell(4);
	corona_table.rows[i].cells[4].innerHTML= state[i]['recovered'];	

	y.insertCell(5);
	corona_table.rows[i].cells[5].innerHTML= state[i]['deaths'];

		
	}

/*All India Data*/
document.getElementById('TC').innerHTML =state[0]['confirmed'];
document.getElementById('TA').innerHTML =state[0]['active'];	 
document.getElementById('TR').innerHTML =state[0]['recovered'];	 
document.getElementById('TD').innerHTML =state[0]['deaths'];	 
document.getElementById('LU').innerHTML =state[0]['lastupdatedtime'];	 	 



</script>
<script>
/*For search box*/
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("corona_table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}	

</script>
</body>
</html>