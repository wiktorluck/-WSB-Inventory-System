import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ReservationService {
  private apiUrl = 'http://localhost:8080/phpapi/ReservationControllers/'; 

  constructor(private http: HttpClient) {}

  saveReservation(reservationData: any): Observable<any> {
    return this.http.post(`${this.apiUrl}CreateReservationController.php`, reservationData);
  }
}
