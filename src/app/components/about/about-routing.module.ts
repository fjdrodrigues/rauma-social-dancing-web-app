import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AboutComponent } from './about.component';

export const aboutRoute: Routes = [
	{
		path: 'about',
		component: AboutComponent
	}
]; 