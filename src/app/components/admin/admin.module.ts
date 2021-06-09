import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AdminComponent } from './admin.component';
import { LoginComponent } from './login/login.component';
import { RegistrationComponent } from './registration/registration.component';
import { SharedModule } from '../shared/shared.module';
import { AdminSelectorComponent } from './admin-selector/admin-selector.component';
import { RouterModule } from '@angular/router';
import { ActivityComponent } from './activity/activity.component';
import { PostComponent } from './post/post.component';
import { SharedLibsModule } from '../shared/shared-libs.module';

@NgModule({
  imports: [
    SharedLibsModule,
    BrowserModule,
    RouterModule,
    SharedModule
  ],
  declarations: [
    AdminComponent,
    LoginComponent,
    RegistrationComponent,
    AdminSelectorComponent,
    ActivityComponent,
    PostComponent
  ],
  exports: [
    AdminSelectorComponent
  ]
})
export class AdminModule { }