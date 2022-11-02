cat>$1/gnuplot.script<<eof
set term pngcairo size 640,480 enhanced
set output "$1/plot.png"

set xlabel "T (K)"
set ylabel "-B_2(T) (cm^3/mol)"

set cbrange [0.2:3.8]
#set cblabel "Particle density (at/nm^3)"

unset colorbox

plot "NVTP.dat" u 3:(-(column(4)-8.617e-5*column(1)/column(2)*column(3))/8.617e-5/(column(1)/column(2))**2/column(3) * 1.e-24 * 6.022e23):(column(1)/column(2)*1000.) not pt 7 lw 4 lc palette, \
     "NVTP.dat" u 3:(-(column(4)-8.617e-5*column(1)/column(2)*column(3))/8.617e-5/(column(1)/column(2))**2/column(3) * 1.e-24 * 6.022e23) t "Calculated (MD)" pt 6 lw 2 lc -1, \
     "optim.dat" u 1:2 w lp t "Experimental" lw 4 lc 2, \
     "NVTP.dat" u 3:(-(column(4)-8.617e-5*column(1)/column(2)*column(3))/8.617e-5/(column(1)/column(2))**2/column(3) * 1.e-24 * 6.022e23):(sprintf("%s", " ".stringcolumn(5))) w labels left not
eof

L=$2

cat>$1/vmd.script<<eof
mol load xyz $1/trj.xyz
package require pbctools
#display resize 500 500
color Display Background white
axes location off
set result [ expr 0.95*($L/60.) ]
pbc box
pbc set {$L $L $L} -all
pbc wrap -all
scale by \$result
mol addrep 0
mol modstyle 0 0 VDW 0.5 50
render TachyonInternal $1/bas.tga
set frame 0
for {set i 0} {\$i < 50} {incr i 1} {
    set filename snap.[format "%04d" \$frame].tga
    animate goto \$i
    render TachyonInternal $1/\$filename
    incr frame
}
exit
eof
