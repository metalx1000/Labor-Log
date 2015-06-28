<!DOCTYPE html>
<html lang="en">
<head>
  <title>Labor Log</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script>
    var log;
    $(document).ready(function(){
      if(localStorage.labor){
        log = JSON.parse(localStorage['labor']);
      }else{
        log = [];
      }

      $("#add_btn").click(function(){
        log.push(Date());
        localStorage['labor'] = JSON.stringify(log);
        $("#log_table").html("");
        update();
      });

      update();
    });

    function update(){
      var last = 0;
      log.forEach(function(entry){
        var date = new Date(entry)
        var time = date.getTime();
        var diff = (time - last) / 1000;
        last = time;
        console.log(diff);
        $("#log_table").append("<tr><td>Contraction Logged</td><td>"+
          entry+"</td>"+
          "</tr>");
      });
    }
  </script>
</head>
<body> 

<div class="container">
  <h2>Labor Log</h2>
  <p>Click below to log contraction times</p>            
  <button id="add_btn" type="button" class="btn btn-primary btn-block btn-lg">Add Contraction Time</button>
  <table class="table table-striped">
    <thead>
      <tr><th>Labor Log</th></tr>
    </thead>
    <tbody id="log_table">
    </tbody>
  </table>
</div>

</body>
</html>
