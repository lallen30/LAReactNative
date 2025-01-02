import { ComponentFixture, TestBed } from '@angular/core/testing';
import { BluestoneAiPage } from './bluestone-ai.page';

describe('BluestoneAiPage', () => {
  let component: BluestoneAiPage;
  let fixture: ComponentFixture<BluestoneAiPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(BluestoneAiPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
