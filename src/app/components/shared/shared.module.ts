import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { BaseEventComponent } from './base-event/base-event.component';
import { BasePostComponent } from './base-post/base-post.component';
import { VideoComponent } from './video/video.component';
import { GalleryComponent } from './gallery/gallery.component';
import { HasAnyRoleDirective } from './security/has-any-role.directive';
import { TokenStorageService } from './security/token-storage.service';
import { AlertComponent } from './alert/alert.component';
import { SharedLibsModule } from './shared-libs.module';
import { SafePipe } from './pipes/safe-pipe.pipe';
import { CarouselComponent } from './carousel/carousel.component';
import { CarouselItemComponent } from './carousel-item/carousel-item.component';

@NgModule({
  imports: [
    SharedLibsModule
  ],
  declarations: [
    HasAnyRoleDirective,
    BasePostComponent,
    BaseEventComponent,
    VideoComponent,
    GalleryComponent,
    CarouselComponent,
    CarouselItemComponent,
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
      GalleryComponent,
      CarouselComponent,
      CarouselItemComponent,
      AlertComponent,
      SafePipe
  ],
  schemas: [CUSTOM_ELEMENTS_SCHEMA]
})
export class SharedModule { }
