import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { danceRoutes } from './components/dance/dance-routing.module';
import { healthRoutes } from './components/health/health-routing.module';
import { HomeComponent } from './home/home.component';
import { adminRoutes } from './components/admin/admin-routing.module';
import { aboutRoute } from './components/about/about-routing.module';
import { classesRoute } from './components/classes/classes-routing.module';
import { contactsRoute } from './components/contacts/contacts-routing.module';

const routes: Routes = [
  ...adminRoutes,
  ...aboutRoute,
  ...danceRoutes,
  ...classesRoute,
	...healthRoutes,
  ...contactsRoute,
  { path: '',
    component: HomeComponent,
  },
  { path: '**',  //component: PageNotFoundComponent }
    redirectTo: '',
    pathMatch: 'full'
  }
];
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { } 