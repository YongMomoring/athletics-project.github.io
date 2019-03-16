
<?php
if(isset($_POST['submit'])){
	
	var_dump($_POST['check_list']);
}

?>
<script>
var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

</script>
<form action="loading.php" method="POST">
<div onclick="showCheckboxes()">
		<input type="text" readonly value="--Select Your Preference--" style="cursor: pointer;">
</div>
<div id="checkboxes" style="display:none">
<input type="checkbox" name="check_list[]" value="C/C++"><label>C/C++</label>
<br>
<input type="checkbox" name="check_list[]" value="Java"><label>Java</label>
<br>
<input type="checkbox" name="check_list[]" value="PHP"><label>PHP</label>
</div>
<input type="submit" name="submit">
</form>