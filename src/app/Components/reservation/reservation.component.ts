import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { ReservationService } from 'src/app/Services/reservation.service';


@Component({
  selector: 'app-reservation',
  templateUrl: './reservation.component.html',
  styleUrls: ['./reservation.component.scss']
})
export class ReservationComponent implements OnInit {
  reservationForm!: FormGroup;

  constructor(
    private route: ActivatedRoute,
    private formBuilder: FormBuilder,
    private reservationService: ReservationService
  ) {}

  ngOnInit() {
    this.route.queryParams.subscribe(params => {
      const userId = params['userId'];
      const restaurantId = params['restaurantId'];

      this.reservationForm = this.formBuilder.group({
        reservation_date: ['', Validators.required],
        reservation_time_from: ['', Validators.required],
        reservation_time_to: ['', Validators.required],
        guests_count: ['', Validators.required],
        full_name: ['', Validators.required],
        user_id: [userId, Validators.required],
        restaurant_id: [restaurantId, Validators.required]
      });
    });
  }

  onSubmit() {
    const formData = this.reservationForm.value;

    // Wywołanie metody zapisywania rezerwacji z użyciem serwisu
    this.reservationService.saveReservation(formData).subscribe(
      response => {
        console.log(response); // Obsługa odpowiedzi z serwera
      },
      error => {
        console.error(error); // Obsługa błędów
      }
    );
  }
}
