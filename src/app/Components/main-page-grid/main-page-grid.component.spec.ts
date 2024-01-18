import { ComponentFixture, TestBed } from '@angular/core/testing';

import { MainPageGridComponent } from './main-page-grid.component';

describe('MainPageGridComponent', () => {
  let component: MainPageGridComponent;
  let fixture: ComponentFixture<MainPageGridComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [MainPageGridComponent]
    });
    fixture = TestBed.createComponent(MainPageGridComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
