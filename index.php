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
        update();
      });

      update();
    });

    function update(){
      var last = 0;
      $("#log_table").html("");
      for(var i=0;i<log.length;i++){
        var entry = log[i];
        var date = new Date(entry);
        var time = date.getTime();
        var diff = (time - last) / 1000;
        if(last == 0){
          var minutes = "First Entry";
        }else{
          var minutes = Math.round(diff / 60);
        }
        last = time;
        
        $("#log_table").append("<tr><td>"+
          //Contraction Logged</td><td>"+
          entry+"</td><td>"+
          minutes+"</td><td>"+
          "<span index='"+i+"' class='remove glyphicon glyphicon-remove-sign' style='color:red;font-size: 2em'></span></td><td>"+
          "</tr>");
      };

  
      //remove entries
/*
      var removeIndex;
      $(".remove").click(function(){
        removeIndex = $(this).attr('index');
        var msg = log[removeIndex];
        $("#removeMsg").html(msg);
        $('#removeModal').modal('show');
      });

      $("#delete").click(function(){
        console.log(removeIndex);
        console.log(log);
        log.splice(removeIndex, 1);
        //localStorage['labor'] = JSON.stringify(log);
        update();
      })
*/
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
      <tr>
        <!--<th>Labor Log</th>-->
        <th>Time of Contractions</th>
        <th>Minutes Since Last</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody id="log_table">
    </tbody>
  </table>
  <hr>
  <p>Time since last contraction is rounded to nearest minute</p>            
</div>

<!-- Modal -->
<div id="removeModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Would you like to remove this entry?</h4>
      </div>
      <div class="modal-body">
        <p id="removeMsg"></p>
      </div>
      <div class="modal-footer">
        <button id="delete" type="button" class="btn btn-danger" data-dismiss="modal">Delete Entry</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>


</body>
</html>
