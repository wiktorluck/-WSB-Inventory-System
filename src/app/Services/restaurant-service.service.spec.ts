import { TestBed } from '@angular/core/testing';

import { RestauratnService } from './restaurant-service.service';

describe('RestaurantServiceService', () => {
  let service: RestauratnService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(RestauratnService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
