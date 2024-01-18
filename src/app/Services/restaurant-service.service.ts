import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class RestaurantService {
  private apiUrl = 'http://localhost:8080/phpapi/RestaruantsControllers';
  private selectedRestaurantId: number | null = null;

  constructor(private http: HttpClient) {}

  getAllItems(): Observable<any[]> {
    return this.http.get<any[]>(`${this.apiUrl}/AllRestaurantController.php`).pipe(
      catchError(this.handleError)
    );
  }

  getRestaurantById(restaurantId: number): Observable<any> {
    if (!restaurantId) {
      throw new Error('Nieprawidłowe ID restauracji');
    }

    return this.http.get<any>(`${this.apiUrl}/SingleRestaurantController.php?id=${restaurantId}`);
  }

  deleteRestaurant(restaurantId: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/DeleteRestaurantController.php?id=${restaurantId}`).pipe(
      catchError(this.handleError)
    );
  }

  editRestaurant(data: { id: number; newName: string, newAdress: string}): Observable<any> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/x-www-form-urlencoded' });

    const body = new HttpParams()
      .set('id', data.id.toString())
      .set('newName', data.newName)
      .set('newAdress', data.newAdress);

    return this.http.post<any>(`${this.apiUrl}/EditRestaurantController.php`, body.toString(), { headers, responseType: 'text' as 'json' }).pipe(
      catchError(this.handleError)
    );
  }
  

  setSelectedRestaurantId(restaurantId: number): void {
    this.selectedRestaurantId = restaurantId;
  }

  getSelectedRestaurantId(): number | null {
    return this.selectedRestaurantId;
  }

  private handleError(error: any) {
    console.error('Wystąpił błąd:', error);
    return throwError('Coś poszło nie tak; spróbuj ponownie później.');
  }
}
