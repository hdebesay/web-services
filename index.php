<html>
<head>
<title>Henok's Top 10 Movies</title>
<style>
	body {font-family:georgia}

  .film{
    border:1px solid #E77DC2;
    border-radius: 10px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }
  
  .pic img{
	max-width:50px;
  }

</style>
  
<script src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">

function bondTemplate(film){
  
return `
  
  <div class="film">
      <b>Film</b>: ${film.Film}<br /> 
      <b>Title</b>: ${film.Title}<br /> 
      <b>Year</b>: ${film.Year}<br /> 
      <b>Director</b>: ${film.Director}<br /> 
      <b>Writers</b>: ${film.Writers}<br /> 
      <b>Actors</b>: ${film.Actors}<br />   
    </div>
  
    `; 
  
  }


  
$(document).ready(function() { 
 
 $('.category').click(function(e){
   e.preventDefault(); //stop default action of the link
   cat = $(this).attr("href");  //get category from URL
  
   var request = $.ajax({
     url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
   request.done(function( data ) {
     console.log(data);

    $("#filmtitle").html(data.title);

    $("#films").html("");

     
    $.each(data.films,function(i,item){
          let myData =  bondTemplate(item);
         $("<div></div>").html(myData).appendTo("#films");
      });

     $("#output").html(myData);
      
/*      // let myData = JSON.stringify(data,null,4);
     //  myData = "<pre>" + myData + "</pre>";
     // $("#output").html(myData); */

   });
   request.fail(function(xhr, status, error ) {
alert('Error - ' + xhr.status + ': ' + xhr.statusText);
   });
 
  });
}); 



</script>
</head>
	<body>
	<h1>Henok's Top 10 Movies</h1>
		<a href="year" class="category">My Favorite Films By Year</a><br />
		<a href="box" class="category">My Favorite Films In Order</a>
		<h3 id="filmtitle">Title Will Go Here</h3>
		<div id="films">


		</div>


		<div id="output">Results go here</div>
	</body>
</html>
