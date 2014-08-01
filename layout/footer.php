<?php
	include_once ('../databases.php');
?>
      <hr>

      <footer>
        <ol class="breadcrumb">
        <?php
        	// Display Breadcrumbs from the "bread" array.
        	if (isset($bread)) {
        		foreach ($bread as $key => &$val) {
					if ($val == "")
						echo "<li class='active'>" . $key . "</li>";
  					else
  						echo "<li><a href='" . $val . "'>" . $key . "</a></li>";
  				}
  			}
		?>
		</ol>


      </footer>
    </div> <!-- /container -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="<?php echo $webFront; ?>layout/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $webFront ?>layout/js/display.js"></script>

  </body>
</html>