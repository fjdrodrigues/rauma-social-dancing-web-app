import { Component, ElementRef, Input, OnInit, QueryList, ViewChildren, AfterViewInit } from '@angular/core';
import { VideoComponent } from '../video/video.component';
import { GalleryItem, GalleryItemType } from './gallery-item.interface';

@Component({
  selector: 'adk-gallery',
  templateUrl: './gallery.component.html',
  styleUrls: ['./gallery.component.css']
})
export class GalleryComponent implements OnInit, AfterViewInit {
  @ViewChildren('arrows') arrows: QueryList<ElementRef>;
  @ViewChildren('video') videos: QueryList<VideoComponent>;
  @Input() items: Array<GalleryItem>;
  @Input() index: number;

  public selectedIndex: number = 0;

  constructor() {
  }

  ngOnInit() {
  }

  ngAfterViewInit() {
    for(let item of this.arrows) {
      let htmlItem = item.nativeElement as HTMLElement;
      htmlItem.style.visibility = "visible";
    }
  }

  public videoStarted(galleryIndex: number) {
    this.hideArrows(galleryIndex);
  }

  public videoStopped(galleryIndex: number) {
    this.showArrows(galleryIndex);
  }

  public showArrows(galleryIndex: number) {
    if(this.videos.length > 1) {
      for(let item of document.getElementById("gallery"+galleryIndex).getElementsByClassName("arrow")) {
        let htmlItem = item as HTMLElement;
        htmlItem.style.visibility = "visible";
      }
    }
  }

  public hideArrows(galleryIndex: number) {
    for(let item of document.getElementById("gallery"+galleryIndex).getElementsByClassName("arrow")) {
      let htmlItem = item as HTMLElement;
      htmlItem.style.visibility = "hidden";
    }
  }

  public slideLeft() {
    this.stopVideo(this.selectedIndex);
    let previousSelectedIndex = this.selectedIndex;
    this.selectedIndex = this.selectedIndex === 0 ? this.items.length-1 : --this.selectedIndex;
    let previousVideo = this.videos.find(video => video.videoIndex == previousSelectedIndex+10*this.index)
      .elementRef.nativeElement as HTMLElement;
      previousVideo.animate([
      { left: '0' },
      { left: '100%' }
    ], {
      duration: 500,
      fill: "forwards"
    });
    let newVideo = this.videos.find(video => video.videoIndex == this.selectedIndex+10*this.index)
      .elementRef.nativeElement as HTMLElement;
    newVideo.style.left = "-100%";
    newVideo.animate([
      { left: '-100%' },
      { left: '0' }
    ], {
      duration: 500,
      fill: "forwards"
    });
  }

  public slideRight() {
    this.stopVideo(this.selectedIndex);
    let previousSelectedIndex = this.selectedIndex;
    this.selectedIndex = this.selectedIndex >= this.items.length-1 ? 0 : ++this.selectedIndex;
    let previousVideo = this.videos.find(video => video.videoIndex == previousSelectedIndex+10*this.index)
      .elementRef.nativeElement as HTMLElement;
    previousVideo.animate([
      { left: '0' },
      { left: '-100%' }
    ], {
      duration: 500,
      fill: "forwards"
    });
    let newVideo = this.videos.find(video => video.videoIndex == this.selectedIndex+10*this.index)
      .elementRef.nativeElement as HTMLElement;
    newVideo.style.left = "100%";
    newVideo.animate([
      { left: '100%' },
      { left: '0' }
    ], {
      duration: 500,
      fill: "forwards"
    });
  }

  private stopVideo(index: number) {
    let currentVideo = this.videos.find(video => video.videoIndex == index+10*this.index);
    currentVideo.stopVideo();
  }
}