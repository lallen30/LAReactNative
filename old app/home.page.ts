import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { EventsService, CalEvent } from 'src/app/services/events.service';
import { StorageService } from 'src/app/services/storage.service';
import { ApiService } from 'src/app/services/api.service';
import { tap, catchError } from 'rxjs/operators';
import { throwError } from 'rxjs';
import { LoadingController } from '@ionic/angular';

@Component({
  selector: 'app-home',
  templateUrl: './home.page.html',
  styleUrls: ['./home.page.scss'],
})
export class HomePage implements OnInit {
  public calendarData;
  public messages;
  postsData: any;
  token: string;
  mostRecentPosts: any[] = [];
  loading: any;
  events: CalEvent[] = [];

  constructor(
    public storage: StorageService,
    private loadingController: LoadingController,
    private apiService: ApiService,
    private router: Router,
    private eventsService: EventsService
  ) {
    this.calendarData = [];
    // this.getPosts()
    this.messages = [
      {
        id: '1',
        image: 'https://ionicframework.com/docs/img/demos/avatar.svg',
        name: 'Anthony Taylor',
        message:
          'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        time: '8:36 PM',
        number: '2',
      },
      {
        id: '2',
        image: 'https://ionicframework.com/docs/img/demos/avatar.svg',
        name: 'Fernando Lopez',
        message:
          'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        time: '8:36 PM',
        number: '',
      },
      {
        id: '3',
        image: 'https://ionicframework.com/docs/img/demos/avatar.svg',
        name: 'Sarah Mitchell',
        message:
          'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        time: '8:36 PM',
        number: '2',
      },
    ];
  }

  async presentLoading() {
    this.loading = await this.loadingController.create({
      message: 'Loading...',
      duration: 2000,
    });
    await this.loading.present();

    const { role, data } = await this.loading.onDidDismiss();
  }

  async dismissLoading() {
    if (this.loading) {
      await this.loading.dismiss();
    }
  }

  async ngOnInit() {
    this.events = await this.eventsService.getData();
  }

  async ionViewWillEnter() {
    await this.presentLoading();
    await this.loadDataInSequence();
    await this.dismissLoading();
    // this.getPosts()
    // this.getPostsByCategories();
    const posts = await this.storage.get('posts');
    if (posts) {
      this.postsData = posts;
    }

    const token = await this.storage.get('token');
    if (token) {
      this.token = token;
    }

    const storedCalendarData = await this.storage.get('calendar');
    if (storedCalendarData) {
      this.updateUpcomingEvents(storedCalendarData);
    }
  }

  updateUpcomingEvents(events) {
    const currentDate = new Date();
    currentDate.setHours(0, 0, 0, 0); // Set current date time to start of the day to compare with event dates
    events = JSON.parse(events);
    // console.log('All Events:', events);
    // Filter out past events and then sort events by date
    const filteredAndSortedEvents = events
      .filter(
        (event) => new Date(event.date).getTime() >= currentDate.getTime()
      )
      .sort((a, b) => new Date(a.date).getTime() - new Date(b.date).getTime());

    // Extract the next two events
    this.calendarData = filteredAndSortedEvents.slice(0, 2);
  }

  convertToMMDDYYYY(date: string): string {
    const d = new Date(date);
    return `${String(d.getMonth() + 1).padStart(2, '0')}-${String(
      d.getDate()
    ).padStart(2, '0')}-${d.getFullYear()}`;
  }

  convertISOToStartTime(date: string): string {
    const d = new Date(date);
    const estHour = d.getHours();
    const estMinute = d.getMinutes();
    return `${estHour}:${estMinute}`;
  }

  singleCalendarEvent(id) {
    this.router.navigateByUrl(`/calendar-event/${id}`);
  }

  singlePost(id) {
    this.router.navigateByUrl(`/post/${id}`);
  }

  goToMessage(id) {
    this.router.navigateByUrl(`/message/${id}`);
  }

  async loadDataInSequence() {
    await this.loadCategories().toPromise();
    await this.getPosts();
  }

  getPosts() {
    this.storage.get('posts').then((categories) => {
      if (categories != null) {
        // Flatten all posts from all categories into a single array
        const allPosts = categories.reduce((acc, category) => {
          return acc.concat(category.posts);
        }, []);

        // Sort the posts by date (newest first)
        const sortedPosts = allPosts.sort((a, b) => {
          const dateA = new Date(a.post_date) as any as number;
          const dateB = new Date(b.post_date) as any as number;
          return dateB - dateA;
        });

        // Get the 3 most recent posts
        this.mostRecentPosts = sortedPosts.slice(0, 3);

        console.log('Most Recent Posts:', this.mostRecentPosts);
      }
    });
  }

  loadCategories() {
    return this.apiService.getData('getPostsByCategories').pipe(
      tap((res: any) => {
        this.storage.set('posts', res.categories);
        console.log('All Posts by categories: ', res);
      }),
      catchError((error) => {
        console.error(error);
        return throwError(error);
      })
    );
  }
}
