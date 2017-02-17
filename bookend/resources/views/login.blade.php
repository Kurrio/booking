<!DOCTYPE html>
<html lang="en">
<head>
  <title>Logg inn</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

      <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>

<div class="container">
	<div class="frame">
  <h1 class="form-signing-heading">Logg inn</h1>
  <form class="form-signing">
    <div class="form-group">
      <label for="email" class="label_log_in">E-post</label>
      <input type="email" class="form-control" id="email" placeholder="E-post">
    </div>
    <div class="form-group">
      <label for="pwd" class="label_log_in">Passord</label>
      <input type="password" class="form-control" id="pwd" placeholder="Passord">
    </div>
    <div class="checkbox">
      <label><input type="checkbox"> Husk meg </label>
    </div>
    <button type="submit" class="btn_frontPage" id="btn_log_in">Logg inn</button>
    <div class="btn_group btn-group-justified">
    	<button type="submit" class="btn_frontPage col-xs-5" id="btn_new_user"> Ny bruker</button>
    	<button type="submit" class="btn_frontPage col-xs-5" id="btn_forgot_password"> Glemt passord</button>
    </div>

      <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <h4><label>Skriv inn din e-post</label></h4><br/>
      <input type="email" id="e-post-im" class="new-content" placeholder="E-post" required autofocus>
      <button class="btn_frontPage" type="submit" id="send">Send</button>
    </div>

  </div>

</div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("btn_forgot_password");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


</body>
</html>
