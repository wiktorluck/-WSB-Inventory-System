import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { SharedService } from 'src/app/Services/component-share.service';
import { UserService } from './Services/user.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {
  public selectedComponent: string = "app-main-page-grid";

  constructor(private sharedService: SharedService, private userService: UserService, private router: Router) {}

  ngOnInit() {
    console.log('ngOnInit called');
    this.sharedService.selectedComponent$.subscribe(component => {
      this.selectedComponent = component;
    });
  }

  changeComponent(componentName: string) {
    this.sharedService.changeSelectedComponent(componentName);
  }

  get isLoggedIn(): boolean {
    return this.userService.isLoggedIn;
  }

  logout() {
    this.userService.logout();
    // Dodaj przekierowanie po wylogowaniu, np. na stronę logowania
    this.router.navigate(['/login']);
  }
}
