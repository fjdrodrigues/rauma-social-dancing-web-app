import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { BaseEventComponent } from './base-event/base-event.component';
import { BasePostComponent } from './base-post/base-post.component';
import { VideoComponent } from './video/video.component';
import { HasAnyRoleDirective } from './security/has-any-role.directive';
import { TokenStorageService } from './security/token-storage.service';
import { AlertComponent } from './alert/alert.component';
import { SharedLibsModule } from './shared-libs.module';
import { SafePipe } from './pipes/safe-pipe.pipe';

@NgModule({
  imports: [
    SharedLibsModule
  ],
  declarations: [
    HasAnyRoleDirective,
    BasePostComponent,
    BaseEventComponent,
    VideoComponent,
    AlertComponent,
    SafePipe
  ],
  providers: [
      TokenStorageService,
  ],
  exports: [
      HasAnyRoleDirective,
      BasePostComponent,
      VideoComponent,
      AlertComponent,
      SafePipe
  ],
  schemas: [CUSTOM_ELEMENTS_SCHEMA]
})
export class SharedModule { }
