for Np in 50 60 70 80 90 100; do
for L in 30 40 50 60; do

echo $Np $L 80. 1000 | bin/lj

python3 xyz_to_pbd.py

cat>vmd.script<<eof
mol load pdb atoms.pdb

package require pbctools

display resize 500 500
color Display Background white
axes location off
#display projection orthographic
#display depthcue off
set result [ expr 0.95*($L/60.) ]
pbc box
pbc wrap -all
scale by \$result

mol addrep 0
mol modstyle 0 0 VDW 0.5 50
#mol modstyle 1 0 DynamicBonds 1.9 0.1 50

render TachyonInternal atoms.tga

exit
eof

/home/caro/apps/vmd/vmd_1.9.3/bin/vmd -e vmd.script > /dev/null

/usr/bin/convert atoms.tga -trim atoms0.png
/usr/bin/convert canvas.png -gravity SouthWest atoms0.png -geometry +0+0 -composite atoms.png

mv atoms.png misc/atoms/${Np}_${L}.png

done
done
