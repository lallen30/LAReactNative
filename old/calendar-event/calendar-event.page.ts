import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { NavigationService } from 'src/app/services/navigation.service';
import { StorageService } from 'src/app/services/storage.service';
import { format, parseISO } from 'date-fns';

@Component({
  selector: 'app-calendar-event',
  templateUrl: './calendar-event.page.html',
  styleUrls: ['./calendar-event.page.scss'],
})
export class CalendarEventPage implements OnInit {
  item: any;
  calendarData: any;
  calendarEventId: any;
  eventTitle: any = '';
  eventDate: any = '';
  startTime: any = '';
  endTime: any = '';
  eventContent: any = '';
  eventStreetAddress: any = '';
  eventAptSuite: any = '';
  eventCity: any = '';
  eventState: any = '';
  eventZip: any = '';
  eventLongitude: any = '';
  eventLatitude: any = '';
  eventPrice: any = '';

  constructor(
    public storage: StorageService,
    private navService: NavigationService,
    private router: Router,
    private route: ActivatedRoute
  ) {}

  ngOnInit() {}

  ionViewWillEnter() {
    // Get post id
    const eventId = this.route.snapshot.paramMap.get('id');
    console.log(`eventId: ${eventId}`);
    this.item = eventId;

    // Filter post content by id
    this.storage.get('calendar').then((events) => {
      events = JSON.parse(events);
      console.log(events, typeof events);
      if (events != null) {
        this.calendarData = events.find((event) => event.id == this.item);
        console.log('calendarData: ', this.calendarData);
        this.eventTitle = this.calendarData.title;
        this.eventDate = this.formatDate(this.calendarData.date);
        this.startTime = this.formatAMPM(this.calendarData.startTime);
        this.endTime = this.formatAMPM(this.calendarData.endTime);
        this.eventContent = this.calendarData.content;
        this.eventStreetAddress = this.calendarData.eventStreetAddress;
        this.eventAptSuite = this.calendarData.eventAptSuite;
        this.eventCity = this.calendarData.eventCity;
        this.eventState = this.calendarData.eventState;
        this.eventZip = this.calendarData.eventZip;
        this.eventLongitude = this.calendarData.eventLongitude;
        this.eventLatitude = this.calendarData.eventLatitude;
        this.eventPrice = this.calendarData.eventPrice;
        console.log('content: ', this.calendarData.content);
      }
    });
  }

  formatDate(value) {
    var strTime = format(new Date(value), 'MM-dd-yyyy');
    return strTime;
  }

  formatAMPM(timeStr: string): string {
    console.log(timeStr, typeof timeStr);
    let dateStr = timeStr; // create a complete date-time string
    console.log(dateStr);

    let dateObj;
    try {
      dateObj = new Date(dateStr);
      if (isNaN(dateObj.getTime())) {
        throw new Error('invalid Date');
      }
    } catch (e) {
      return 'invalid time value';
    }
    console.log(dateObj);

    const estOffset = -5; //to convert time to est if needed on UTC later

    const estDate = new Date(dateObj.getTime());

    const strTime = format(estDate, 'h:mm a');

    console.log(strTime);

    return strTime;
  }
}
