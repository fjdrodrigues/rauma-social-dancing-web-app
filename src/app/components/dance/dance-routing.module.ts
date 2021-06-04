import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { DanceComponent } from './dance.component';
import { KizombaDanceComponent } from './kizomba/kizomba-dance.component';
import { BachataDanceComponent } from './bachata/bachata-dance.component';
import { CubanSalsaDanceComponent } from './cuban-salsa/cuban-salsa-dance.component';
import { OtherDanceComponent } from './other/other-dance.component';

export const danceRoutes: Routes = [
	{
		path: 'dance/cubansalsa',
		component: CubanSalsaDanceComponent
	},
	{
		path: 'dance/bachata',
		component: BachataDanceComponent
	},
	{
		path: 'dance/kizomba',
		component: KizombaDanceComponent
	},
	{
		path: 'dance/others',
		component: OtherDanceComponent
	}
]; 