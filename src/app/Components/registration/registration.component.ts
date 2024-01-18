import { Component, OnInit } from '@angular/core';
import { UserService } from 'src/app/Services/user.service';
import { SharedService } from 'src/app/Services/component-share.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-registration',
  templateUrl: './registration.component.html',
  styleUrls: ['./registration.component.scss']
})
export class RegistrationComponent implements OnInit {
  user: any = {};
  selectedComponent: string = '';
  registrationSuccess: boolean = false;
  registrationError: boolean = false;

  constructor(
    private userService: UserService,
    private sharedService: SharedService,
    private router: Router
  ) { }

  ngOnInit() {
    this.sharedService.selectedComponent$.subscribe(component => {
      this.selectedComponent = component;
    });
  }

  registerUser(): void {
    this.userService.createUser(this.user).subscribe(
      response => {
        console.log('Użytkownik został pomyślnie utworzony', response);
        this.registrationSuccess = true;
        this.registrationError = false;
        
        // Przekierowanie do głównej strony po pomyślnym utworzeniu użytkownika
        setTimeout(() => {
          this.router.navigate(['/MainGrid']);
        }, 10);
      },
      error => {
        console.error('Błąd podczas tworzenia użytkownika', error);
        this.registrationSuccess = false;
        this.registrationError = true;
      }
    );
  }
}
