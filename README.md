# Teaching demo material for the CMAT Soft Matter Tenure-track position

Copyright (c) 2022 Miguel A. Caro

This repository contains the materials prepared by Miguel Caro for the
teaching demonstration at Aalto University's Chemistry and Materials Science
Department for the Soft Matter Modeling tenure-track position.

The demosntration is about matching experiment and simulation. We will use
the example of the behavior of an Ar gas. In particular, we will compare the
second virial expansion coefficient B2(T) computed from molecular dynamics
simulations to values obtained experimentally. The model used for the simulations
is a Lennard-Jones potential parametrized from the experimental data by fitting
a theoretical expression.

This repository contains code in Fortran, notes (as PDF slides) as well as a web
interface written mostly in PHP that is meant for the students to interactively
compute individual data points to be discussed during the lecture.
The students will be provided with a URL during the lecture to this end.

You can also run the software locally. To build the Fortran code, simply
execute `./build.sh`. The web interface can be
run on an Apache server with local access to `vmd`, `gnuplot` and `convert` (from
ImageMagick). For Apache to be able to collect data from users, there must be a
file name `NVTP.dat` in the root directory of the repo writable by the Apache
user (usually `www-data`). If you want to clean up this data, just delete the
file's contents without deleting the dile itself.
