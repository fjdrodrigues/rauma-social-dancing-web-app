import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { danceRoutes } from './components/dance/dance-routing.module';
import { healthRoutes } from './components/health/health-routing.module';
import { HomeComponent } from './home/home.component';
import { adminRoutes } from './components/admin/admin-routing.module';

const routes: Routes = [
  ...adminRoutes,
  ...danceRoutes,
	...healthRoutes,		
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