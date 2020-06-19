import { HttpClientModule } from '@angular/common/http';
import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from  '@angular/forms';
import { MAT_DATE_LOCALE } from '@angular/material/core';
import { MatDatepickerModule } from '@angular/material/datepicker/';
import { MatMomentDateModule, MAT_MOMENT_DATE_ADAPTER_OPTIONS } from '@angular/material-moment-adapter';
import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { NgbModule, NgbDropdownModule } from '@ng-bootstrap/ng-bootstrap';
import { NgSelectModule } from '@ng-select/ng-select';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { environment } from '../environments/environment';

import { DanceComponent } from './components/dance/dance.component';
import { KizombaDanceComponent } from './components/dance/kizomba/kizomba-dance.component';
import { SembaDanceComponent } from './components/dance/semba/semba-dance.component';
import { KuduroDanceComponent } from './components/dance/kuduro/kuduro-dance.component';
import { HealthComponent } from './components/health/health.component';
import { BodyHealthComponent } from './components/health/body/body-health.component';
import { MindHealthComponent } from './components/health/mind/mind-health.component';
import { HomeComponent } from './home/home.component';

import { SharedModule } from './components/shared/shared.module';
import { AuthGuard } from './components/shared/security/auth-guard';
import { AdminModule } from './components/admin/admin.module';
import { LayoutModule } from './layout/layout.module';

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
		DanceComponent,
		KizombaDanceComponent,
		SembaDanceComponent,
    KuduroDanceComponent,
		HealthComponent,
		BodyHealthComponent,
    MindHealthComponent
  ],
  imports: [
    BrowserModule,
		NgbModule,
    HttpClientModule,
    FormsModule,
    NgSelectModule,
    ReactiveFormsModule,
    MatDatepickerModule,
    MatMomentDateModule,
    BrowserAnimationsModule,
    NgbDropdownModule,
    AppRoutingModule,
    LayoutModule,
    AdminModule,
		SharedModule
  ],
  providers: [
    { provide: MAT_MOMENT_DATE_ADAPTER_OPTIONS, useValue: { useUtc: true } },
    { provide: MAT_DATE_LOCALE, useValue: 'en-GB'},
    AuthGuard
  ],
  bootstrap: [AppComponent],
  schemas: [
      CUSTOM_ELEMENTS_SCHEMA
  ]
})
export class AppModule { }
