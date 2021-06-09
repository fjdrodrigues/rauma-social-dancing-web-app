import { Component, Injectable, Input } from '@angular/core';

@Component({
  selector: 'adk-video',
  templateUrl: './video.component.html',
  styleUrls: ['./video.component.css']
})
export class VideoComponent {
  @Input() videoSource: string;
  @Input() adkStyle: string;

  constructor() {
  }
}
