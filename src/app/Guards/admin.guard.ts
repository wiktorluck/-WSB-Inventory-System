

import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { UserService } from '../Services/user.service';

@Injectable({
  providedIn: 'root'
})
export class AdminGuard implements CanActivate {

  constructor(private userService: UserService, private router: Router) { }

  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): boolean {
    
    // Sprawdzanie, czy użytkownik jest administratorem
    if (this.userService.isAdmin) {
      return true; // Pozwól na dostęp, jeśli użytkownik jest administratorem
    } else {
      // Przekieruj użytkownika na stronę logowania, jeśli nie jest administratorem
      this.router.navigate(['/MainGrid']);
      return false;
    }
  }
  
}
