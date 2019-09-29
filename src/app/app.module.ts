import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from  '@angular/forms';
import { NgModule } from '@angular/core';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { environment } from './../environments/environment';

import { AppNavbarComponent } from './app-navbar/app-navbar.component';
import { AppLeftPaneComponent } from './app-leftpane/app-leftpane.component';
import { AppMainComponent } from './app-main/app-main.component';
import { AppRightPaneComponent } from './app-rightpane/app-rightpane.component';
import { AppFooterComponent } from './app-footer/app-footer.component';

import { DanceModule } from './components/dance/dance.module';
import { HealthModule } from './components/health/health.module';
import { SharedModule } from './components/shared/shared.module';

@NgModule({
  declarations: [
    AppComponent,
    AppNavbarComponent,
		AppLeftPaneComponent,
		AppMainComponent,
		AppRightPaneComponent,
		AppFooterComponent
  ],
  imports: [
    BrowserModule,
		NgbModule,
    HttpClientModule,
    FormsModule,
    AppRoutingModule,
		DanceModule,
		HealthModule,
		SharedModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
