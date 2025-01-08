import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { LoadingController, ToastController } from '@ionic/angular';
import { NavController } from '@ionic/angular';
import { StorageService } from 'src/app/services/storage.service';

import { from, Observable } from 'rxjs';
import { switchMap } from 'rxjs/operators';

import { environment } from '../../environments/environment';

import { DomSanitizer, SafeHtml } from '@angular/platform-browser';

let Url = `https://${environment.server}/`;

const mainUrl = `${Url}api/`;
let apiV1 = `${Url}api/`;
let authurl = `${Url}wp-json/jwt-auth/v1/`;
let mobileAPI = `${Url}wp-json/mobileapi/v1/`;


@Injectable({
  providedIn: 'root',
})
export class ApiService {
  loading: any;
  ai_token: any;
  apiUrl: any;
  intro_message: any;

  constructor(
    public navCtrl: NavController,
    private http: HttpClient,
    public loadingCtrl: LoadingController,
    public storage: StorageService,
    private toastCtrl: ToastController,
    private sanitizer: DomSanitizer
  ) {
    this.assignToStorage();
  }

  assignToStorage() {
    this.storage.get('therapy_ai_credentials').then((res: any) => {

      // this.apiKey = res.ai_api_key;
      this.ai_token = res.ai_token;
      this.apiUrl = res.ai_api_url;
      this.intro_message = res.intro_message;

    }).catch((error: any) => {
      console.log(error);
    })
  }

  async dismissLoading() {
    console.log(this.loading);
    if (this.loading) {
      await this.loading.dismiss();
    }
  }

  async showLoader(msg: string = '') {
    if (msg === '') {
      msg = 'Please wait...';
    }
    this.loading = await this.loadingCtrl.create({ message: msg });
    await this.loading.present();
  }

  async successToast(msg) {
    const toast = await this.toastCtrl.create({
      message: msg,
      color: 'success',
      duration: 3000,
      position: 'bottom',
    });
    toast.present();
  }

  async errorToast(msg) {
    const toast = await this.toastCtrl.create({
      message: msg,
      color: 'danger',
      duration: 3000,
      position: 'bottom',
    });
    toast.present();
  }

  getData(endPoint) {
    return this.http.get(mobileAPI + endPoint).pipe(map((data) => data));
  }

  sendData(endPoint, data) {
    let timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

    // Ensure data is an object
    let payload = typeof data === 'object' ? data : { value: data };
    payload.timezone = timezone;

    return this.http.post(mobileAPI + endPoint, payload).pipe(map((result) => result));
  }


  setToken(token) {
    this.storage.set('token', token);
    localStorage.setItem('tokenTest', token);
  }

  async getToken() {
    let token = await this.storage.get('token');
    console.log('getToken token test:', JSON.stringify(token));
    const tokenNull = '{"__zone_symbol__state":null,"__zone_symbol__value":[]}'

    if (JSON.stringify(token) === tokenNull) {
      console.log('getToken token: ', JSON.stringify(token));
      return null;
    } else {
      return JSON.stringify(token);
    }
  }


  setAiApiUrl(ai_api_url) {
    this.storage.set('ai_api_url', ai_api_url);
    // localStorage.setItem('ai_api_urlTest', ai_api_url);
  }

  async getAiApiUrl(): Promise<string> {
    let ai_api_url = await this.storage.get('ai_api_url');
    if (ai_api_url) {
      return ai_api_url;
    } else {
      return null;
    }
  }


  mainUrl() {
    return mainUrl;
  }

  getStorageUrl(relUrl: string): string {
    //console.log('in ApiService.getStorageUrl with', relUrl);
    if (relUrl === null || relUrl === undefined) {
      return relUrl;
    }
    return mainUrl + "/storage/" + relUrl;
  }

  doReset(email) {
    return this.http
      .post(apiV1 + 'forgotPassword', {
        email: email,
      })
      .pipe(
        map((user) => {
          return user;
        })
      );
  }

  sanitizeContent(content: string): SafeHtml {
    let safeContent: SafeHtml;
    let modifiedContent = content.replace(/<img /g, '<img style="max-width: 100%; height: auto;" ');
    safeContent = this.sanitizer.bypassSecurityTrustHtml(modifiedContent);
    return safeContent;
  }


  postQuestionToQnA(questionPayload: { question: string }): Observable<any> {
    // Convert the Promise returned by getAiApiUrl to an Observable
    return from(this.getAiApiUrl()).pipe(
      switchMap(aiApiUrl => {
        if (aiApiUrl) {
          // If we have a URL, proceed with the request
          return this.http.post<any>(`${aiApiUrl}/qna`, questionPayload);
        } else {
          // Handle the case where no URL is returned
          // This could involve throwing an error or returning a default value
          throw new Error('AI API URL not found');
        }
      })
    );
  }




  endChat(endPoint: any, token: any) {
    return this.http.post(this.apiUrl + endPoint, token)
  }


  checkUserSession(endPoint: any, data: any) {
    return this.http.post(this.apiUrl + endPoint, data)
  }

  get_ai_credentials(endPoint: any) {
    return this.http.get(this.apiUrl + endPoint)
  }


  chatGptApi(message: any, subcat: any = 'health,health disease and medication') {

    const headers = new HttpHeaders({
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${this.ai_token}`
    });

    let body = {
      "question": message
    };

    return this.http.post(this.apiUrl + '/qna', body, { headers: headers })
  }

}