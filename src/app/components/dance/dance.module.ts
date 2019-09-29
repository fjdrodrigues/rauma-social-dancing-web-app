import { NgModule } from '@angular/core';
import { DanceComponent } from './dance.component';
import { KizombaDanceComponent } from './kizomba/kizomba-dance.component';
import { SembaDanceComponent } from './semba/semba-dance.component';
import { KuduroDanceComponent } from './kuduro/kuduro-dance.component';

@NgModule({
  declarations: [
		DanceComponent,
		KizombaDanceComponent,
		SembaDanceComponent,
		KuduroDanceComponent
  ],
  imports: []
})
export class DanceModule { }
