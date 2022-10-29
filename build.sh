#!/bin/bash

cd src

for file in potentials.f90 integrators.f90 neighbors.f90; do
gfortran -O3 -c $file
done

mkdir -p ../bin
gfortran -O3 -o ../bin/lj lj.f90 *.o

cd ..
