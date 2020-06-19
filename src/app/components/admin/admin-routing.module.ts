import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AdminComponent } from './admin.component';
import { LoginComponent } from './login/login.component';
import { AuthGuard } from '../shared/security/auth-guard';
import { RegistrationComponent } from './registration/registration.component';
import { ActivityComponent } from './activity/activity.component';
import { PostComponent } from './post/post.component';

export const adminRoutes: Routes = [
  {
    path: 'admin',
    data: {
        roles: ['admin']
    },
    canActivate: [AuthGuard],
    component: AdminComponent,
  },
  {
    path: 'admin/activity',
    data: {
        roles: ['admin']
    },
    canActivate: [AuthGuard],
    component: ActivityComponent
  },
  {
    path: 'admin/activity/:activityID',
    data: {
        roles: ['admin']
    },
    canActivate: [AuthGuard],
    component: ActivityComponent
  },
  {
    path: 'admin/post',
    data: {
        roles: ['admin']
    },
    canActivate: [AuthGuard],
    component: PostComponent
  },
  {
    path: 'admin/post/:postID',
    data: {
        roles: ['admin']
    },
    canActivate: [AuthGuard],
    component: PostComponent
  },
  {
    path: 'login',
    component: LoginComponent,
  },
  {
    path: 'register',
    component: RegistrationComponent,
  }
]; 