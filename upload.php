<!DOCTYPE html>
<html>
  <head>
    <title>Miguel Caro's CMAT Teaching Demo</title>
  </head>

  <?php
    echo '<body onload="document.compute.submit()">';
  ?>

    <?php
      include("header.html");
    ?>

    <div>
    <?php
        $randint = $_POST["randint"];
//        $Np = $_POST["Np"];
//        $L = $_POST["L"];
        $Rho = $_POST["Rho"]; $array = explode("_", $Rho); $Np = $array[0]; $L = $array[1];
        $T = $_POST["T"];
        $name = $_POST["name"];
        $target_dir = "temp/" . $randint . "/";

        $command = "cd $target_dir ; data=\$(echo $Np $L $T 100000 | ../../bin/lj); echo \$data $name >> ../../NVTP.dat; cd ../..";
        echo "<p>";
        echo "Current session ID: $randint</br>";
        echo "</p>";
        echo "<p>";
        echo "Please wait while we run the MD simulation with your chosen parameters...</br>";
        echo "(this may take a couple of seconds to a minute, depending on parameters)";
        echo "</p>";
//        echo $command;
        echo '<div>
              <img src="misc/loader.gif">
              </div>
              <div>
              <p>
              <form action="index.php">
                <input type="submit" value="Start over" />
              </form>
              </p>
              </div>';
    ?>
    <form action="compute.php" name="compute" method="post" enctype="multipart/form-data">
      <input type="hidden" name="randint" value="<?php echo $randint; ?>" />
      <input type="hidden" name="Np" value="<?php echo $Np; ?>" />
      <input type="hidden" name="L" value="<?php echo $L; ?>" />
      <input type="hidden" name="T" value="<?php echo $T; ?>" />
      <input type="hidden" name="target_dir" value="<?php echo $target_dir; ?>" />
      <input type="hidden" name="command" value="<?php echo $command; ?>" />
    </form>
    </div>

  </body>
</html>
