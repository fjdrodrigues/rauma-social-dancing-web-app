import { NgModule } from '@angular/core';
import { HealthComponent } from './health.component';
import { BodyHealthComponent } from './body/body-health.component';
import { MindHealthComponent } from './mind/mind-health.component';

@NgModule({
  declarations: [
		HealthComponent,
		BodyHealthComponent,
		MindHealthComponent
  ],
  imports: []
})
export class HealthModule { }
