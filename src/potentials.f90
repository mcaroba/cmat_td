! Copyright (c) 2022 Miguel A. Caro

module potentials

  implicit none

  contains

!**********************************************************************************************
! This subroutine returns the distance between ri and rj under
! certain boundary conditions
  subroutine get_distance(posi, posj, L, PBC, dist, d)

    implicit none

    real*8, intent(in) :: posi(1:3), posj(1:3), L(1:3)
    logical, intent(in) :: PBC(1:3)
    real*8, intent(out) :: d
    real*8, intent(out) :: dist(1:3)
    real*8 :: d2
    integer :: i

    d2 = 0.d0
    do i = 1, 3
      if( PBC(i) )then
        dist(i) = modulo(posj(i) - posi(i), L(i))
        if( dist(i) > L(i)/2.d0 )then
          dist(i) = dist(i) - L(i)
        end if
      else
        dist(i) = posj(i) - posi(i)
      end if
      d2 = d2 + dist(i)**2
    end do
    d = dsqrt(d2)

  end subroutine get_distance
!**********************************************************************************************








!**********************************************************************************************
! This subroutine returns the interaction energy between two particles according to the
! Lennard-Jones potential
  subroutine lj_potential(posi, posj, sigmai, sigmaj, epsiloni, epsilonj, &
                          Rcut, L, PBC, dist_out, Epot, fi)

    implicit none

    real*8, intent(in) :: posi(1:3), posj(1:3), sigmai, sigmaj, &
                          epsiloni, epsilonj, L(1:3), Rcut
    logical, intent(in) :: PBC(1:3)
    real*8, intent(out) :: Epot, fi(1:3), dist_out(1:3)
    real*8 :: d, epsilon, sigma, pi, dist(1:3), E0

    pi = dacos(-1.d0)

    sigma = 0.5d0 * (sigmai + sigmaj)
    epsilon = dsqrt(epsiloni*epsilonj)

    E0 = 4.d0*epsilon * ( (sigma/Rcut)**12 - (sigma/Rcut)**6 )
    
    call get_distance(posi, posj, L, PBC, dist, d)
    dist_out = dist

    if( d < Rcut )then
      Epot = 4.d0*epsilon * ( (sigma/d)**12 - (sigma/d)**6 ) - E0
!     The force on i is calculated assuming the convention that dist(1) = xj - xi
      fi(1:3) = 4.d0*epsilon/d**2 * (-12.d0*(sigma/d)**12 + &
                6.d0*(sigma/d)**6) * dist(1:3)
    else
!     There is no discontinuity of the potential at Rcut, but there
!     is a discontinuity of the force
      Epot = 0.d0
      fi(1:3) = 0.d0
    end if

  end subroutine lj_potential
!**********************************************************************************************



end module
