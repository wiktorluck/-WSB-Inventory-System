import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { SharedService } from 'src/app/Services/component-share.service';

@Component({
  selector: 'app-home-page',
  templateUrl: './home-page.component.html',
  styleUrls: ['./home-page.component.scss']
})
export class HomePageComponent {
 public selectedComponent: string = "app-main-page-grid";
 constructor( private SharedService: SharedService) {}

 ngOnInit() {
  console.log('ngOnInit called');
  this.SharedService.selectedComponent$.subscribe(component => {
    this.selectedComponent = component;
  });
}
 

 changeComponent(componentName: string) {
  this.SharedService.changeSelectedComponent(componentName);
}

}
