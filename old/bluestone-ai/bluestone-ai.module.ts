import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { BluestoneAiPageRoutingModule } from './bluestone-ai-routing.module';

import { BluestoneAiPage } from './bluestone-ai.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ReactiveFormsModule,
    BluestoneAiPageRoutingModule
  ],
  declarations: [BluestoneAiPage]
})
export class BluestoneAiPageModule { }
