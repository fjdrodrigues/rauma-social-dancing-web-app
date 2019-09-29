import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { danceRoutes } from './components/dance/dance-routing.module';
import { healthRoutes } from './components/health/health-routing.module';

const routes: Routes = [
  ...danceRoutes,
	...healthRoutes,		
  { path: '',
    redirectTo: '/',
    pathMatch: 'full'
  },
  { path: '**',  //component: PageNotFoundComponent }
    redirectTo: '/',
    pathMatch: 'full'
  }
];
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { } 