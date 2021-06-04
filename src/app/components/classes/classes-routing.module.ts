import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ClassesComponent } from './classes.component';
export const classesRoute: Routes = [
	{
		path: 'classes',
		component: ClassesComponent
	}
]; 