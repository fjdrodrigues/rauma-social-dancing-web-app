import { resolve } from '@angular/compiler-cli/src/ngtsc/file_system';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class YoutubeService {
  
  private apiReady: Promise<any>;

  constructor() {
    this.apiReady = new Promise((resolve) => {
      window['onYouTubeIframeAPIReady'] = () => {
        resolve(null);
      }
    });
  }
  
  onReady(callback) {
    this.apiReady.then(callback);
  }
}