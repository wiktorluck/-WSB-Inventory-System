import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-about-us',
  templateUrl: './about-us.component.html',
  styleUrls: ['./about-us.component.scss']
})

export class AboutUsComponent {
constructor(
  private router: Router
){}

RedirectToHomePageGrid()
{
  this.router.navigate(['/MainGrid'])
}
}
