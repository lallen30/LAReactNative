import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { CalendarEventPageRoutingModule } from './calendar-event-routing.module';

import { CalendarEventPage } from './calendar-event.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    CalendarEventPageRoutingModule
  ],
  declarations: [CalendarEventPage]
})
export class CalendarEventPageModule {}
