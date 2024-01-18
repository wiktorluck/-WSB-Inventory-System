import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomePageComponent } from './Pages/home-page/home-page.component';
import { MainPageGridComponent } from './Components/main-page-grid/main-page-grid.component';
import { AboutUsComponent } from './Components/about-us/about-us.component';
import { LoginComponent } from './Components/login/login.component';
import { AdminGuard } from './Guards/admin.guard';
import { AdminViewComponent } from './Components/admin-view/admin-view.component';
import { ReservationComponent } from './Components/reservation/reservation.component';
import { RegistrationComponent } from './Components/registration/registration.component';

const routes: Routes = [
  {path: 'HomePage', component:HomePageComponent},
  { path: 'MainGrid', component: MainPageGridComponent},
  { path: 'AboutUs', component: AboutUsComponent},
  {path: 'Admin', component: AdminViewComponent, canActivate: [AdminGuard] },
  {path: 'login', component: LoginComponent},
  {path: 'registration', component:RegistrationComponent},
  {path :'reservation', component:ReservationComponent},
  { path: '', component: HomePageComponent, pathMatch: 'full' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }