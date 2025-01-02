import { Injectable } from '@angular/core';
import {
  AlertController,
  LoadingController,
  ToastController,
} from '@ionic/angular';

@Injectable({
  providedIn: 'root',
})
export class CommonService {
  loading: any;

  constructor(
    public loadingCtrl: LoadingController,
    public toastController: ToastController,
    public alertCtrl: AlertController
  ) {}

  async showLoader(msg) {
    this.loading = await this.loadingCtrl.create({
      message: msg,
      cssClass: 'custom-load',
    });
    this.loading.present();
  }

  async dismissLoading() {
    await this.loading.dismiss();
  }

  async presentToast(msg) {
    const toast = await this.toastController.create({
      message: msg,
      duration: 2000,
      position: 'bottom',
    });
    toast.present();
  }

  async presentAlert(msg, heading = 'Alert') {
    let alert = await this.alertCtrl.create({
      header: heading,
      message: msg,
      buttons: [
        {
          text: 'OK',
          handler: () => {},
        },
      ],
    });
    await alert.present();
  }
}
