import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { VideoComponent } from './video/video.component';
import { GalleryComponent } from './gallery/gallery.component';
import { SharedLibsModule } from './shared-libs.module';
import { CarouselComponent } from './carousel/carousel.component';
import { CarouselItemComponent } from './carousel-item/carousel-item.component';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    SharedLibsModule
  ],
  declarations: [
    VideoComponent,
    GalleryComponent,
    CarouselComponent,
    CarouselItemComponent,
  ],
  exports: [
      VideoComponent,
      GalleryComponent,
      CarouselComponent,
      CarouselItemComponent,
      TranslateModule
  ],
  schemas: [CUSTOM_ELEMENTS_SCHEMA]
})
export class SharedModule { }
