import { Component, OnInit, ViewChild } from '@angular/core';
import { IonModal, IonRouterOutlet } from '@ionic/angular';
import { format, parseISO } from 'date-fns';
import { CalendarComponent, CalendarMode } from 'ionic2-calendar';
import { CalEvent, EventsService } from 'src/app/services/events.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-cal',
  templateUrl: './cal.page.html',
  styleUrls: ['./cal.page.scss'],
})
export class CalPage implements OnInit {
  eventSource: CalEvent[] = [];
  eventsLoaded: any[] = [];
  calendar = {
    mode: 'month' as CalendarMode,
    currentDate: new Date(),
    date: new Date(),
    startHour: 8,
    endHour: 20,
  };

  viewTitle = '';
  @ViewChild(CalendarComponent) myCal!: CalendarComponent;
  @ViewChild('modal') modal!: IonModal;
  presentingElement: any = null;

  newEvent: any = {
    title: '',
    allDay: false,
    startTime: null,
    endTime: null,
    description: '',
  };

  showStart = false;
  showEnd = false;
  formattedStart = '';
  formattedEnd = '';
  constructor(
    private ionRouterOutlet: IonRouterOutlet,
    private eventsService: EventsService,
    private router: Router
  ) {
    this.presentingElement = ionRouterOutlet.nativeEl;
  }

  ngOnInit() {
    this.loadEvents();
  }

  async loadEvents() {
    await this.eventsService.getData().then((events) => {
      console.log('events: ', events);
      this.eventSource = events;
    });
    this.myCal.loadEvents();
  }

  combineDateTime(dateStr: string, timeStr: string): Date {
    const time = timeStr.split(':').map(Number);
    const date = new Date(dateStr);
    date.setHours(time[0], time[1]);
    return date;
  }

  formatDate(date: Date): string {
    // Implement the logic to format the date as per your requirement
    // For example, you can use Angular DatePipe to format the date
    return date.toISOString(); // Replace this with your desired date format
  }
  setToday() {
    this.calendar.currentDate = new Date();
    this.myCal.currentDate = new Date();
    this.myCal.loadEvents();
  }

  calendarBack() {
    this.myCal.slidePrev();
  }
  calendarNext() {
    this.myCal.slideNext();
  }

  startChanged(value: any) {
    this.newEvent.startTime = value;
    this.formattedStart = format(parseISO(value), 'HH:mm, MMM d, yyyy');
  }

  endChanged(value: any) {
    this.newEvent.endTime = value;
    this.formattedEnd = format(parseISO(value), 'HH:mm, MMM d, yyyy');
  }

  dismissModal() {
    this.formattedStart = '';
    this.formattedEnd = '';
    this.newEvent.startTime = null;
    this.newEvent.endTime = null;
    this.modal.dismiss();
  }
  onEventSelected(event: any) {
    //this needs to navigate to event, need to work on this.
    console.log('Event selected: ', event.id);
    this.router.navigate(['/tabs/calendar-event', event.id]);
  }
  onTimeSelected(ev: { selectedTime: Date; events: any[] }) {
    this.formattedStart = format(ev.selectedTime, 'HH:mm, MMM d, yyyy');
    this.newEvent.startTime = format(ev.selectedTime, "yyyy-MM-dd'T'HH:mm:ss");

    const later = ev.selectedTime.setHours(ev.selectedTime.getHours() + 1);
    this.formattedEnd = format(later, 'HH:mm, MMM d, yyyy');
    this.newEvent.endTime = format(later, "yyyy-MM-dd'T'HH:mm:ss");

    if (this.calendar.mode === 'day' || this.calendar.mode === 'week') {
      this.modal.present();
    }
  }

  scheduleEvent() {
    const dateStr = new Date(this.newEvent.startTime)
      .toISOString()
      .split('T')[0];

    const startTime = new Date(this.newEvent.startTime);

    const endTime = new Date(this.newEvent.endTime);

    const toAdd: CalEvent = {
      id: new Date().getTime().toString(),
      date: dateStr,
      title: this.newEvent.title,
      startTime: startTime,
      endTime: endTime,
      allDay: this.newEvent.allDay,
      content: this.newEvent.description,
    };

    console.log(toAdd);

    this.eventSource.push(toAdd);
    this.myCal.loadEvents();
    this.eventsService.addData(toAdd);

    this.newEvent = {
      title: '',
      date: '',
      allDay: false,
      startTime: null,
      endTime: null,
      content: '',
    };

    this.modal.dismiss();
  }
}
