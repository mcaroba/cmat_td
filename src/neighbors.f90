! Copyright (c) 2022 Miguel A. Caro

module neighbors

use potentials

contains

!**********************************************************************************************
subroutine build_neighbors(pos, Np, L, PBC, R, nn, list)

! This routine 

  implicit none

  real*8, intent(in) :: pos(:,:), R, L(1:3)
  integer, intent(in) :: Np
  logical, intent(in) :: PBC(1:3)
  integer, intent(inout) :: list(:,:)
  integer, intent(inout) :: nn(:)
  integer :: i, j
  real*8 :: d, dist(1:3)

  nn = 0
  do i = 1, Np
    do j = i+1, Np
      call get_distance(pos(1:3, i), pos(1:3, j), L, PBC, dist, d)
      if( d < R )then
        nn(i) = nn(i) + 1
        list(nn(i), i) = j
        nn(j) = nn(j) + 1
        list(nn(j), j) = i
      end if
    end do
  end do

end subroutine
!**********************************************************************************************

end module
