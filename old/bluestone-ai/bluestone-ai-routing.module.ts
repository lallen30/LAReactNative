import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { BluestoneAiPage } from './bluestone-ai.page';

const routes: Routes = [
  {
    path: '',
    component: BluestoneAiPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class BluestoneAiPageRoutingModule {}
