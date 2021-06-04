import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ContactsComponent } from './contacts.component';
export const contactsRoute: Routes = [
	{
		path: 'contacts',
		component: ContactsComponent
	}
]; 