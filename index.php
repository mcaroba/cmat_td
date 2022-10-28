<!DOCTYPE html>
<html>
  <head>
    <title>Miguel Caro's CMAT Teaching Demo</title>
<SCRIPT>
// preload images
var img80 = new Image().src = "misc/thermometer/80.png"
var img90 = new Image().src = "misc/thermometer/90.png"
var img100 = new Image().src = "misc/thermometer/100.png"
var img110 = new Image().src = "misc/thermometer/110.png"
var img120 = new Image().src = "misc/thermometer/120.png"
var img130 = new Image().src = "misc/thermometer/130.png"

var img50_30 = new Image().src = "misc/atoms/50_30.png"
var img50_40 = new Image().src = "misc/atoms/50_40.png"
var img50_50 = new Image().src = "misc/atoms/50_50.png"
var img50_60 = new Image().src = "misc/atoms/50_60.png"
var img60_30 = new Image().src = "misc/atoms/60_30.png"
var img60_40 = new Image().src = "misc/atoms/60_40.png"
var img60_50 = new Image().src = "misc/atoms/60_50.png"
var img60_60 = new Image().src = "misc/atoms/60_60.png"
var img70_30 = new Image().src = "misc/atoms/70_30.png"
var img70_40 = new Image().src = "misc/atoms/70_40.png"
var img70_50 = new Image().src = "misc/atoms/70_50.png"
var img70_60 = new Image().src = "misc/atoms/70_60.png"
var img80_30 = new Image().src = "misc/atoms/80_30.png"
var img80_40 = new Image().src = "misc/atoms/80_40.png"
var img80_50 = new Image().src = "misc/atoms/80_50.png"
var img80_60 = new Image().src = "misc/atoms/80_60.png"
var img90_30 = new Image().src = "misc/atoms/90_30.png"
var img90_40 = new Image().src = "misc/atoms/90_40.png"
var img90_50 = new Image().src = "misc/atoms/90_50.png"
var img90_60 = new Image().src = "misc/atoms/90_60.png"
var img100_30 = new Image().src = "misc/atoms/100_30.png"
var img100_40 = new Image().src = "misc/atoms/100_40.png"
var img100_50 = new Image().src = "misc/atoms/100_50.png"
var img100_60 = new Image().src = "misc/atoms/100_60.png"

function setImageThermometer(imageSelect) {
 theImageIndex = imageSelect.options[imageSelect.selectedIndex].value;
 if (document.images)
     document.images[1].src = eval("img" + theImageIndex);
  }

function setImageDensity(imageSelect) {
 theImageIndex = imageSelect.options[imageSelect.selectedIndex].value;
 if (document.images)
     document.images[0].src = eval("img" + theImageIndex);
  }
</SCRIPT>
  </head>
  <body>

    <?php
      include("header.html");
    ?>

    <div>
    <?php
      if ( isset($_POST['randint']) ) { $randint = $_POST["randint"]; }
      if ( empty($randint) ) {
          $randint = rand(0,1000);
          shell_exec("rm -rf temp/" . $randint);
          shell_exec("mkdir -p ./temp/$randint");
          echo "Current session ID: $randint";
        }
      else {
          echo "Current session ID: $randint";
        }
    ?>
    </div>

    <div style="display:inline-block;padding:2pt;border-style:solid;border-width:1px;width:680px;text-align:left">
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="randint" value="<?php echo $randint; ?>" />
      We are going to do a molecular dynamics (MD) simulation of a system of interacting Ar atoms. Our
      model for the interaction is the Lennard-Jones potential. You can change the density and temperature
      of the simulation. It will run remotely on a virtual machine using the code that is available on the Github
      repository of this course. The code will run 100000 time steps of 5fs each, and will compute the
      average pressure during the second half of the simulation. From there, it will estimate the B<sub>2</sub>(T)
      coefficient of Ar.
      </br></br>
      <label for="name">Enter your name (max. 10 characters):</label>
        <input type="text" name="name" maxlength="10">
      </br></br>
      <label for="Rho">Choose the particle density &rho; = N/L<sup>3</sup> (more atoms = more CPU time; smaller L = more CPU time):</label>
      <select id="Rho" name="Rho" onChange="setImageDensity(this)">
        <option value="50_60">N = 50 at; L = 6 nm; &rho; = 0.23 at/nm^3</option>
        <option value="60_60">N = 60 at; L = 6 nm; &rho; = 0.28 at/nm^3</option>
        <option value="70_60">N = 70 at; L = 6 nm; &rho; = 0.32 at/nm^3</option>
        <option value="80_60">N = 80 at; L = 6 nm; &rho; = 0.37 at/nm^3</option>
        <option value="50_50">N = 50 at; L = 5 nm; &rho; = 0.4 at/nm^3</option>
        <option value="90_60">N = 90 at; L = 6 nm; &rho; = 0.42 at/nm^3</option>
        <option value="100_60">N = 100 at; L = 6 nm; &rho; = 0.46 at/nm^3</option>
        <option value="60_50">N = 60 at; L = 5 nm; &rho; = 0.48 at/nm^3</option>
        <option value="70_50">N = 70 at; L = 5 nm; &rho; = 0.56 at/nm^3</option>
        <option value="80_50">N = 80 at; L = 5 nm; &rho; = 0.64 at/nm^3</option>
        <option value="90_50">N = 90 at; L = 5 nm; &rho; = 0.72 at/nm^3</option>
        <option value="50_40">N = 50 at; L = 4 nm; &rho; = 0.78 at/nm^3</option>
        <option value="100_50">N = 100 at; L = 5 nm; &rho; = 0.8 at/nm^3</option>
        <option value="60_40">N = 60 at; L = 4 nm; &rho; = 0.94 at/nm^3</option>
        <option value="70_40">N = 70 at; L = 4 nm; &rho; = 1.09 at/nm^3</option>
        <option value="80_40">N = 80 at; L = 4 nm; &rho; = 1.25 at/nm^3</option>
        <option value="90_40">N = 90 at; L = 4 nm; &rho; = 1.41 at/nm^3</option>
        <option value="100_40">N = 100 at; L = 4 nm; &rho; = 1.56 at/nm^3</option>
        <option value="50_30">N = 50 at; L = 3 nm; &rho; = 1.85 at/nm^3</option>
        <option value="60_30">N = 60 at; L = 3 nm; &rho; = 2.22 at/nm^3</option>
        <option value="70_30">N = 70 at; L = 3 nm; &rho; = 2.59 at/nm^3</option>
        <option value="80_30">N = 80 at; L = 3 nm; &rho; = 2.96 at/nm^3</option>
        <option value="90_30">N = 90 at; L = 3 nm; &rho; = 3.33 at/nm^3</option>
        <option value="100_30">N = 100 at; L = 3 nm; &rho; = 3.70 at/nm^3</option>
      </select>
<!--
      <label for="Np">Choose the number of atoms (larger = more CPU time):</label>
      <select id="Np" name="Np">
        <option value="50">50</option>
        <option value="60">60</option>
        <option value="70">70</option>
        <option value="80">80</option>
        <option value="90">90</option>
        <option value="100">100</option>
      </select>
      </br></br>
      <label for="L">Choose the simulation box side length (smaller = more CPU time):</label>
      <select id="L" name="L">
        <option value="30">30 Angst.</option>
        <option value="40">40 Angst.</option>
        <option value="50">50 Angst.</option>
        <option value="60">60 Angst.</option>
      </select>
--!>
      </br></br>
      <label for="T">Choose the temperature (negligible effect on CPU time):</label>
      <select id="T" name="T" onChange="setImageThermometer(this)">
        <option value="80">80 K</option>
        <option value="90">90 K</option>
        <option value="100">100 K</option>
        <option value="110">110 K</option>
        <option value="120">120 K</option>
        <option value="130">130 K</option>
      </select>
      </br></br>
      <input type="submit" value="Compute B2(T) coefficient of Ar">
    </form>
    </div>

    <div>
    <p>
    <form action="index.php">
      <input type="submit" value="Start over" />
    </form>
    </p>
    </div>


<img src="misc/atoms/50_60.png" width="500" height="500"/>
<img src="misc/thermometer/80.png" width="65" height="482"/>

  </body>
</html>
