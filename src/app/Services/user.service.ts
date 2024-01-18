import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpErrorResponse } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError, tap } from 'rxjs/operators';
import { UserModel } from '../Models/user.model';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  private apiUrlRegister = 'http://localhost:8080/phpapi/UserControllers/RegistryController.php';
  private apiUrlLogin = 'http://localhost:8080/phpapi/UserControllers/LoginController.php';

  isLoggedIn: boolean = false;
  isAdmin: boolean = false;

  constructor(
    private http: HttpClient,
    private router: Router
  ) { }

  createUser(user: UserModel): Observable<any> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });

    return this.http.post<any>(this.apiUrlRegister, user, { headers })
      .pipe(
        catchError(this.handleError)
      );
  }

  loginUser(email: string, password: string): Observable<any> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    const user = { email, password };

    return this.http.post<any>(this.apiUrlLogin, user, { headers })
      .pipe(
        tap(response => {
          this.isLoggedIn = true;
          this.isAdmin = this.checkIsAdmin(response);

          // Ustaw dane w LocalStorage
          localStorage.setItem('userId', response.user.ID.toString());
          localStorage.setItem('userName', response.user.userName);
          localStorage.setItem('isAdmin', response.user.isAdmin.toString());

          if (this.isAdmin) {
            this.router.navigate(['/Admin']);
          } else {
            this.router.navigate(['/MainGrid']);
          }
        }),
        catchError(this.handleError)
      );
  }

  logout(): void {
    // Usuń dane z LocalStorage
    localStorage.removeItem('userId');
    localStorage.removeItem('userName');
    localStorage.removeItem('isAdmin');

    // Resetuj stan zalogowania i inne zmienne związane z użytkownikiem
    this.isLoggedIn = false;
    this.isAdmin = false;
    this.router.navigate(['/login']);
  }

  isUserLoggedIn(): boolean {
    // Sprawdź czy dane w LocalStorage istnieją
    return !!localStorage.getItem('userId');
  }

  checkIsAdmin(response: any): boolean {
    return response.user && response.user.isAdmin === 1 || false;
  }

  private handleError(error: HttpErrorResponse) {
    if (error.error instanceof ErrorEvent) {
      console.error('Wystąpił błąd:', error.error.message);
    } else {
      console.error(
        `Serwer zwrócił kod ${error.status || 'nieznany'}, ` +
        `ciało odpowiedzi: ${JSON.stringify(error.error)}`);
    }
    return throwError('Coś poszło nie tak; spróbuj ponownie później.');
  }
}
