// restaurant-detail.component.ts
import { Component, OnInit } from '@angular/core';
import { RestaurantService } from 'src/app/Services/restaurant-service.service';

@Component({
  selector: 'app-restaurant-detail',
  templateUrl: './restaurant-detail.component.html',
  styleUrls: ['./restaurant-detail.component.scss']
})
export class RestaurantDetailComponent implements OnInit {
  selectedRestaurantId: number | null = null;
  restaurantDetails: any; 

  constructor(private RestaurantService: RestaurantService) {}

  ngOnInit() {
    // Pobranie ID wybranej restauracji z serwisu
    this.selectedRestaurantId = this.RestaurantService.getSelectedRestaurantId();

    if (this.selectedRestaurantId) {
      // Pobranie szczegółów restauracji na podstawie ID
      this.RestaurantService.getRestaurantById(this.selectedRestaurantId).subscribe(data => {
        this.restaurantDetails = data;
      });
    }
  }
}
