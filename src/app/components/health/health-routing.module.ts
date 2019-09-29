import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { HealthComponent } from './health.component';
import { BodyHealthComponent } from './body/body-health.component';
import { MindHealthComponent } from './mind/mind-health.component';

export const healthRoutes: Routes = [
  {
    path: 'health',
    component: HealthComponent
	},
	{
		path: 'health/body',
		component: BodyHealthComponent
	},
	{
		path: 'health/mind',
		component: MindHealthComponent
	}
]; 