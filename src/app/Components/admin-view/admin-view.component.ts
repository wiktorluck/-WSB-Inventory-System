import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { RestaurantService } from 'src/app/Services/restaurant-service.service';

interface RestaurantData {
  id: number;
  newName: string;
  newAdress: string;
}

@Component({
  selector: 'app-admin-view',
  templateUrl: './admin-view.component.html',
  styleUrls: ['./admin-view.component.scss']
})
export class AdminViewComponent {
  restaurants: any[] = [];
  editingRestaurant: any = null;
  editRestaurantForm!: FormGroup;

  constructor(private restaurantService: RestaurantService, private formBuilder: FormBuilder) {}

  ngOnInit() {
    this.restaurantService.getAllItems().subscribe(data => {
      this.restaurants = data;
    });

    this.editRestaurantForm = this.formBuilder.group({
      newName: ['', Validators.required],
      newAdress: ['', Validators.required]
    });
  }

  editRestaurant(restaurant: any): void {
    this.editingRestaurant = restaurant;
    this.editRestaurantForm.patchValue({
      newName: restaurant.RestaurantName,
      newAdress: restaurant.Adress
    });
  }

  deleteRestaurant(restaurantId: number): void {
    if (confirm('Czy na pewno chcesz usunąć tę restaurację?')) {
      this.restaurantService.deleteRestaurant(restaurantId).subscribe(
        response => {
          console.log('Restauracja została pomyślnie usunięta', response);
          this.restaurantService.getAllItems().subscribe(data => {
            this.restaurants = data;
          });
        },
        error => {
          console.error('Błąd podczas usuwania restauracji', error);
        }
      );
    }
  }

  saveChanges(): void {
    if (this.editRestaurantForm.valid && this.editingRestaurant) {
      const restaurantId = this.editingRestaurant.ID;
      const newName = this.editRestaurantForm.value.newName;
      const newAdress = this.editRestaurantForm.value.newAdress;

      const data: RestaurantData = { id: restaurantId, newName, newAdress };

      console.log('Dane do wysłania:', data);

      this.restaurantService.editRestaurant(data).subscribe(
        response => {
          console.log('Restauracja została pomyślnie zaktualizowana', response);
          this.restaurantService.getAllItems().subscribe(data => {
            this.restaurants = data;
          });
          this.editingRestaurant = null;
          this.editRestaurantForm.reset();
        },
        error => {
          console.error('Błąd podczas aktualizacji restauracji', error);
        }
      );
    }
  }
}
