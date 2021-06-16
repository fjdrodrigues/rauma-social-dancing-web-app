import { Component, ElementRef, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { YoutubeService } from 'src/app/services/youtube.service';

@Component({
  selector: 'adk-video',
  templateUrl: './video.component.html'
})
export class VideoComponent implements OnInit {
  @Input() videoSource: string;
  @Input() videoIndex: number;
  @Input() galleryIndex: number;
  @Input() start: number;
  @Input() end: number;
  @Output() videoStarted = new EventEmitter<any>();
  @Output() videoStopped = new EventEmitter<any>();
  private player;

  constructor(public elementRef: ElementRef,
              private youtubeService: YoutubeService) {
  }

  ngOnInit() {
    this.init();
    var iFrameID = "video"+this.videoIndex;
    this.youtubeService.onReady((resolve) => {
      this.player = new (<any>window).YT.Player(iFrameID, {
        height: '100%',
        width: '100%',
        videoId: this.videoSource,
        playerVars: {
          start: this.start,
          end: this.end,
        },
        events: {
          'onReady': this.onPlayerReady,
          'onStateChange': this.onPlayerStateChange.bind(this)
        }
      });
      console.log(this.player);
    });
      
  }
  
  init() {
    let scriptLoaded = false;
    for(let i = 0; i < document.getElementsByTagName('script').length; i++) {
      let htmlScript = document.getElementsByTagName('script')[i];
      if(htmlScript.src == "https://www.youtube.com/iframe_api"){
        scriptLoaded = true;
      }
    }
    if(!scriptLoaded) {
      var tag = document.createElement('script');
      tag.src = 'https://www.youtube.com/iframe_api';
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    }
  }

  private onPlayerReady(evt) {
  }

  private onPlayerStateChange(event) {
    if(event.data === 1) {
      this.videoStarted.emit(this.galleryIndex);
    } else if (event.data === 2) {
      this.videoStopped.emit(this.galleryIndex);
    }
  }

  public stopVideo() {
    this.player.stopVideo();
  }
}
