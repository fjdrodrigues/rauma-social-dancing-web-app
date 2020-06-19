import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { DanceComponent } from './dance.component';
import { KizombaDanceComponent } from './kizomba/kizomba-dance.component';
import { SembaDanceComponent } from './semba/semba-dance.component';
import { KuduroDanceComponent } from './kuduro/kuduro-dance.component';

export const danceRoutes: Routes = [
	{
		path: 'dance',
		component: DanceComponent
	},
	{
		path: 'dance/kizomba',
		component: KizombaDanceComponent
	},
	{
		path: 'dance/semba',
		component: SembaDanceComponent
	},
	{
		path: 'dance/kuduro',
		component: KuduroDanceComponent
	}
]; 