import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { UserService } from 'src/app/Services/user.service';
import { UserModel } from 'src/app/Models/user.model';
import { SharedService } from 'src/app/Services/component-share.service';
import { Router } from '@angular/router';
import { HttpErrorResponse } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  loginForm!: FormGroup;
  user: UserModel = {
    name: '',
    surname: '',
    email: '',
    password: '',
    isAdmin: false
  };
  selectedComponent: string = '';
  loginError: boolean = false;

  constructor(
    private userService: UserService,
    private sharedService: SharedService,
    private formBuilder: FormBuilder,
    private router: Router
  ) { }

  ngOnInit() {
    this.sharedService.selectedComponent$.subscribe(component => {
      this.selectedComponent = component;
    });

    // Inicjalizacja formularza
    this.loginForm = this.formBuilder.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required]
    });
  }

  handleError(error: HttpErrorResponse) {
    console.error('Błąd podczas żądania do serwera:', error);

    if (error.error instanceof ErrorEvent) {
      console.error('Błąd zdarzenia:', error.error.message);
    } else {
      console.error(
        `Serwer zwrócił kod ${error.status}, ` +
        `body: ${JSON.stringify(error.error)}`
      );
    }

    return throwError('Coś poszło nie tak; spróbuj ponownie później.');
  }

  NavigateToRegistration() {
    this.router.navigate(['/registration']); 
  }

  loginUser(): void {
    if (this.loginForm.valid) {
      this.user = { ...this.loginForm.value };

      this.userService.loginUser(this.user.email, this.user.password).subscribe(
        response => {
          console.log('Odpowiedź od serwera:', response);

          if (this.userService.checkIsAdmin(this.user.isAdmin)) {
            console.log('Weszło Login Component');
            this.router.navigate(['/Admin']);
          } else {
            this.router.navigate(['/MainGrid']);
          }

          this.loginForm.reset();
          this.loginError = false;
        },
        error => {
          console.error('Błąd podczas logowania', error);

          this.loginError = true;
        }
      );
    }
  }
}
