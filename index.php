<!DOCTYPE html>
<html>
<head><!--https://api.covid19india.org/data.json-->
	<title>Covid19 Live</title>
	<?php include 'links.php'; ?>
 	<?php include 'style.php'; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body onload="fetch();">
<nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-center" id="sticky">
 <h1 class="navbar-brand line" href="#">INDIA'S COVID-19 LIVE STATS</h1>
 <h6 style="color:#000;" id="findfardin">Developed by findfardin</h6>
 <button id="btn" class="mb-2 ml-5" onclick="modeChange();">Night mode</button>
</nav>
<section class=" corona-update container-fluid" id="mainsec">
	<div class="mb-4">
		<h2 class="text-center text-uppercase pt-3 pb-0">covid-19 live updates of India</h2>
	</div>
	<!--All India-->
	<div class="row text-center">
		<div class="col-lg-2 col-md-2 col-12">
			<h5 class="font-weight-bold pt-0">All over India</h5>
			<h3 class="count pb-2" id="AOI"><img src="INDIA.jpg" id="India"></h3>
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
<div class="text-center" id="myInputSticky">
		<!--Search box-->
		<input class=" text-center mb-3 pl-5 pr-5 pt-2 pb-2 search-box" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for states.." title="Search here">
</div>
<!--TABLE HEADING-->
<div class="text-center table-responsive">
	<table class="table table-bordered table-striped table-light" id="corona_table">
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
	//echo "<pre>";
    //print_r($state);

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
//----------------------------------Day Night mode------------------------------------------
function modeChange(){
	var webMode = document.querySelector('#btn').textContent;
	if(webMode=="Night mode"){

	 	document.querySelector('#corona_table').classList.remove("table-light");
		document.querySelector('#corona_table').classList.add("table-dark");
		document.querySelector('#sticky').classList.remove("navbar-light");
		document.querySelector('#sticky').classList.add("navbar-dark");
		document.querySelector('#sticky').classList.remove("bg-light");
		document.querySelector('#sticky').classList.add("bg-dark");
		document.querySelector('#findfardin').style="color:#fff;"
		document.body.style="background-color:#3E444A"
		document.querySelector('#mainsec').style="color:#fff;"
		document.querySelector('#contact').style="color:#fff;"
		document.querySelector('#btn').textContent="Day mode"
		document.querySelector('#myInput').style="background-color:#343A40;border:2px solid #fff"

	}else{

		document.querySelector('#corona_table').classList.remove("table-dark");
		document.querySelector('#corona_table').classList.add("table-light");
		document.querySelector('#sticky').classList.remove("navbar-dark");
		document.querySelector('#sticky').classList.add("navbar-light");
		document.querySelector('#sticky').classList.remove("bg-dark");
		document.querySelector('#sticky').classList.add("bg-light");
		document.querySelector('#findfardin').style="color:#3E444A;"
		document.body.style="background-color:#fff"
		document.querySelector('#mainsec').style="color:#3E444A;"
		document.querySelector('#contact').style="color:#3E444A;"
		document.querySelector('#btn').textContent="Night mode"
		document.querySelector('#myInput').style="background-color:#fff"


	}


}
</script>
<div>
	<h5 class="text-center">
		<p style="text-decoration: underline;" id="contact">contact me </p>
		<a href="mailto:fardinkhan2k1@gmail.com">fardinkhan2k1@gmail.com</a></h5>
</div>




<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-168057427-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

        gtag('config', 'UA-168057427-1');
        </script>
        
</body>
</html>