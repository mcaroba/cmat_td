<!DOCTYPE html>
<html>
  <head>
    <title>Miguel Caro's CMAT Teaching Demo</title>
  </head>
  <body>

    <?php
      include("header.html");
    ?>

    <div>
    <?php
      $randint = $_POST["randint"];
      $Np = $_POST["Np"];
      $L = $_POST["L"];
      $T = $_POST["T"];
      $target_dir = $_POST["target_dir"];
      $command = $_POST["command"];
      echo "<p>";
      echo "Current session ID: $randint</br>";
//      echo "Command: " . $command . "</br>";
      echo "</p>";
    ?>
    </div>
    <div>
    <?php
//***************************************************************************
//    Fortran part
      exec( $command );
//***************************************************************************
//
//***************************************************************************
//    Gnuplot part
      exec( "./gnuplot.script.sh $target_dir $L" );
      exec( "gnuplot $target_dir/gnuplot.script" );
//    VMD part
      exec( "/home/caro/apps/vmd/vmd_1.9.3/bin/vmd -e " . $target_dir . "/vmd.script" );
      exec( "/usr/bin/convert -delay 10 $target_dir/snap.*.tga -loop 0 $target_dir/movie.gif &> $target_dir/out" );
//***************************************************************************
//
    ?>
    </div>

    <div style="display:inline-block;padding:2pt;border-style:solid;border-width:1px;width:680px;text-align:center">
      <h3>Structure</h3>
      <?php
        echo "<div>";
        echo "<img src='" . $target_dir . "movie.gif'>";
        echo "</div>";
      ?>
      <h3>Data so far</h3>
      <?php
        echo "<div>";
        echo "<img src='" . $target_dir . "plot.png'>";
        echo "</div>";
      ?>
    </div>

    <div>
    <p>
    <form action="index.php">
      <input type="submit" value="Start over" />
    </form>
    </p>
    </div>

  </body>
</html>
